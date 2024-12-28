<?php
namespace App\Http\Controllers\Api\Module\Member\Grade;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Parameter;
use App\Http\Controllers\Api\BaseController;
use App\Models\Common\Module\Education\Course\Course;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 个人学习成绩控制器类
 */
class GradeController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Member\Grade\Grade';

  protected $_where = [];

  protected $_params = [
    'squad_id'
  ];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'squad',
  ];


  /**
   * @api {get} /api/member/grade/center 获取会员成绩中心信息
   * @apiDescription 获取会员成绩中心信息
   * @apiGroup 会员成绩中心模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} squad_id 班级编号
   * @apiSampleRequest /api/member/grade/center
   * @apiVersion 1.0.0
   */
  public function center(Request $request)
  {
    $condition = self::getCurrentWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $filter);

    $response = $this->_model::getRow($condition, $this->_relevance);

    return self::success($response);
  }


  /**
   * @api {get} /api/member/grade/class_after_question 获取课后练习题信息
   * @apiDescription 获取课后练习题信息
   * @apiGroup 会员成绩中心模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} squad_id 班级编号
   * @apiSampleRequest /api/member/grade/class_after_question
   * @apiVersion 1.0.0
   */
  public function class_after_question(Request $request)
  {
    $condition = self::getCurrentWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $filter);

    $relevance = [
      'course'
    ];

    $response = $this->_model::getRow($condition, $relevance);

    return self::success($response);
  }

  /**
   * @api {get} /api/member/grade/class_after_question_detail 课后练习题详情
   * @apiDescription 获取课后练习题详情信息
   * @apiGroup 会员成绩中心模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} squad_id 班级编号
   * @apiSampleRequest /api/member/grade/class_after_question_detail
   * @apiVersion 1.0.0
   */
  public function class_after_question_detail(Request $request)
  {
    try
    {
      $condition = self::getCurrentWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $filter);

      $field = [
        'id',
        'member_id',
        'squad_id',
        'course_id',
        'class_after_question_total',
        'class_after_question_correct_total',
        'class_after_question_error_total',
        'class_after_question_accuracy',
      ];

      $relevance = ['course'];

      $response = $this->_model::getPaging($condition, $relevance, false, false, 10, $field);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      self::record($e);

      return self::error(Code::ERROR);
    }
  }




  /**
   * @api {get} /api/member/grade/comprehensive_question 综合练习题信息
   * @apiDescription 获取综合练习题信息
   * @apiGroup 会员成绩中心模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} squad_id 班级编号
   * @apiSampleRequest /api/member/grade/comprehensive_question
   * @apiVersion 1.0.0
   */
  public function comprehensive_question(Request $request)
  {
    $condition = self::getCurrentWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $filter);

    $relevance = [
      'course'
    ];

    $response = $this->_model::getRow($condition, $relevance);

    return self::success($response);
  }



  /**
   * @api {get} /api/member/grade/comprehensive_question_detail 综合练习题详情
   * @apiDescription 获取综合练习题详情信息
   * @apiGroup 会员成绩中心模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} squad_id 班级编号
   * @apiSampleRequest /api/member/grade/comprehensive_question_detail
   * @apiVersion 1.0.0
   */
  public function comprehensive_question_detail(Request $request)
  {
    try
    {
      $condition = self::getCurrentWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $filter);

      $field = [
        'id',
        'member_id',
        'squad_id',
        'course_id',
        'comprehensive_question_total',
        'comprehensive_question_correct_total',
        'comprehensive_question_error_total',
        'comprehensive_question_accuracy',
      ];

      $relevance = ['course'];

      $response = $this->_model::getPaging($condition, $relevance, false, false, 10, $field);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      self::record($e);

      return self::error(Code::ERROR);
    }
  }




  /**
   * @api {get} /api/member/grade/simulation_exam 获取模拟试卷信息
   * @apiDescription 获取模拟试卷信息
   * @apiGroup 会员成绩中心模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} squad_id 班级编号
   * @apiSampleRequest /api/member/grade/simulation_exam
   * @apiVersion 1.0.0
   */
  public function simulation_exam(Request $request)
  {
    $condition = self::getCurrentWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $filter);

    $relevance = [];

    $response = $this->_model::getRow($condition, $relevance);

    return self::success($response);
  }
}
