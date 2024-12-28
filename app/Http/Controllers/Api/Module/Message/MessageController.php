<?php
namespace App\Http\Controllers\Api\Module\Message;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Http\Controllers\Api\BaseController;
use App\Models\Common\Module\Organization\Squad\Relevance\Member;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-25
 *
 * 消息控制器类
 */
class MessageController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Message\Message';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [];

  // 附加关联查询条件
  protected $_addition = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  // 关联数组
  protected $_relevance = [];


  /**
   * @api {get} /api/message/list?page={page} 获取消息列表(分页)
   * @apiDescription 获取消息列表(分页)
   * @apiGroup 消息模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} page 当前页数
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    $condition = self::getBaseWhereData();

    $member_id = self::getCurrentId();

    $where = ['founder_id' => $member_id];

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter, $where);

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order);

    return self::success($response);
  }


  /**
   * @api {get} /api/message/select 获取消息列表(不分页)
   * @apiDescription 获取消息列表(不分页)
   * @apiGroup 消息模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/message/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    $condition = self::getBaseWhereData();

    $member_id = self::getCurrentId();

    $where = ['founder_id' => $member_id];

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter, $where);

    $response = $this->_model::getList($condition, $this->_relevance, $this->_order, true, 10);

    return self::success($response);
  }


  /**
   * @api {get} /api/message/view/{id} 获取消息详情
   * @apiDescription 获取消息详情
   * @apiGroup 消息模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/message/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    $condition = self::getBaseWhereData();

    $where = [
      'id' => $id
    ];

    $condition = array_merge($condition, $where);

    $response = $this->_model::getRow($condition, $this->_relevance);

    return self::success($response);
  }


  /**
   * @api {post} /api/message/handle 消息操作
   * @apiDescription 消息操作
   * @apiGroup 消息模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} type 1 系统消息 2 班级消息
   * @apiParam {string} title 消息标题
   * @apiParam {string} content 消息内容
   * @apiParam {string} squad_id 1,2,3,4 班级编号
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $model = $this->_model::firstOrNew(['id' => $request->id]);

    $model->organization_id = self::getOrganizationId();
    $model->type            = $request->type ?? 1;
    $model->title           = $request->title ?? '';
    $model->content         = $request->content ?? '';
    $model->founder_id      = self::getCurrentId();

    DB::beginTransaction();

    try
    {
      $response = $model->save();

      $squad_id = explode(',', $request->squad_id);

      $data = Member::whereIn('squad_id', $squad_id)->get()->toArray();

      if(!empty($data))
      {
        $model->relevance()->delete();
        $model->relevance()->createMany($data);
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
