<?php
namespace App\Http\Controllers\Api\Module\Member\Squad;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Parameter;
use App\Http\Controllers\Api\BaseController;
use App\Models\Common\Module\Education\Course\Course;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-09
 *
 * 会员班级控制器类
 */
class SquadController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Organization\Squad\Relevance\Member';

  protected $_where = [];

  protected $_params = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'squad',
  ];


  /**
   * @api {get} /api/member/squad/list?page={page} 获取当前用户班级列表(分页)
   * @apiDescription 获取当前用户班级列表(分页)
   * @apiGroup 会员班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} page 当前页数
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    $condition = self::getCurrentWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order);

    return self::success($response);
  }


  /**
   * @api {get} /api/member/squad/select 获取当前用户班级列表(不分页)
   * @apiDescription 获取当前用户班级列表(不分页)
   * @apiGroup 会员班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/member/squad/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    $condition = self::getCurrentWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getList($condition, $this->_relevance, $this->_order, true);

    return self::success($response);
  }


  /**
   * @api {get} /api/member/squad/view/{id} 获取当前用户班级详情
   * @apiDescription 获取当前用户班级详情
   * @apiGroup 会员班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/member/squad/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    $condition = self::getCurrentWhereData();

    $where = ['id' => $id];

    $condition = array_merge($condition, $where);

    $response = $this->_model::getRow($condition, $this->_relevance);

    return self::success($response);
  }
}
