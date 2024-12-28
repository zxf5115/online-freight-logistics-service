<?php
namespace App\Http\Controllers\Api\Module\Education\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Events\Api\KeywordEvent;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-22
 *
 * 知识点知识点控制器类
 */
class ResourceController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Education\Course\Resource\Category';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'course_id',
    'title'
  ];

  // 附加关联查询条件
  protected $_addition = [];

  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  // 关联数组
  protected $_relevance = [
    'resource'
  ];


  /**
   * @api {get} /api/education/course/resource/list?page={page} 获取课程资料列表(分页)
   * @apiDescription 获取课程资料列表(分页)
   * @apiGroup 课程资料模块
   * @apiParam {int} page 当前页数
   * @apiParam {int} course_id 课程编号
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

    if(!empty($request->title))
    {
      // 保存热搜关键字
      event(new KeywordEvent($request->title));
    }

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order);

    return self::success($response);
  }


  /**
   * @api {get} /api/education/course/resource/select 获取课程资料列表(不分页)
   * @apiDescription 获取课程资料列表(不分页)
   * @apiGroup 课程资料模块
   * @apiParam {int} course_id 课程编号
   * @apiSampleRequest /api/education/course/resource/select
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
   * @api {get} /api/education/course/resource/view/{id} 获取课程资料详情
   * @apiDescription 获取课程资料详情
   * @apiGroup 课程资料模块
   * @apiSampleRequest /api/education/course/resource/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    $condition = [
      ['status', '>', Status::DELETE]
    ];

    $where = [
      'id' => $id
    ];

    $condition = array_merge($condition, $where);

    $response = $this->_model::getRow($condition, $this->_relevance);

    return self::success($response);
  }
}
