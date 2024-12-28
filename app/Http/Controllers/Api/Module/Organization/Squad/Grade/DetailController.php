<?php
namespace App\Http\Controllers\Api\Module\Organization\Squad\Grade;

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
 * 机构班级成绩控制器类
 */
class DetailController extends BaseController
{
  protected $_model = 'App\Models\Common\Module\Member\Relevance\MemberCourseRelevance';

  protected $_where = [];

  protected $_params = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'member',
    'course'
  ];

  /**
   * @api {get} /api/organization/squad/grade/class_after_question 获取课后练习题信息
   * @apiDescription 获取课后练习题信息
   * @apiGroup 机构成绩中心模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} page 当前页数
   * @apiParam {int} squad_id 班级编号
   * @apiSampleRequest /api/organization/squad/grade/class_after_question
   * @apiVersion 1.0.0
   */
  public function class_after_question(Request $request, $squad_id)
  {
    $condition = self::getBaseWhereData();

    $where = ['squad_id' => $squad_id];

    $condition = array_merge($condition, $where);

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order);

    return self::success($response);
  }


  /**
   * @api {get} /api/organization/squad/grade/comprehensive_question 获取综合练习题信息
   * @apiDescription 获取综合练习题信息
   * @apiGroup 机构成绩中心模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} page 当前页数
   * @apiParam {int} squad_id 班级编号
   * @apiSampleRequest /api/organization/squad/grade/comprehensive_question
   * @apiVersion 1.0.0
   */
  public function comprehensive_question(Request $request, $squad_id)
  {
    $condition = self::getBaseWhereData();

    $where = ['squad_id' => $squad_id];

    $condition = array_merge($condition, $where);

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order);

    return self::success($response);
  }


  /**
   * @api {get} /api/organization/squad/grade/simulation_exam 获取模拟试卷信息
   * @apiDescription 获取模拟试卷信息
   * @apiGroup 机构成绩中心模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} page 当前页数
   * @apiParam {int} squad_id 班级编号
   * @apiSampleRequest /api/organization/squad/grade/simulation_exam
   * @apiVersion 1.0.0
   */
  public function simulation_exam(Request $request, $squad_id)
  {
    $condition = self::getBaseWhereData();

    $where = ['squad_id' => $squad_id];

    $condition = array_merge($condition, $where);

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order);

    return self::success($response);
  }
}
