<?php
namespace App\Http\Controllers\Api\Module\Organization\Squad\Relevance;

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
  protected $_model = 'App\Models\Common\Module\Organization\Squad\Relevance\Course';

  protected $_where = [];

  protected $_params = [
    'squad_id'
  ];

  protected $_addition = [];

  protected $_order = [
    ['key' => 'id', 'value' => 'asc'],
  ];

  protected $_relevance = [
    'course',
  ];


  /**
   * @api {get} /api/organization/squad/course/select 获取班级已选课程列表(不分页)
   * @apiDescription 获取班级已选课程列表(不分页)
   * @apiGroup 班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} squad_id 班级编号
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
}
