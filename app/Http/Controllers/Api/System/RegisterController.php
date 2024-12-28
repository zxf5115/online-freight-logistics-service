<?php
namespace App\Http\Controllers\Api\System;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\TraitClass\ToolTrait;
use App\Http\Constant\Parameter;
use App\Events\Common\Sms\CodeEvent;
use App\Events\Common\Message\SmsEvent;
use App\Events\Common\Message\EmailEvent;
use App\Http\Controllers\Api\BaseController;
use App\Models\Api\Module\Member\Archive;
use App\Models\Api\Module\Organization\Organization;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 会员控制器类
 */
class RegisterController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Member\Member';

  protected $_where = [];

  protected $_params = [];

  protected $_addition = [];

  protected $_order = [
    ['key' => 'id', 'value' => 'asc'],
  ];

  protected $_relevance = [];


  /**
   * @api {post} /api/member/sms_code 1. 获取注册验证码
   * @apiDescription 获取注册验证码
   * @apiGroup 05. 注册模块
   *
   * @apiParam {string} username 注册账户（18201018926）
   *
   * @apiSampleRequest /api/member/sms_code
   * @apiVersion 1.0.0
   */
  public function sms_code(Request $request)
  {
    if($request->isMethod('post'))
    {
      $messages = [
        'username.required'  => '请输入用户名称',
        'username.regex'     => '手机号码不合法',
      ];

      $validator = Validator::make($request->all(), [
        'username' => 'required',
        'username' => 'regex:/^1[3456789][0-9]{9}$/',     //正则验证
      ], $messages);

      if($validator->fails())
      {
        $error = $validator->getMessageBag()->toArray();
        $error = array_values($error);
        $message = $error[0][0] ?? '未知错误';

        return self::message($message);
      }
      else
      {
        try
        {
          $username = $request->username;

          $response = $this->_model::getRow(['username' => $username, 'status' => 1]);

          if(!empty($response->member_no))
          {
            return self::error(Code::USER_ALREADY_EXISTED);
          }

          // 发送登录验证码
          event(new SmsEvent($username, 2));

          return self::success([]);
        }
        catch(\Exception $e)
        {
          \Log::error($e);

          return self::message($e->getMessage());
        }
      }
    }
  }


  /**
   * @api {post} /api/member/validation_code 2. 验证注册验证码
   * @apiDescription 验证注册验证码
   * @apiGroup 05. 注册模块
   *
   * @apiParam {string} username 注册账户（18201018926）
   * @apiParam {string} sms_code 验证码（不能为空）
   *
   * @apiSampleRequest /api/member/validation_code
   * @apiVersion 1.0.0
   */
  public function validation_code(Request $request)
  {
    if($request->isMethod('post'))
    {
      $messages = [
        'username.required'  => '请输入用户名称',
        'username.regex'     => '手机号码不合法',
        'sms_code.required'  => '请您输入验证码',
      ];

      $validator = Validator::make($request->all(), [
        'username' => 'required',
        'username' => 'regex:/^1[3456789][0-9]{9}$/',     //正则验证
        'sms_code' => 'required',
      ], $messages);

      if($validator->fails())
      {
        $error = $validator->getMessageBag()->toArray();
        $error = array_values($error);
        $message = $error[0][0] ?? '未知错误';

        return self::message($message);
      }
      else
      {
        try
        {
          $response = true;

          $username = $request->username;

          $sms_code = $request->sms_code;

          // 比对验证码
          $status = event(new CodeEvent($username, $sms_code, 2));

          // 验证码错误
          if(empty($status))
          {
            return self::error(Code::VERIFICATION_CODE);
          }

          // $model = $this->_model::getRow(['username' => $username]);

          // if(empty($model->id))
          // {
          //   return self::error(Code::USER_EMPTY);
          // }

          return self::success($response);
        }
        catch(\Exception $e)
        {
          \Log::error($e);

          return self::message($e->getMessage());
        }
      }
    }
  }


  /**
   * @api {post} /api/member/register 3. 注册会员
   * @apiDescription 注册会员
   * @apiGroup 05. 注册模块
   *
   * @apiParam {int} id 会员编号（为空：新增，不为空：编辑）
   * @apiParam {int} role_id 角色 1 机构管理员 3 学员（不能为空）
   * @apiParam {string} username 登录账户（手机号码, 不能为空）
   * @apiParam {string} password 密码（不能为空）
   * @apiParam {string} password_confirmation 确认密码（不能为空）
   * @apiParam {string} sms_code 验证码（不能为空）
   * @apiParam {string} nickname 会员昵称（可以为空）
   * @apiParam {string} avatar 会员头像（可以为空）
   * @apiParam {string} email 会员邮箱（可以为空）
   *
   * @apiSampleRequest /api/member/register
   * @apiVersion 1.0.0
   */
  public function register(Request $request)
  {
    $messages = [
      'role_id.required'   => '请您输入角色类型',
      'username.required'  => '请您输入登录账户',
      'username.regex'     => '手机号码不合法',
      'password.required'  => '请您输入密码',
      'password.between'   => '输入的密码必须是6-16位',
      'password.confirmed' => '您输入的两次密码信息不一致',
      'sms_code.required'  => '请您输入验证码',
      'email.email'        => '您输入邮箱格式不正确',
    ];

    $validator = Validator::make($request->all(), [
      'role_id'  => 'required',
      'username' => 'required',
      'username' => 'regex:/^1[3456789][0-9]{9}$/',     //正则验证
      'sms_code' => 'required',
      'password' => 'required|between:6,16|confirmed',
      'email'    => 'email',
    ], $messages);


    if($validator->fails())
    {
      $error = $validator->getMessageBag()->toArray();
      $error = array_values($error);
      $message = $error[0][0] ?? Code::$message[Code::ERROR];

      return self::message($message);
    }
    else
    {
      DB::beginTransaction();

      try
      {
        $username = $request->username;

        $sms_code = $request->sms_code;

        // 比对验证码
        $status = event(new CodeEvent($username, $sms_code));

        // 验证码错误
        if(empty($status))
        {
          return self::error(Code::VERIFICATION_CODE);
        }

        $model = $this->_model::firstOrNew(['username' => $request->username]);

        $organization_id = self::getOrganizationId();
        $password = $this->_model::generate($request->password);

        if(empty($request->id))
        {
          $model->member_no = ToolTrait::generateOnlyNumber(3);
        }

        $model->organization_id = $organization_id;
        $model->username        = $request->username;
        $model->nickname        = $request->nickname ?? $request->username;
        $model->avatar          = $request->avatar ?? Parameter::AVATER;
        $model->password        = $password;
        $model->email           = $request->email;
        $model->mobile          = $request->username;
        $model->save();

        $data = [['organization_id' => $organization_id, 'role_id' => 3]];

        if($data)
        {
          $model->relevance()->delete();
          $model->relevance()->createMany($data);
        }

        DB::commit();

        // 认证用户密码是否可以登录
        if (! $token = auth('api')->tokenById($model->id))
        {
          return self::error(Code::USER_EXIST);
        }

        $response = $this->_model::getRow(['username' => $request->username], ['role', 'organization', 'squad']);

        return self::success([
          'code' => 200,
          'token' => $token,
          'token_type' => 'bearer',
          'expires_in' => auth('api')->factory()->getTTL() * 60,
          'user_info' => $response
        ]);
      }
      catch(\Exception $e)
      {
        DB::rollback();

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }


  /**
   * @api {post} /api/member/register_first_step 4. 注册步骤一
   * @apiDescription 注册会员
   * @apiGroup 05. 注册模块
   *
   * @apiParam {int} id 会员编号（为空：新增，不为空：编辑）
   * @apiParam {int} role_id 角色 1 机构管理员 3 学员（不能为空）
   * @apiParam {string} username 登录账户（手机号码, 不能为空）
   * @apiParam {string} sms_code 验证码（不能为空）
   * @apiParam {string} nickname 会员昵称（可以为空）
   * @apiParam {string} avatar 会员头像（可以为空）
   * @apiParam {string} email 会员邮箱（可以为空）
   *
   * @apiSampleRequest /api/member/register_first_step
   * @apiVersion 1.0.0
   */
  public function register_first_step(Request $request)
  {
    $messages = [
      'role_id.required'   => '请您输入角色类型',
      'username.required'  => '请您输入登录账户',
      'username.regex'     => '手机号码不合法',
      'sms_code.required'  => '请您输入验证码',
      'email.email'        => '您输入邮箱格式不正确',
    ];

    $validator = Validator::make($request->all(), [
      'role_id'  => 'required',
      'username' => 'required',
      'username' => 'regex:/^1[3456789][0-9]{9}$/',     //正则验证
      'sms_code' => 'required',
      'email'    => 'email',
    ], $messages);


    if($validator->fails())
    {
      $error = $validator->getMessageBag()->toArray();
      $error = array_values($error);
      $message = $error[0][0] ?? Code::$message[Code::ERROR];

      return self::message($message);
    }
    else
    {
      DB::beginTransaction();

      try
      {
        $username = $request->username;

        $sms_code = $request->sms_code;

        // 比对验证码
        $status = event(new CodeEvent($username, $sms_code, 2));

        // 验证码错误
        // if(empty($status))
        // {
        //   return self::error(Code::VERIFICATION_CODE);
        // }

        $model = $this->_model::firstOrNew(['username' => $request->username]);

        $organization_id = self::getOrganizationId();

        if(empty($request->id))
        {
          $model->member_no = ToolTrait::generateOnlyNumber(3);
        }

        $model->organization_id = $organization_id;
        $model->username        = $request->username;
        $model->nickname        = $request->nickname ?? $request->username;
        $model->avatar          = $request->avatar ?? Parameter::AVATER;
        $model->email           = $request->email;
        $model->mobile          = $request->username;
        $model->save();

        $data = [['organization_id' => $organization_id, 'role_id' => 3]];

        $model->relevance()->delete();
        $model->relevance()->createMany($data);

        DB::commit();

        return self::success($model);
      }
      catch(\Exception $e)
      {
        DB::rollback();

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }


  /**
   * @api {post} /api/member/register_second_step 5. 注册步骤二
   * @apiDescription 注册会员
   * @apiGroup 05. 注册模块
   *
   * @apiParam {int} id 会员编号（不能为空）
   * @apiParam {string} password 密码（不能为空）
   * @apiParam {string} password_confirmation 确认密码（不能为空）
   *
   * @apiSampleRequest /api/member/register_second_step
   * @apiVersion 1.0.0
   */
  public function register_second_step(Request $request)
  {
    $messages = [
      'id.required'        => '请您输入会员编号',
      'password.required'  => '请您输入密码',
      'password.between'   => '输入的密码必须是6-16位',
      'password.confirmed' => '您输入的两次密码信息不一致',
    ];

    $validator = Validator::make($request->all(), [
      'id'       => 'required',
      'password' => 'required|between:6,16|confirmed',
    ], $messages);


    if($validator->fails())
    {
      $error = $validator->getMessageBag()->toArray();
      $error = array_values($error);
      $message = $error[0][0] ?? Code::$message[Code::ERROR];

      return self::message($message);
    }
    else
    {
      try
      {
        $password = $this->_model::generate($request->password);

        $model = $this->_model::getRow(['id' => $request->id]);
        $model->password = $password;
        $model->save();

        // 认证用户密码是否可以登录
        if (! $token = auth('api')->tokenById($model->id))
        {
          return self::error(Code::USER_EXIST);
        }

        $response = $this->_model::getRow(['id' => $request->id], ['role', 'organization', 'squad']);

        return self::success([
          'code' => 200,
          'token' => $token,
          'token_type' => 'bearer',
          'expires_in' => auth('api')->factory()->getTTL() * 60,
          'user_info' => $response
        ]);
      }
      catch(\Exception $e)
      {
        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }

}
