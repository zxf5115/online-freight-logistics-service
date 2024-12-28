<?php
namespace App\Http\Controllers\Api\Module\Probe;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-07
 *
 * 探针控制器类
 */
class ProbeController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Education\Probe\Probe';

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
   * @api {get} /api/probe/search 获取知识点探针令牌
   * @apiDescription 获取知识点探针令牌
   * @apiGroup 探针模块
   * @apiPermission jwt
   *
   * @apiParam {string} token JWTtoken
   *
   * @apiSampleRequest /api/probe/search
   * @apiVersion 1.0.0
   */
  public function search(Request $request)
  {
    try
    {
      $organization_id = self::getOrganizationId();
      $member_id       = self::getCurrentId();

      $where = [
        'organization_id' => $organization_id,
        'member_id'       => $member_id
      ];

      $response = $this->_model::getRow($where);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      return self::error(Code::HANDLE_FAILURE);
    }
  }


  /**
   * @api {post} /api/probe/handle 记录探针令牌
   * @apiDescription 记录探针令牌
   * @apiGroup 探针模块
   * @apiPermission jwt
   *
   * @apiParam {string} token JWTtoken
   * @apiParam {string} point_id 知识点编号
   * @apiParam {string} probe_token 探针令牌（32位字符串）
   *
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    try
    {
      $organization_id = self::getOrganizationId();
      $member_id       = self::getCurrentId();

      $where = [
        'organization_id' => $organization_id,
        'member_id'       => $member_id
      ];

      $model = $this->_model::firstOrNew($where);

      $model->point_id    = $request->point_id;
      $model->probe_token = $request->probe_token;

      $response = $model->save();

      return self::success(Code::HANDLE_SUCCESS);
    }
    catch(\Exception $e)
    {
      return self::error(Code::HANDLE_FAILURE);
    }
  }
}
