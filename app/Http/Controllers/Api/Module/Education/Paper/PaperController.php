<?php
namespace App\Http\Controllers\Api\Module\Education\Paper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-29
 *
 * 试卷控制器类
 */
class PaperController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Education\Paper\Paper';

  protected $_where = [];

  protected $_params = [
    'title'
  ];

  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'question'
  ];


  /**
   * @api {get} /api/education/paper/list?page={page} 获取试卷列表(分页)
   * @apiDescription 获取试卷列表(分页)
   * @apiGroup 试卷模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} page 当前页数
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    $condition = [
      ['status', '>', Status::DELETE]
    ];

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order);

    return self::success($response);
  }


  /**
   * @api {get} /api/education/paper/select 获取试卷列表(不分页)
   * @apiDescription 获取试卷列表(不分页)
   * @apiGroup 试卷模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/education/paper/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    $condition = [
      ['status', '>', Status::DELETE]
    ];

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getList($condition, $this->_relevance, $this->_order, true);

    return self::success($response);
  }


  /**
   * @api {get} /api/education/paper/view/{id} 获取试卷详情
   * @apiDescription 获取试卷详情
   * @apiGroup 试卷模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/education/paper/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    $condition = [
      ['status', '>', Status::DELETE]
    ];

    $where = ['id' => $id];

    $condition = array_merge($condition, $where);

    $relevance = ['question'];

    $response = $this->_model::getRow($condition, $relevance);

    return self::success($response);
  }
}
