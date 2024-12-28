<?php
namespace App\Http\Controllers\Api\Module\Member\Message;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;
use App\Models\Api\System\User\UserMessageRelevance;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-17
 *
 * Message接口控制器类
 */
class MessageController extends BaseController
{
  protected $_model = 'App\Models\Common\Module\Member\Relevance\MemberMessageRelevance';

  protected $_where = [];

  protected $_params = [
    'squad_id'
  ];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'message'
  ];


  /**
   * @api {get} /api/member/message/list?page={page} 获取当前会员消息列表(分页)
   * @apiDescription 获取当前会员消息列表(分页)
   * @apiGroup 会员消息模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} page 当前页数
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    $where = [
      ['member_id', self::getCurrentId(), 'AND'],
      ['organization_id', 0, 'AND']
    ];

    $condition = self::getCurrentWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order, false, 10, false, false, $where);

    return self::success($response);
  }


  /**
   * @api {get} /api/member/message/select 获取当前会员消息列表(不分页)
   * @apiDescription 获取当前会员消息列表(不分页)
   * @apiGroup 会员消息模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/member/message/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    $where = [
      ['member_id', self::getCurrentId(), 'AND'],
      ['organization_id', 0, 'AND']
    ];

    $condition = self::getCurrentWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getList($condition, $this->_relevance, $this->_order, true, false, $where);

    return self::success($response);
  }
}
