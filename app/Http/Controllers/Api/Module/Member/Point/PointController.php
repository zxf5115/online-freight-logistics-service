<?php
namespace App\Http\Controllers\Api\Module\Member\Point;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Http\Controllers\Api\BaseController;
use App\Models\Common\Module\Member\Relevance\MemberCourseRelevance;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-11-09
 *
 * 会员知识点控制器类
 */
class PointController extends BaseController
{
  protected $_model = 'App\Models\Common\Module\Education\Course\Point';

  protected $_where = [
    'is_skill' => 1
  ];

  protected $_params = [
    'title'
  ];



  /**
   * @api {get} /api/member/point/list?page={page} 获取会员知识点列表(分页)
   * @apiDescription 获取会员知识点列表(分页)
   * @apiGroup 会员知识点模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} page 当前页数
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    $condition = ['status' => 1];

    $member_id = self::getCurrentId();

    $course = MemberCourseRelevance::getPluck('course_id', ['member_id' => $member_id], false, false, true);

    if(!empty($course))
    {
      $where = [
        ['course_id', $course]
      ];
    }

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order);

    return self::success($response);
  }


  /**
   * @api {get} /api/member/point/select 获取会员知识点列表(不分页)
   * @apiDescription 获取会员知识点列表(不分页)
   * @apiGroup 会员知识点模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/member/point/select
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
   * @api {get} /api/member/point/status/{point_id} 获取当前知识点是否被订阅
   * @apiDescription 获取当前知识点是否被订阅
   * @apiGroup 会员知识点模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/member/point/status/{point_id}
   * @apiVersion 1.0.0
   */
  public function status(Request $request, $point_id)
  {
    $condition = self::getCurrentWhereData();

    $where = ['point_id' => $point_id];

    $condition = array_merge($condition, $where);

    $response = $this->_model::getRow($condition, $this->_relevance);

    return self::success($response);
  }


  /**
   * @api {post} /api/member/point/handle 订购知识点
   * @apiDescription 会员登录进行笔记
   * @apiGroup 会员知识点模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} point_id 知识点编号
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'point_id.required' => '请您输入知识点编号'
    ];

    $validator = Validator::make($request->all(), [
      'point_id' => 'required'
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
      $model->point_id       = $request->point_id;

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
}
