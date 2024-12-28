<?php
namespace App\Http\Controllers\Api\Module\Member\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-30
 *
 * 会员课程控制器类
 */
class CourseController extends BaseController
{
  protected $_model = 'App\Models\Common\Module\Member\Relevance\MemberCourseRelevance';

  protected $_where = [];

  protected $_params = [
    'member_id',
    'is_finish'
  ];

  protected $_order = [];

  protected $_relevance = [
    'course'
  ];


  /**
   * @api {get} /api/member/course/list?page={page} 获取会员课程列表(分页)
   * @apiDescription 获取会员课程列表(分页)
   * @apiGroup 会员课程模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} is_finish 是否完成 2 未完成 1 已完成
   * @apiParam {int} page 当前页数
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    $condition = self::getCurrentWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order, false, 9);

    return self::success($response);
  }


  /**
   * @api {get} /api/member/course/select 获取会员课程列表(不分页)
   * @apiDescription 获取会员课程列表(不分页)
   * @apiGroup 会员课程模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} is_finish 是否完成 2 未完成 1 已完成
   * @apiSampleRequest /api/member/course/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    $condition = self::getCurrentWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getList($condition, $this->_relevance, $this->_order, true);

    return self::success($response);
  }


  /**
   * @api {get} /api/member/course/status/{course_id} 获取当前课程是否被订阅
   * @apiDescription 获取当前课程是否被订阅
   * @apiGroup 会员课程模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/member/course/status/{course_id}
   * @apiVersion 1.0.0
   */
  public function status(Request $request, $course_id)
  {
    $condition = self::getCurrentWhereData();

    $where = ['course_id' => $course_id];

    $condition = array_merge($condition, $where);

    $response = $this->_model::getRow($condition, $this->_relevance);

    return self::success($response);
  }


  /**
   * @api {post} /api/member/course/handle 订购课程
   * @apiDescription 会员登录进行笔记
   * @apiGroup 会员课程模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} course_id 课程编号
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'course_id.required' => '请您输入课程编号'
    ];

    $validator = Validator::make($request->all(), [
      'course_id' => 'required'
    ], $messages);


    if($validator->fails())
    {
      $error = $validator->getMessageBag()->toArray();
      $error = array_values($error);
      $message = $error[0][0] ?? Code::$message[Code::ERROR];

      return self::message($message);
    }
    else
    {
      $model = $this->_model::firstOrNew(['id' => $request->id]);

      $model->organization_id = self::getOrganizationId();
      $model->member_id       = self::getCurrentId();
      $model->course_id       = $request->course_id;

      try
      {
        $response = $model->save();

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }


  /**
   * @api {get} /api/member/course/data?page={page} 获取指定学员课程列表(分页)
   * @apiDescription 获取指定学员课程列表(分页)
   * @apiGroup 会员课程模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} member_id 会员编号
   * @apiParam {int} is_finish 是否完成 2 未完成 1 已完成
   * @apiParam {int} page 当前页数
   * @apiVersion 1.0.0
   */
  public function data(Request $request)
  {
    $condition = [['status', '>=', '-1']];

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getList($condition, $this->_relevance, $this->_order);

    return self::success($response);
  }
}
