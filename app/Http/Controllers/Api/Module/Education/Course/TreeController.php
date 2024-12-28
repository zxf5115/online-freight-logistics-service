<?php
namespace App\Http\Controllers\Api\Module\Education\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 课程知识树控制器类
 */
class TreeController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Education\Course\Tree';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'id'
  ];

  // 附加关联查询条件
  protected $_addition = [];

  protected $_with = [
    'children' => [
      'parent_id',
    ]
  ];


  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  // 关联数组
  protected $_relevance = [
    'children',
  ];


  /**
   * @api {get} /api/education/course/tree/select 获取课程知识地图列表(不分页)
   * @apiDescription 获取课程知识地图列表(不分页)
   * @apiGroup 知识地图模块
   * @apiParam {int} id 课程编号
   * @apiSampleRequest /api/education/course/tree/select
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

    $response = $this->_model::getList($condition, $this->_relevance, $this->_order);

    return self::success($response);
  }
}
