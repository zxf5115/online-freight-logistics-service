<?php
namespace App\Http\Controllers\Api\Module\Member\Study;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Parameter;
use App\Http\Controllers\Api\BaseController;
use App\Models\Api\Module\Education\Probe\Probe;
use App\Models\Common\Module\Education\Course\Course;
use App\Models\Api\Module\Member\Relevance\MemberCourseRelevance;
use App\Models\Api\Module\Member\Study\Progress\Course as StudyCourse;
use App\Models\Api\Module\Member\Study\Progress\Unit as StudyUnit;
use App\Models\Api\Module\Member\Study\Progress\Point as StudyPoint;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 个人学习中心控制器类
 */
class StudyController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Member\Study\Study';

  protected $_where = [];

  protected $_params = [
    'member_id',
    'squad_id'
  ];

  protected $_addition = [];


  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'squad',
    'course'
  ];


  /**
   * @api {get} /api/member/study/center 获取会员学习中心信息
   * @apiDescription 获取会员学习中心信息
   * @apiGroup 会员学习中心模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} member_id 会员编号
   * @apiParam {int} squad_id 班级编号
   * @apiSampleRequest /api/member/study/center
   * @apiVersion 1.0.0
   */
  public function center(Request $request)
  {
    $condition = self::getBaseWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getRow($condition, $this->_relevance);

    return self::success($response);
  }


  /**
   * @api {post} /api/member/study/start_study 开始学习
   * @apiDescription 开始学习
   * @apiGroup 会员学习中心模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} course_id 课程编号
   * @apiParam {string} unit_id 单元编号
   * @apiParam {string} is_first 第一次点击
   * @apiSampleRequest /api/member/study/start_study
   * @apiVersion 1.0.0
   */
  public function start_study(Request $request)
  {
    DB::beginTransaction();

    try
    {
      $organization_id = self::getOrganizationId();
      $member_id       = self::getCurrentId();

      $where = [
        'organization_id' => $organization_id,
        'member_id'       => $member_id,
        'course_id'       => $request->course_id,
      ];

      $response = MemberCourseRelevance::getRow($where);

      if(empty($response))
      {
        return self::error(Code::MEMBER_COURSE_EMPTY);
      }

      $squad_id = $response->squad_id;

      StudyCourse::handleStartCourseProgressData($request, $organization_id, $squad_id, $member_id);

      StudyUnit::handleStartUnitProgressData($request, $organization_id, $squad_id, $member_id);

      MemberCourseRelevance::handleStartMemberCourseData($request, $organization_id, $squad_id, $member_id);

      DB::commit();

      return self::success($response->squad_id);
    }
    catch(\Exception $e)
    {
      DB::rollback();

      return self::error(Code::HANDLE_FAILURE);
    }
  }

  /**
   * @api {post} /api/member/study/point_study 知识点学习
   * @apiDescription 知识点学习
   * @apiGroup 会员学习中心模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} course_id 课程编号
   * @apiParam {string} unit_id 单元编号
   * @apiParam {string} point_id 单元编号
   * @apiParam {string} start_time 结束时间
   * @apiParam {string} end_time 结束时间
   * @apiSampleRequest /api/member/study/point_study
   * @apiVersion 1.0.0
   */
  public function point_study(Request $request)
  {
    DB::beginTransaction();

    try
    {
      $organization_id = self::getOrganizationId();
      $member_id       = self::getCurrentId();

  \Log::error($member_id . '开始学习知识点');

      $where = [
        'organization_id' => $organization_id,
        'member_id'       => $member_id,
        'course_id'       => $request->course_id,
      ];

      $response = MemberCourseRelevance::getRow($where);

      if(empty($response))
      {
        return self::error(Code::MEMBER_COURSE_EMPTY);
      }

      $squad_id = $response->squad_id;

      StudyUnit::handleRecursiveData($request, $organization_id, $squad_id, $member_id);

      $response = StudyPoint::handlePointProgressData($request, $organization_id, $squad_id, $member_id);

      $response = MemberCourseRelevance::handleMemberCourseData($request, $organization_id, $squad_id, $member_id);

      if(!empty($response))
      {
        return self::error($response);
      }

      DB::commit();

      return self::success(Code::HANDLE_SUCCESS);
    }
    catch(\Exception $e)
    {
      DB::rollback();

      return self::error(Code::HANDLE_FAILURE);
    }
  }




  /**
   * @api {post} /api/member/study/end_study 结束学习
   * @apiDescription 结束学习
   * @apiGroup 会员学习中心模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} course_id 课程编号
   * @apiParam {string} unit_id 单元编号
   * @apiSampleRequest /api/member/study/end_study
   * @apiVersion 1.0.0
   */
  public function end_study(Request $request)
  {
    DB::beginTransaction();

    try
    {
      $organization_id = self::getOrganizationId();
      $member_id       = self::getCurrentId();

  \Log::error($member_id . '结束学习');
      $where = [
        'organization_id' => $organization_id,
        'member_id'       => $member_id,
        'course_id'       => $request->course_id,
      ];

      $response = MemberCourseRelevance::getRow($where);

      if(empty($response))
      {
        return self::error(Code::MEMBER_COURSE_EMPTY);
      }

      $squad_id = $response->squad_id;

      $where = self::getCurrentWhereData();

      Probe::where($where)->delete();

      $response = StudyCourse::handleEndCourseProgressData($request, $organization_id, $squad_id, $member_id);

      $response = StudyUnit::handleEndUnitProgressData($request, $organization_id, $squad_id, $member_id);

      $response = MemberCourseRelevance::handleEndMemberCourseData($request, $organization_id, $squad_id, $member_id);

      if(!empty($response))
      {
        return self::error($response);
      }

      DB::commit();

      return self::success(Code::HANDLE_SUCCESS);
    }
    catch(\Exception $e)
    {
      DB::rollback();

      return self::error(Code::HANDLE_FAILURE);
    }
  }


  /**
   * @api {post} /api/member/study/finish 完成知识点学习
   * @apiDescription 完成知识点学习
   * @apiGroup 会员学习中心模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} squad_id 班级编号
   * @apiParam {string} course_id 课程编号
   * @apiParam {string} unit_id 单元编号
   * @apiParam {string} point_id 知识点编号
   * @apiSampleRequest /api/member/study/finish
   * @apiVersion 1.0.0
   */
  public function finish(Request $request)
  {
    $organization_id = self::getOrganizationId();
    $member_id       = self::getCurrentId();

    DB::beginTransaction();

    try
    {
      $where = [
        'organization_id' => $organization_id,
        'member_id'       => $member_id,
        'squad_id'        => $request->squad_id,
        'course_id'       => $request->course_id,
        'unit_id'         => $request->unit_id,
        'point_id'        => $request->point_id
      ];

      $point = StudyPoint::getRow($where);

      if(empty($point))
      {
        return self::error(Code::POINT_EMPTY);
      }

      $point->is_finish = 1;

      $point->save();

      $where = self::getCurrentWhereData();

      Probe::where($where)->delete();


      $where = [
        'organization_id' => $organization_id,
        'member_id'       => $member_id,
        'squad_id'        => $request->squad_id,
        'course_id'       => $request->course_id,
      ];

      $course = MemberCourseRelevance::getRow($where);

      if(empty($point))
      {
        return self::error(Code::MEMBER_COURSE_EMPTY);
      }

      $course_time = StudyPoint::where($where)->sum('courseware_time');

      $where['is_finish'] = 1;

      $already_study_time = StudyPoint::where($where)->sum('courseware_time');

      $wait_study_time = bcsub($course_time, $already_study_time);

      $course->already_study_time = $already_study_time;
      $course->wait_study_time = $wait_study_time;
      $course->save();

      DB::commit();

      return self::success(Code::HANDLE_SUCCESS);
    }
    catch(\Exception $e)
    {
      DB::rollback();

      return self::error(Code::HANDLE_FAILURE);
    }
  }



  /**
   * @api {get} /api/member/study/is_first 是否时第一次学习
   * @apiDescription 是否时第一次学习
   * @apiGroup 会员学习中心模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} squad_id 班级编号
   * @apiParam {string} course_id 课程编号
   * @apiParam {string} unit_id 单元编号
   * @apiParam {string} point_id 知识点编号
   * @apiSampleRequest /api/member/study/is_first
   * @apiVersion 1.0.0
   */
  public function is_first(Request $request)
  {
    try
    {
      $response = true;

      $organization_id = self::getOrganizationId();
      $member_id       = self::getCurrentId();

      $where = [
        'organization_id' => $organization_id,
        'member_id'       => $member_id,
        'squad_id'        => $request->squad_id,
        'course_id'       => $request->course_id,
        'unit_id'         => $request->unit_id,
        'point_id'        => $request->point_id
      ];

      $point = StudyPoint::getRow($where);

      if(!empty($point) && $point->is_finish == 1)
      {
        $response = false;
      }

      return self::success($response);
    }
    catch(\Exception $e)
    {
      return self::error(Code::HANDLE_FAILURE);
    }
  }


  /**
   * @api {post} /api/member/study/already_study_time 已学完时间点
   * @apiDescription 记录当前学员单个知识点已学完时间点
   * @apiGroup 会员学习中心模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} squad_id 班级编号
   * @apiParam {string} course_id 课程编号
   * @apiParam {string} unit_id 单元编号
   * @apiParam {string} point_id 知识点编号
   * @apiParam {string} time 当前已学完时间点（时间戳）
   * @apiSampleRequest /api/member/study/already_study_time
   * @apiVersion 1.0.0
   */
  public function already_study_time(Request $request)
  {
    try
    {
      $response = true;

      $organization_id = self::getOrganizationId();
      $member_id       = self::getCurrentId();

      $where = [
        'organization_id' => $organization_id,
        'member_id'       => $member_id,
        'squad_id'        => $request->squad_id,
        'course_id'       => $request->course_id,
        'unit_id'         => $request->unit_id,
        'point_id'        => $request->point_id
      ];

      $point = StudyPoint::getRow($where);

      $point->already_study_time = $time;
      $point->save();

      return self::success(Code::HANDLE_SUCCESS);
    }
    catch(\Exception $e)
    {
      return self::error(Code::HANDLE_FAILURE);
    }
  }
}
