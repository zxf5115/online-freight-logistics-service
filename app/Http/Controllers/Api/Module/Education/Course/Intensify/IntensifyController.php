<?php
namespace App\Http\Controllers\Api\Module\Education\Course\Intensify;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-11
 *
 * 考前强化控制器类
 */
class IntensifyController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Education\Course\Intensify';

  protected $_where = [];

  protected $_params = [
    'category_id'
  ];

  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  protected $_relevance = [];


  /**
   * @api {get} /api/education/course/intensify/intensify/select 获取考前强化内容列表(不分页)
   * @apiDescription 获取考前强化内容列表(不分页)
   * @apiGroup 考前强化模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} category_id 分类
   * @apiSampleRequest /api/education/course/intensify/intensify/select
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
   * @api {get} /api/education/course/intensify/intensify/view/{id} 获取考前强化内容详情
   * @apiDescription 获取考前强化内容详情
   * @apiGroup 考前强化模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/education/course/intensify/intensify/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    $condition = [
      ['status', '>', Status::DELETE]
    ];

    $where = ['id' => $id];

    $condition = array_merge($condition, $where);

    $response = $this->_model::getRow($condition, $this->_relevance);

    return self::success($response);
  }
}
