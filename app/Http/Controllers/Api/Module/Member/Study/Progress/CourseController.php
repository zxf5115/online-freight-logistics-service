<?php
namespace App\Http\Controllers\Api\Module\Member\Study\Progress;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Parameter;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 会议学习课程进度控制器类
 */
class CourseController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Member\Study\Progress\Course';

  protected $_where = [];

  protected $_params = [
    'squad_id'
  ];

  protected $_order = [
    ['key' => 'id', 'value' => 'asc'],
  ];

  protected $_relevance = [
    'course'
  ];


  /**
   * @api {get} /api/member/study/progress/course/list 获取会员学习课程进度信息
   * @apiDescription 获取会员学习课程进度信息
   * @apiGroup 会员学习进度模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} squad_id 班级编号
   * @apiSampleRequest /api/member/study/progress/course/list
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    $condition = self::getCurrentWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getList($condition, $this->_relevance);

    return self::success($response);
  }
}
