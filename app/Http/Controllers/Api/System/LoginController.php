<?php
namespace App\Http\Controllers\Api\System;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Events\Common\Sms\CodeEvent;
use App\Events\Api\Member\OnlineEvent;
use App\Events\Common\Message\SmsEvent;
use App\Models\Api\Module\Member\Member;
use App\Http\Controllers\Api\BaseController;
use App\Models\Api\Module\Education\Probe\Probe;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 登录控制器
 */
class LoginController extends BaseController
{
  /**
   * @api {post} /api/login 1.用户密码登录
   * @apiDescription 通过用户与密码进行系统登录
   * @apiGroup 04. 登录模块
   *
   * @apiParam {string} username 登录账户（18201018926）
   * @apiParam {string} password 登录密码（123456）
   *
   * @apiSampleRequest /api/login
   * @apiVersion 1.0.0
   */
  public function login(Request $request)
  {
    if($request->isMethod('post'))
    {
      $messages = [
        'username.required'  => '请输入用户名称',
        'username.regex'     => '手机号码不合法',
        'password.required'  => '请输入用户密码',
      ];

      $validator = Validator::make($request->all(), [
        'username' => 'required',
        'username' => 'regex:/^1[3456789][0-9]{9}$/',     //正则验证
        'password' => 'required',
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
          $password = $request->password;

          $condition = self::getSimpleWhereData();

          $where = ['username' => $username];

          $where = array_merge($condition, $where);

          $response = Member::getRow($where, ['role', 'organization', 'squad']);

          // 用户不存在
          if(is_null($response))
          {
            return self::error(Code::MEMBER_EMPTY);
          }

          // 用户已禁用
          if(2 == $response->status['value'])
          {
            return self::error(Code::MEMBER_DISABLE);
          }

          // 在特定时间内访问次数过多，就触发访问限制
          if(Member::AccessRestrictions($response))
          {
            return self::error(Code::ACCESS_RESTRICTIONS);
          }

          // 检验用户输入的密码是否正确
          if(Member::checkPassword($response, $password))
          {
            // 设置密码尝试信息
            Member::setTryNumber($response);

            return self::error(Code::PASSWORD_ERROR);
          }

          $credentials = [
            'username' => $username,
            'password' => $password,
          ];

          // 认证用户密码是否可以登录
          if (! $token = auth('api')->attempt($credentials))
          {
            return self::error(Code::USER_EXIST);
          }

          // 获取客户端ip地址
          $response->last_login_ip = $request->getClientIp();

          $old_token = $response->remember_token;

          if(!empty($old_token))
          {
            \JWTAuth::setToken($old_token)->invalidate();

            // $invalidate = auth('api')->setToken($old_token);

            // // 检查旧 Token 是否有效, 加入黑名单
            // if($invalidate->check())
            // {
            //   $invalidate->invalidate();
            // }
          }

          // 记录登录信息
          Member::login($response, $token);

          // 记录在线人数（加一）
          event(new OnlineEvent(1, $response->id));

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

        }
      }
    }
  }


  /**
   * @api {post} /api/sms_login 2. 手机验证码登录
   * @apiDescription 通过手机短信验证码进行系统登录
   * @apiGroup 04. 登录模块
   *
   * @apiParam {string} username 登录账户（18201018926）
   * @apiParam {string} sms_code 短信验证码（123456）
   *
   * @apiSampleRequest /api/sms_login
   * @apiVersion 1.0.0
   */
  public function sms_login(Request $request)
  {
    if($request->isMethod('post'))
    {
      $messages = [
        'username.required'  => '请输入用户名称',
        'username.regex'     => '手机号码不合法',
        'sms_code.required'  => '请输入短信验证码',
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
          $username = $request->username;

          $sms_code = $request->sms_code;

          // 比对验证码
          $status = event(new CodeEvent($username, $sms_code));

          // 验证码错误
          if(empty($status))
          {
            return self::error(Code::VERIFICATION_CODE);
          }

          $condition = self::getSimpleWhereData();

          $where = ['username' => $username];

          $where = array_merge($condition, $where);

          $response = Member::getRow($where, ['role', 'organization', 'squad']);

          // 用户不存在
          if(is_null($response))
          {
            return self::error(Code::USER_EXIST);
          }

          // 用户已禁用
          if(2 == $response->status['value'])
          {
            return self::error(Code::MEMBER_DISABLE);
          }

          // 在特定时间内访问次数过多，就触发访问限制
          if(Member::AccessRestrictions($response))
          {
            return self::error(Code::ACCESS_RESTRICTIONS);
          }

          // 认证用户密码是否可以登录
          if (! $token = auth('api')->tokenById($response->id))
          {
            return self::error(Code::USER_EXIST);
          }

          // 获取客户端ip地址
          $response->last_login_ip = $request->getClientIp();

          $old_token = $response->remember_token;

          if(!empty($old_token))
          {
            \JWTAuth::setToken($old_token)->invalidate();

            // $invalidate = auth('api')->setToken($old_token);

            // // 检查旧 Token 是否有效, 加入黑名单
            // if($invalidate->check())
            // {
            //   $invalidate->invalidate();
            // }
          }

          // 记录登录信息
          Member::login($response);

          // 记录在线人数（加一）
          event(new OnlineEvent(1, $response->id));

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

        }
      }
    }
  }


  /**
   * @api {post} /api/sms_code 3. 登录验证码
   * @apiDescription 获取手机登录验证码
   * @apiGroup 04. 登录模块
   *
   * @apiParam {string} username 登录账户（18201018926）
   *
   * @apiSampleRequest /api/sms_code
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

          $response = Member::getRow(['username' => $username, 'status' => 1]);

          if(empty($response->id))
          {
            return self::error(Code::USER_EMPTY);
          }

          // 发送登录验证码
          event(new SmsEvent($username, 1));

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
   * @api {get} /api/check_user_login 4. 是否已经登录
   * @apiDescription 检测当前用户是否已经登录
   * @apiGroup 04. 登录模块
   *
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   *
   * @apiSampleRequest /api/check_user_login
   * @apiVersion 1.0.0
   */
  public function check_user_login(Request $request)
  {
    try
    {
      // 判断当前token是否有效
      if(auth('api')->parser()->setRequest($request)->hasToken())
      {
        return self::success();
      }
    }
    catch(\Exception $e)
    {

    }
  }


  /**
   * @api {get} /api/logout 5. 用户退出
   * @apiDescription 用户退出系统
   * @apiGroup 04. 登录模块
   *
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   *
   * @apiSampleRequest /api/logout
   * @apiVersion 1.0.0
   */
  public function logout()
  {
    try
    {
      $where = self::getCurrentWhereData();

      Probe::where($where)->delete();

      // 记录在线人数（减一）
      event(new OnlineEvent(2, $this->user->id));

      auth('api')->logout();

      return self::success([], '退出成功');
    }
    catch(\Exception $e)
    {


      return self::error(Code::ERROR);
    }
  }


  /**
   * @api {post} /api/weixin_login 6. 第三方登录-微信
   * @apiDescription 第三方登录-微信
   * @apiGroup 04. 登录模块
   *
   * @apiParam {string} username 登录账户（18201018926）
   * @apiParam {string} sms_code 短信验证码（123456）
   *
   * @apiSampleRequest /api/weixin_login
   * @apiVersion 1.0.0
   */
  public function weixin_login()
  {
    $user = Socialite::driver('weixin')->user();

    $check = User::where('uid', $user->id)->where('provider', 'qq_connect')->first();
    if (!$check) {
      $customer = User::create([
        'uid' => $user->id,
        'provider' => 'qq_connect',
        'name' => $user->nickname,
        'email' => 'qq_connect+' . $user->id . '@example.com',
        'password' => bcrypt(Str::random(60)),
        'avatar' => $user->avatar
      ]);
    } else {
      $customer = $check;
    }

    Auth::login($customer, true);
    return redirect('/');
  }




  public function weixin_redirect()
  {
    return Socialite::with('weixin')->redirect();
  }



  /**
   * @api {get} /api/me 7. 获取登录用户信息
   * @apiDescription 获取登录用户信息
   * @apiGroup Auth
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/me
   * @apiVersion 1.0.0
   */
  public function me()
  {
    return self::success(auth('api')->user());
  }
}
