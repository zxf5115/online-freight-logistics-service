<?php
namespace App\Http\Controllers\Api\Module\Organization\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\TraitClass\ToolTrait;
use App\Http\Constant\Parameter;
use App\Events\Common\Message\SmsEvent;
use App\Events\Common\Message\EmailEvent;
use App\Http\Controllers\Api\BaseController;
use App\Models\Api\Module\Member\Archive;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 班级课程控制器类
 */
class CourseController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Organization\Relevance\Course';

  protected $_where = [];

  protected $_params = [
    'course_id'
  ];

  protected $_addition = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'course',
  ];


  /**
   * @api {get} /api/organization/course/list?page={page} 获取机构课程列表(分页)
   * @apiDescription 获取机构课程列表(分页)
   * @apiGroup 机构课程模块
   * @apiParam {string} token JWTtoken
   * @apiParam {int} page 当前页数
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    $condition = self::getBaseWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order, false, 12);

    return self::success($response);
  }


  /**
   * @api {get} /api/organization/course/select 获取机构课程列表(不分页)
   * @apiDescription 获取机构课程列表(不分页)
   * @apiGroup 机构课程模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    $condition = self::getBaseWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getList($condition, $this->_relevance, $this->_order);

    return self::success($response);
  }


  /**
   * @api {get} /api/organization/course/watch 是否可以观看课程
   * @apiDescription 获取当前用户是否可以观看课程
   * @apiGroup 机构课程模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} course_id 课程编号
   * @apiVersion 1.0.0
   */
  public function watch(Request $request)
  {
    $response = true;

    $condition = self::getBaseWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $result = $this->_model::getRow($condition);

    if(empty($result))
    {
      return self::error(Code::ORGANIZATION_NO_PAY_COURSE);
    }

    return self::success($response);
  }
}
