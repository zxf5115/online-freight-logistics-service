<?php
namespace App\Http\Controllers\Api\Module\Member;

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
class MemberController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Member\Member';

  protected $_where = [];

  protected $_params = [];

  protected $_addition = [
    'relevance' => [
      'role_id'
    ]
  ];

  protected $_order = [
    ['key' => 'id', 'value' => 'asc'],
  ];

  protected $_relevance = [
    'role',
    'relevance'
  ];


  /**
   * @api {get} /api/member/archive/{id} 获取会员档案
   * @apiDescription 获取会员档案
   * @apiGroup 06. 会员模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/member/archive
   * @apiVersion 1.0.0
   */
  public function archive(Request $request, $id)
  {
    $condition = self::getBaseWhereData();

    $where = [
      'id' => self::getCurrentId()
    ];

    $condition = array_merge($condition, $this->_where, $where);

    $relevance = [
      'archive',
      'squad',
      'course.course',
    ];

    $response = $this->_model::getRow($condition, $relevance);

    return self::success($response);
  }



  /**
   * @api {post} /api/member/password 修改当前用户的密码
   * @apiDescription 修改当前用户的密码
   * @apiGroup 06. 会员模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} old_password 旧密码
   * @apiParam {string} password 新密码
   * @apiParam {string} password_confirmation 确认密码
   * @apiSampleRequest /api/member/password
   * @apiVersion 1.0.0
   */
  public function password(Request $request)
  {
    $messages = [
      'old_password.required' => '请您输入旧密码',
      'password.required'     => '请您输入新密码',
      'password.between'      => '输入的密码必须是6-16位',
      'password.confirmed'    => '您输入的两次密码信息不一致',
    ];

    $validator = Validator::make($request->all(), [
      'old_password' => 'required',
      'password'     => 'required|between:6,16|confirmed',
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
      $member_id = self::getCurrentId();

      $model = $this->_model::find($member_id);

      $status = $this->_model::checkPassword($model, $request->old_password);

      // 检查旧密码是否正确
      if($status)
      {
        return self::error(Code::OLD_PASSWORD_ERROR);
      }

      $password = $this->_model::generate($request->password);

      $model->password = $password;
      $model->is_new   = 2;

      $response = $model->save();

      if($response)
      {
        return self::success(Code::$message[Code::HANDLE_SUCCESS]);
      }
      else
      {
        return self::error(Code::$message[Code::HANDLE_FAILURE]);
      }
    }
  }


  /**
   * @api {get} /api/member/view/{id} 获取会员详情
   * @apiDescription 获取会员详情
   * @apiGroup 06. 会员模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/member/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    $condition = [['status', '>=', '-1']];

    $where = [
      'id' => $id
    ];

    $condition = array_merge($condition, $where);

    $relevance = ['role', 'archive'];

    $response = $this->_model::getRow($condition, $relevance);

    return self::success($response);
  }



  /**
   * @api {post} /api/member/handle 编辑会员信息
   * @apiDescription 编辑会员信息
   * @apiGroup 06. 会员模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} id 会员编号（不能为空）
   * @apiParam {string} mobile 手机号（不能为空）
   * @apiParam {string} avatar 会员头像（可以为空）
   * @apiParam {string} nickname 会员昵称（可以为空）
   * @apiParam {string} email 邮箱号（可以为空）
   * @apiParam {string} realname 姓名（不能为空）
   * @apiParam {string} sex 性别（可以为空）
   * @apiParam {string} province_id 省（可以为空）
   * @apiParam {string} city_id 市（可以为空）
   * @apiParam {string} region_id 县（可以为空）
   * @apiParam {string} age 年龄（可以为空）
   * @apiParam {string} weixin 微信号（可以为空）
   * @apiParam {string} address 详细地址（可以为空）
   * @apiParam {string} work_address 工作地址（可以为空）
   * @apiParam {json} example {"id":9,"mobile":"18201018926","avatar":"http://localhost:8070/storage/mavon/2020-10-21/6bb4a5bd356378971a97603a8ee33cbb.jpg","nickname":"赵大宝","email":"1326336909@qq.com","realname":"赵二宝","sex":1,"province_id":"140000","city_id":"140100","region_id":"140105","age":28,"weixin":"654321","address":"北京市昌平区","work_address":"北京市昌平区"}
   * @apiSampleRequest /api/member/handle
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'id.required'       => '请您上输入会员编号',
      'realname.required' => '请您上输入会员姓名',
      'mobile.required'   => '请您输入会员电话',
    ];

    $validator = Validator::make($request->all(), [
      'id'       => 'required',
      'realname' => 'required',
      'mobile'   => 'required',
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
        $model = $this->_model::firstOrNew(['id' => $request->id]);

        $model->avatar          = $request->avatar ?? '';
        $model->nickname        = $request->realname ?? '';
        $model->mobile          = $request->mobile;
        $model->email           = $request->email ?? '';
        $model->save();

        $archive = Archive::firstOrCreate(['member_id' => $request->id]);

        $archive->member_id    = $request->id;
        $archive->realname     = $request->realname;
        $archive->sex          = $request->sex ?? '1';
        $archive->province_id  = $request->province_id ?? '';
        $archive->city_id      = $request->city_id ?? '';
        $archive->region_id    = $request->region_id ?? '';
        $archive->age          = $request->age ?? '';
        $archive->weixin       = $request->weixin ?? '';
        $archive->address      = $request->address ?? '';
        $archive->work_address = $request->work_address ?? '';

        $archive->save();

        DB::commit();

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        DB::rollback();

        self::record($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }





  /**
   * @api {post} /api/member/back_mobile 通过手机号码找回
   * @apiDescription 通过手机号码找回
   * @apiGroup 06. 会员模块
   * @apiParam {string} username 登录手机号码
   * @apiParam {string} sms_code 验证码
   * @apiParam {string} password 新密码
   * @apiParam {string} password_confirmation 确认密码
   * @apiSampleRequest /api/member/back_mobile
   * @apiVersion 1.0.0
   */
  public function back_mobile(Request $request)
  {
    $messages = [
      'username.required'     => '请您输入登录账户',
      'sms_code.required'     => '请您输入验证码',
      'password.required'     => '请您输入新密码',
      'password.between'      => '输入的密码必须是6-16位',
      'password.confirmed'    => '您输入的两次密码信息不一致',
    ];

    $validator = Validator::make($request->all(), [
      'username' => 'required',
      'sms_code' => 'required',
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
      $username = $request->username;

      $sms_code = $request->sms_code;

      // 比对验证码
      $status = event(new CodeEvent($username, $sms_code, 3));

      // 验证码错误
      if(empty($status))
      {
        return self::error(Code::VERIFICATION_CODE);
      }

      $model = $this->_model::getRow(['username' => $username]);

      if(empty($model->id))
      {
        return self::error(Code::USER_EMPTY);
      }

      $password = $this->_model::generate($request->password);

      $model->password = $password;
      $model->sms_code = '';

      $response = $model->save();

      if($response)
      {
        return self::success(Code::$message[Code::HANDLE_SUCCESS]);
      }
      else
      {
        return self::error(Code::$message[Code::HANDLE_FAILURE]);
      }
    }
  }


  /**
   * @api {post} /api/member/reset_code 获取重置验证码
   * @apiDescription 获取重置验证码
   * @apiGroup 06. 会员模块
   * @apiParam {string} username 登录账户（18201018888）
   * @apiSampleRequest /api/member/reset_code
   * @apiVersion 1.0.0
   */
  public function reset_code(Request $request)
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

          if(empty($response->member_no))
          {
            return self::error(Code::USER_EMPTY);
          }

          // 发送登录验证码
          event(new SmsEvent($username, 3));

          return self::success([]);
        }
        catch(\Exception $e)
        {


          return self::message($e->getMessage());
        }
      }
    }
  }




  /**
   * @api {post} /api/member/email_code 获取邮件验证码
   * @apiDescription 获取邮件验证码
   * @apiGroup 06. 会员模块
   * @apiParam {string} email email（1326336909@qq.com）
   * @apiSampleRequest /api/member/email_code
   * @apiVersion 1.0.0
   */
  public function email_code(Request $request)
  {
    if($request->isMethod('post'))
    {
      $messages = [
        'email.required' => '请输入邮箱地址',
        'email.email'    => '邮箱地址不合法',
      ];

      $validator = Validator::make($request->all(), [
        'email' => 'required',
        'email' => 'email',
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
          $email = $request->email;

          $response = $this->_model::getRow(['email' => $email]);

          if(empty($response))
          {
            return self::error(Code::USER_EMPTY);
          }

          // 发送登录验证码
          event(new EmailEvent($response));

          return self::success([]);
        }
        catch(\Exception $e)
        {


          return self::message($e->getMessage());
        }
      }
    }
  }



  /**
   * @api {post} /api/member/back_email 通过邮箱码找回
   * @apiDescription 通过邮箱码找回
   * @apiGroup 06. 会员模块
   * @apiParam {string} token JWTtoken
   * @apiParam {string} email 会员邮箱
   * @apiParam {string} sms_code 验证码
   * @apiParam {string} password 新密码
   * @apiParam {string} password_confirmation 确认密码
   * @apiSampleRequest /api/member/back_email
   * @apiVersion 1.0.0
   */
  public function back_email(Request $request)
  {
    $messages = [
      'email.required'     => '请您输入会员邮箱',
      'sms_code.required'  => '请您输入验证码',
      'password.required'  => '请您输入新密码',
      'password.between'   => '输入的密码必须是6-16位',
      'password.confirmed' => '您输入的两次密码信息不一致',
    ];

    $validator = Validator::make($request->all(), [
      'email'    => 'required',
      'sms_code' => 'required',
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
      $email = $request->email;

      $model = $this->_model::getRow(['email' => $email]);

      if(empty($model))
      {
        return self::error(Code::USER_EMPTY);
      }

      $key = RedisKey::EMAIL_CODE . '_' . $model->username;

      // 获取真实验证码
      $real_sms_code = Redis::get($key);

      // 验证码错误
      if($real_sms_code != $request->sms_code)
      {
        return self::error(Code::VERIFICATION_CODE);
      }

      $password = $this->_model::generate($request->password);

      $model->password = $password;

      $response = $model->save();

      if($response)
      {
        return self::success(Code::$message[Code::HANDLE_SUCCESS]);
      }
      else
      {
        return self::error(Code::$message[Code::HANDLE_FAILURE]);
      }
    }
  }


  /**
   * @api {post} /api/member/status 变更会员状态
   * @apiDescription 变更会员状态
   * @apiGroup 06. 会员模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} id 会员编号（不能为空）
   * @apiParam {int} status 状态 1 正常 2 禁用（不能为空）
   * @apiSampleRequest /api/member/status
   * @apiVersion 1.0.0
   */
  public function status(Request $request)
  {
    $messages = [
      'id.required'     => '请您输入会员编号',
      'status.required' => '请您输入会员状态',
    ];

    $validator = Validator::make($request->all(), [
      'id'     => 'required',
      'status' => 'required',
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
      $model = $this->_model::find($request->id);

      $model->status = intval($request->status);

      try
      {
        $response = $model->save();

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }


  /**
   * @api {post} /api/member/role 变成角色
   * @apiDescription 变成角色
   * @apiGroup 06. 会员模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} id 会员编号（不能为空）
   * @apiParam {string} role_id 角色编号 2 老师 3 学生（不能为空）
   * @apiSampleRequest /api/member/role
   * @apiVersion 1.0.0
   */
  public function role(Request $request)
  {
    $messages = [
      'id.required'      => '请您输入会员编号',
      'role_id.required' => '请您输入角色编号',
    ];

    $validator = Validator::make($request->all(), [
      'id'      => 'required',
      'role_id' => 'required',
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
      $model = $this->_model::find($request->id);

      DB::beginTransaction();

      try
      {
        $data['role_id'] = $request->role_id;

        if(!empty($data))
        {
          $model->relevance()->delete();

          $model->relevance()->createMany([$data]);
        }

        DB::commit();

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        DB::rollback();

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }


  /**
   * @api {post} /api/member/certification 会员认证
   * @apiDescription 对当前会员进行认证
   * @apiGroup 06. 会员模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} realname 真实姓名（不能为空）
   * @apiParam {string} id_card_no 身份证号（不能为空）
   * @apiSampleRequest /api/member/certification
   * @apiVersion 1.0.0
   */
  public function certification(Request $request)
  {
    $messages = [
      'realname.required'   => '请您上输入真实姓名',
      'id_card_no.required' => '请您上输入会员编号',
    ];

    $validator = Validator::make($request->all(), [
      'realname' => 'required',
      'id_card_no' => 'required',
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
      $member_id = self::getCurrentId();

      $model = $this->_model::firstOrNew(['id' => $member_id]);

      DB::beginTransaction();

      try
      {
        $model->nickname = $request->realname;
        $model->certification_status = 1;
        $model->save();

        $archive = Archive::firstOrCreate(['member_id' => $member_id]);

        $archive->realname   = $request->realname;
        $archive->id_card_no = $request->id_card_no;

        $archive->save();

        DB::commit();

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        DB::rollback();

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }


  /**
   * @api {post} /api/member/change_code 获取账户更换验证码
   * @apiDescription 获取账户更换验证码
   * @apiGroup 06. 会员模块
   * @apiParam {string} username 登录账户（18201018888）
   * @apiSampleRequest /api/member/change_code
   * @apiVersion 1.0.0
   */
  public function change_code(Request $request)
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

          // 发送登录验证码
          event(new SmsEvent($username, 4));

          return self::success([]);
        }
        catch(\Exception $e)
        {


          return self::message($e->getMessage());
        }
      }
    }
  }

  /**
   * @api {post} /api/member/change_username 更换账户
   * @apiDescription 更换账户手机号码
   * @apiGroup 06. 会员模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} username 账户手机号码（不能为空）
   * @apiParam {string} sms_code 验证码（不能为空）
   * @apiSampleRequest /api/member/change_username
   * @apiVersion 1.0.0
   */
  public function change_username(Request $request)
  {
    $messages = [
      'username.required' => '请您输入登录账户',
      'username.regex'    => '手机号码不合法',
      'sms_code.required' => '请您输入验证码',
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
      $message = $error[0][0] ?? Code::$message[Code::ERROR];

      return self::message($message);
    }
    else
    {
      try
      {
        $username = $request->username;

        $sms_code = $request->sms_code;

        // 比对验证码
        $status = event(new CodeEvent($username, $sms_code, 4));

        // 验证码错误
        if(empty($status))
        {
          return self::error(Code::VERIFICATION_CODE);
        }

        $member_id = self::getCurrentId();

        $model = $this->_model::firstOrCreate(['id' => $member_id]);

        $result = $this->_model::getRow(['username' => $request->username]);

        // 当前手机号已注册
        if(!empty($result->id))
        {
          return self::error(Code::USER_ALREADY_EXISTED);
        }

        $model->username = $request->username;

        $model->save();

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }



  /**
   * @api {get} /api/member/user_info 获取会员信息
   * @apiDescription 获取会员信息
   * @apiGroup 06. 会员模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/member/user_info
   * @apiVersion 1.0.0
   */
  public function user_info(Request $request)
  {
    $condition = self::getCurrentWhereData('id');

    $response = $this->_model::getRow($condition, ['role', 'organization', 'squad']);

    return self::success($response);
  }


  /**
   * @api {get} /api/member/teacher 获取机构老师列表(不分页)
   * @apiDescription 获取机构老师列表(不分页)
   * @apiGroup 06. 会员模块
   * @apiSampleRequest /api/member/teacher
   * @apiVersion 1.0.0
   */
  public function teacher(Request $request)
  {
    $request['role_id'] = 2;

    $condition = self::getBaseWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getList($condition, $this->_relevance, $this->_order, true);

    return self::success($response);
  }


  /**
   * @api {get} /api/member/director 获取机构班主任列表(不分页)
   * @apiDescription 获取机构班主任列表(不分页)
   * @apiGroup 06. 会员模块
   * @apiSampleRequest /api/member/director
   * @apiVersion 1.0.0
   */
  public function director(Request $request)
  {
    $request['role_id'] = 2;

    $condition = self::getBaseWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getList($condition, $this->_relevance, $this->_order);

    return self::success($response);
  }



  /**
   * @api {post} /api/member/generate 生成班主任
   * @apiDescription 生成班主任
   * @apiGroup 06. 会员模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} username 班主任电话
   * @apiParam {string} nickname 班主任姓名
   * @apiSampleRequest /api/member/generate
   * @apiVersion 1.0.0
   */
  public function generate(Request $request)
  {
    $messages = [
      'username.required'  => '请您输入登录账户',
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
      $message = $error[0][0] ?? Code::$message[Code::ERROR];

      return self::message($message);
    }
    else
    {
      $condition = self::getSimpleWhereData();

      $where = ['username' => $request->username];

      $where = array_merge($condition, $where);

      $result = $this->_model::getRow($where);

      if(!empty($result))
      {
        return self::error(Code::MEMBER_ALREADY_EXISTED);
      }

      $model = $this->_model::firstOrNew($where);

      $organization_id = self::getOrganizationId();

      $password = $this->_model::generate(Parameter::PASSWORD);

      if(empty($request->id))
      {
        $model->member_no = ToolTrait::generateOnlyNumber(3);
      }

      $model->organization_id = $organization_id;
      $model->username        = $request->username;
      $model->nickname        = $request->nickname;
      $model->avatar          = Parameter::AVATER;
      $model->password        = $password;
      $model->email           = '';
      $model->mobile          = '';
      $model->sms_code        = '';

      DB::beginTransaction();

      try
      {
        $response = $model->save();

        $data = [['organization_id' => $organization_id, 'role_id' => 2]];

        $model->relevance()->delete();
        $model->relevance()->createMany($data);

        DB::commit();

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        DB::rollback();

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }


  /**
   * @api {post} /api/member/delete 会员删除
   * @apiDescription 会员删除
   * @apiGroup 06. 会员模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} member_id 会员编号
   * @apiSampleRequest /api/member/delete
   * @apiVersion 1.0.0
   */
  public function delete(Request $request)
  {
    $messages = [
      'member_id.required'  => '请您输入会员编号',
    ];

    $validator = Validator::make($request->all(), [
      'member_id' => 'required',
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
        $condition = self::getSimpleWhereData();

        $where = ['member_id' => $request->member_id];

        $where = array_merge($condition, $where);

        $result = $this->_model::getRow($where);

        if(empty($result))
        {
          return self::error(Code::MEMBER_EMPTY);
        }

        $model->status = -1;
        $model->save();

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }
}
