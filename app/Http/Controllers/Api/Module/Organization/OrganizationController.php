<?php
namespace App\Http\Controllers\Api\Module\Organization;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\TraitClass\ToolTrait;
use App\Exports\ArchiveExport;
use App\Http\Constant\Parameter;
use App\Events\Common\Sms\CodeEvent;
use App\Models\Platform\System\Config;
use App\Models\Api\Module\Member\Member;
use App\Http\Controllers\Api\BaseController;
use App\Events\Api\Organization\OperateLogEvent;
use App\Models\Common\Module\Member\Relevance\MemberRoleRelevance;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 机构控制器类
 */
class OrganizationController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Organization\Organization';

  protected $_where = [];

  protected $_params = [
    'title'
  ];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'course',
    'graduation.squad',
    'ungraduation.squad',
  ];


  /**
   * @api {get} /api/organization/list?page={page} 获取机构列表(分页)
   * @apiDescription 获取机构列表(分页)
   * @apiGroup 机构模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} page 当前页数
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    $condition = [['status', '>=', '-1']];

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order);

    return self::success($response);
  }


  /**
   * @api {get} /api/organization/select 获取机构列表(不分页)
   * @apiDescription 获取机构列表(不分页)
   * @apiGroup 机构模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/organization/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    $condition = [['status', '>=', '-1']];

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getList($condition, $this->_relevance, $this->_order, true);

    return self::success($response);
  }


  /**
   * @api {get} /api/organization/view/{id} 获取机构详情
   * @apiDescription 获取机构详情
   * @apiGroup 机构模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/organization/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    $condition = [['status', '>=', '-1']];

    $where = [
      'id' => $id
    ];

    $condition = array_merge($condition, $where);

    $response = $this->_model::getRow($condition, $this->_relevance);

    return self::success($response);
  }






  /**
   * @api {post} /api/organization/apply_first_step 机构注册第一步
   * @apiDescription 机构注册第一步
   * @apiGroup 机构模块
   * @apiParam {string} title 机构名称（不能为空）
   * @apiParam {string} username 登录手机号码（不能为空）
   * @apiParam {string} sms_code 验证码（不能为空）
   * @apiParam {string} email 机构邮箱（可以为空）
   * @apiParam {json} example {"title":"中职动力北京科技有限公司","username":"15185296312","sms_code":"120120","email":"13848259634@138.com"}
   * @apiSampleRequest /api/organization/apply_first_step
   * @apiVersion 1.0.0
   */
  public function apply_first_step(Request $request)
  {
    $messages = [
      'title.required'    => '请您输入机构名称',
      'username.required' => '请您输入登录手机号码',
      'sms_code.required' => '请您输入验证码',
    ];

    $validator = Validator::make($request->all(), [
      'title'    => 'required',
      'username' => 'required',
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
      DB::beginTransaction();

      try
      {
        $username = $request->username;

        $sms_code = $request->sms_code;

        // 比对验证码
        $status = event(new CodeEvent($username, $sms_code, 2));

        // 验证码错误
        if(empty($status))
        {
          return self::error(Code::VERIFICATION_CODE);
        }

        $member = Member::firstOrNew(['username' => $request->username]);

        $model = $this->_model::firstOrNew(['id' => $request->id]);

        $model->organization_no = ToolTrait::generateOnlyNumber(1);
        $model->logo            = Parameter::AVATER;
        $model->title           = $request->title;
        $model->contact_mobile  = $request->username;
        $model->email           = $request->email ?? '';

        $model->save();

        $member->organization_id      = $model->id;
        $member->nickname             = $request->username;
        $member->password             = Member::generate(Parameter::PASSWORD);
        $member->member_no            = ToolTrait::generateOnlyNumber(3);
        $member->avatar               = Parameter::AVATER;
        $member->mobile               = $request->username;
        $member->email                = $request->email ?? '';
        $member->sms_code             = '';
        $member->certification_status = 1;

        $member->save();

        $data = [['organization_id' => $model->id, 'role_id' => 1]];

        $member->relevance()->delete();
        $member->relevance()->createMany($data);

        // 记录操作行为日志
        event(new OperateLogEvent($this->user, $request));

        DB::commit();

        $response = Member::getRow(['username' => $request->username]);

        return self::success($response);
      }
      catch(\Exception $e)
      {
        DB::rollback();

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }

  /**
   * @api {post} /api/organization/apply_second_step 机构注册第二步
   * @apiDescription 机构注册第二步
   * @apiGroup 机构模块
   * @apiParam {int} id 会员编号（不能为空）
   * @apiParam {string} password 密码（不能为空）
   * @apiParam {string} password_confirmation 确认密码（不能为空）
   * @apiSampleRequest /api/organization/apply_second_step
   * @apiVersion 1.0.0
   */
  public function apply_second_step(Request $request)
  {
    $messages = [
      'id.required'        => '请您输入会员编号',
      'password.required'  => '请您输入密码',
      'password.between'   => '输入的密码必须是6-16位',
      'password.confirmed' => '您输入的两次密码信息不一致',
    ];

    $validator = Validator::make($request->all(), [
      'id' => 'required',
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
        $model = Member::firstOrNew(['id' => $request->id]);

        $password = Member::generate($request->password);

        $model->password = $password;

        $response = $model->save();

        // 记录操作行为日志
        event(new OperateLogEvent($this->user, $request));

        // 认证用户密码是否可以登录
        if (! $token = auth('api')->tokenById($model->id))
        {
          return self::error(Code::USER_EXIST);
        }

        $response = Member::getRow(['id' => $request->id], ['role', 'organization', 'squad']);

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



  /**
   * @api {post} /api/organization/handle 编辑机构信息
   * @apiDescription 编辑机构信息
   * @apiGroup 机构模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} id 会员编号（为空：新增，不为空：编辑）
   * @apiParam {string} logo 机构logo（不能为空）
   * @apiParam {string} head_mobile 负责人电话（不能为空）
   * @apiParam {string} contact 联系人姓名（不能为空）
   * @apiParam {string} contact_mobile 联系人电话（不能为空）
   * @apiParam {string} email 机构邮箱（可以为空）
   * @apiParam {string} weixin 机构微信（可以为空）
   * @apiParam {string} qq 机构QQ（可以为空）
   * @apiParam {string} address 机构地址（可以为空）
   * @apiParam {json} example {"id":"2","logo":"中职动力北京科技有限公司","head_mobile":"15185296312","contact":"邓大平","contact_mobile":"13848259634","email":"13848259634@138.com","weixin":"13848259634","qq":"13848259634","address":"天津市天津区天津街天津号"}
   * @apiSampleRequest /api/organization/handle
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'id.required'             => '请您输入机构编号',
      'logo.required'           => '请您上传机构Logo',
      'head_mobile.required'    => '请您输入负责人电话',
      'contact.required'        => '请您输入联系人姓名',
      'contact_mobile.required' => '请您输入联系人电话',
    ];

    $validator = Validator::make($request->all(), [
      'id'             => 'required',
      'logo'           => 'required',
      'head_mobile'    => 'required',
      'contact'        => 'required',
      'contact_mobile' => 'required',
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
        $model = $this->_model::firstOrNew(['id' => $request->id]);

        $model->logo           = $request->logo;
        $model->head_mobile    = $request->head_mobile ;
        $model->contact        = $request->contact;
        $model->contact_mobile = $request->contact_mobile;
        $model->email          = $request->email ?? '';
        $model->weixin         = $request->weixin ?? '';
        $model->qq             = $request->qq ?? '';
        $model->address        = $request->address ?? '';

        // 记录操作行为日志
        event(new OperateLogEvent($this->user, $request));

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
   * @api {post} /api/organization/certification 机构认证
   * @apiDescription 编辑机构信息
   * @apiGroup 机构模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} id 机构编号
   * @apiParam {string} business_license 机构营业执照（不能为空）
   * @apiParam {string} title 机构名称（不能为空）
   * @apiParam {string} head 负责人姓名（不能为空）
   * @apiParam {string} head_mobile 负责人电话（不能为空）
   * @apiParam {string} home_address 机构所在地（不能为空）
   * @apiParam {string} contact 联系人姓名（不能为空）
   * @apiParam {string} contact_mobile 联系人电话（不能为空）
   * @apiParam {string} email 机构邮箱（可以为空）
   * @apiParam {string} weixin 机构微信（可以为空）
   * @apiParam {string} qq 机构QQ（可以为空）
   * @apiParam {string} address 机构地址（可以为空）
   * @apiParam {json} example {"id":"1","logo":"www.baidu.com","business_license":"www.google.com","title":"一下科技北京科技有限公司","head":"赵大宝","head_mobile":"15185296312","home_address":"北京市朝阳区115号","contact":"邓大平","contact_mobile":"13848259634","email":"13848259634@138.com","weixin":"13848259634","qq":"13848259634","address":"天津市天津区天津街天津号"}
   * @apiSampleRequest /api/organization/certification
   * @apiVersion 1.0.0
   */
  public function certification(Request $request)
  {
    $messages = [
      'id.required'               => '请您输入机构编号',
      'business_license.required' => '请您上传机构营业执照',
      'title.required'            => '请您输入机构名称',
      'head.required'             => '请您输入负责人姓名',
      'head_mobile.required'      => '请您输入负责人电话',
      'home_address.required'     => '请您输入机构所在地',
      'contact.required'          => '请您输入联系人姓名',
      'contact_mobile.required'   => '请您输入联系人电话',
    ];

    $validator = Validator::make($request->all(), [
      'business_license' => 'required',
      'title'            => 'required',
      'head'             => 'required',
      'head_mobile'      => 'required',
      'home_address'     => 'required',
      'contact'          => 'required',
      'contact_mobile'   => 'required',
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
        $model = $this->_model::find($request->id);

        $model->business_license     = $request->business_license;
        $model->title                = $request->title;
        $model->head                 = $request->head;
        $model->head_mobile          = $request->head_mobile;
        $model->home_address         = $request->home_address;
        $model->contact              = $request->contact;
        $model->contact_mobile       = $request->contact_mobile;
        $model->email                = $request->email ?? '';
        $model->weixin               = $request->weixin ?? '';
        $model->qq                   = $request->qq ?? '';
        $model->address              = $request->address ?? '';
        $model->certification_status = 2;

        $response = $model->save();

        // 记录操作行为日志
        event(new OperateLogEvent($this->user, $request));

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        self::record($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }





  /**
   * @api {get} /api/organization/export 导出学员档案
   * @apiDescription 导出学员档案
   * @apiGroup 班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} organization_id 机构编号(不能为空)
   * @apiVersion 1.0.0
   */
  public function export(Request $request)
  {
    $messages = [
      'organization_id.required' => '请您输入机构编号',
    ];

    $validator = Validator::make($request->all(), [
      'organization_id' => 'required',
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
        $condition = self::getBaseWhereData();

        $where = ['role_id' => 3];

        $where = array_merge($condition, $where);

        $member_id = MemberRoleRelevance::getPluck('user_id', $where, false, false, true);

        if(empty($member_id))
        {
          return self::error(Code::MEMBER_EMPTY);
        }

        $where = ['organization_id' => $request->organization_id, ['id', $member_id]];

        $where = array_merge($condition, $where);

        $relevance = [
          'organization',
          'role',
          'relevance',
          'archive',
          'squad',
          'course2',
          'comment.appraiser',
        ];

        $response = Member::getList($where, $relevance);

        $dir = 'public';
        $filename = '/excel/'. '学员档案_'.time().'.xlsx';

        Excel::store(new ArchiveExport($response), $dir.$filename);

        $url = Config::getConfigValue('web_url');

        $url = $url . '/storage/' . $filename;

        return self::success($url);
      }
      catch(\Exception $e)
      {
        self::record($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }
}
