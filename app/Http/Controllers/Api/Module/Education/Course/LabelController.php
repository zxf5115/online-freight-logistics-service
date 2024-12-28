<?php
namespace App\Http\Controllers\Api\Module\Education\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-24
 *
 * 课程标签标签控制器类
 */
class LabelController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Education\Course\Label';

  protected $_where = [];

  protected $_params = [
    'title'
  ];

  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  protected $_relevance = [];


  /**
   * @api {get} /api/education/course/label/list?page={page} 获取课程标签列表(分页)
   * @apiDescription 获取课程标签列表(分页)
   * @apiGroup 课程标签模块
   * @apiParam {int} page 当前页数
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    $condition = self::getBaseWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order);

    return self::success($response);
  }


  /**
   * @api {get} /api/education/course/label/select 获取课程标签列表(不分页)
   * @apiDescription 获取课程标签列表(不分页)
   * @apiGroup 课程标签模块
   * @apiSampleRequest /api/education/course/label/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    $condition = self::getBaseWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getList($condition, $this->_relevance, $this->_order, true);

    return self::success($response);
  }
}
