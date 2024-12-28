<?php
namespace App\Http\Controllers\Api\Module\Signature;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 签到控制器类
 */
class SignatureController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Signature\Signature';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'member_id'
  ];

  // 附加关联查询条件
  protected $_addition = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  // 关联数组
  protected $_relevance = [];



  /**
   * @api {get} /api/signature/list?page={page} 1. 当前用户签到列表(分页)
   * @apiDescription 获取当前用户签到列表(分页)
   * @apiGroup 07. 签到模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} page 当前页数
   * @apiParam {int} member_id 会员编号
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    try
    {
      $condition = self::getBaseWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @api {get} /api/signature/select 2. 当前用户签到列表(不分页)
   * @apiDescription 获取当前用户签到列表(不分页)
   * @apiGroup 07. 签到模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/signature/select
   * @apiParam {int} member_id 会员编号
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    try
    {
      $condition = self::getBaseWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      $response = $this->_model::getList($condition, $this->_relevance, $this->_order, true);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @api {get} /api/signature/view/{id} 3. 当前用户签到详情
   * @apiDescription 获取当前用户签到详情
   * @apiGroup 07. 签到模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/signature/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    try
    {
      $condition = self::getBaseWhereData();

      $where = ['id' => $id];

      $condition = array_merge($condition, $where);

      $response = $this->_model::getRow($condition, $this->_relevance);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @api {post} /api/signature/handle 4. 签到操作
   * @apiDescription 会员登录进行签到
   * @apiGroup 07. 签到模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} sign_ip_address 客户端IP地址（可以为空）
   * @apiParam {string} equipment 客户端设备信息 1 PC端  2 移动端（可以为空）
   * @apiParam {string} system 客户端系统信息（可以为空）
   * @apiParam {string} browser 客户端浏览器信息（可以为空）
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    try
    {
      $model = $this->_model::firstOrNew(['id' => $request->id]);

      $model->organization_id = self::getOrganizationId();
      $model->member_id       = self::getCurrentId();
      $model->sign_ip_address = ip2long($request->sign_ip_address) ?? '';
      $model->type            = $request->type ?? 1;
      $model->equipment       = $request->equipment ?? '';
      $model->system          = $request->system ?? '';
      $model->browser         = $request->browser ?? '';
      $model->sign_time       = time();

      $response = $model->save();

      return self::success(Code::HANDLE_SUCCESS);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::HANDLE_FAILURE);
    }
  }


  /**
   * @api {get} /api/signature/status 5. 今天是否签到
   * @apiDescription 获取当前用户今天是否签到
   * @apiGroup 07. 签到模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/signature/status
   * @apiVersion 1.0.0
   */
  public function status(Request $request)
  {
    try
    {
      $today = strtotime(date('Y-m-d'));

      $organization_id = self::getOrganizationId();
      $member_id       = self::getCurrentId();

      $where = [
        'organization_id' => $organization_id,
        'member_id' => $member_id
      ];

      $order = [
        ['key' => 'sign_time', 'value' => 'desc'],
      ];

      $result = $this->_model::getList($where, false, $order);

      if(empty($result) || empty($result[0]))
      {
        return self::success(false);
      }

      $response = $result[0]->getAttributes();
      $sign_time = $response['sign_time'];

      if($today < $sign_time)
      {
        return self::success(false);
      }
      else
      {
        return self::success(true);
      }
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::success(false);
    }
  }
}
