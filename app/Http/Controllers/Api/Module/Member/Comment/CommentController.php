<?php
namespace App\Http\Controllers\Api\Module\Member\Comment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-24
 *
 * 会员评论控制器类
 */
class CommentController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Member\Comment';

  protected $_params = [
    'member_id',
    'appraiser_id',
  ];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'appraiser',
  ];


  /**
   * @api {get} /api/member/comment/list?page={page} 获取会员评论列表(分页)
   * @apiDescription 获取会员评论列表(分页)
   * @apiGroup 会员评论模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} page 当前页数
   * @apiParam {int} member_id 会员编号（可以为空）
   * @apiParam {int} appraiser_id 评价人编号（可以为空）
   *
   * @apiSuccess {int} member_id 学员编号
   * @apiSuccess {int} score 评价分数
   * @apiSuccess {int} content 评价内容
   * @apiSuccess {int} appraiser_id 评价人
   * @apiSuccess {int} create_time 评价时间
   *
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    $condition = self::getCurrentWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order);

    return self::success($response);
  }


  /**
   * @api {get} /api/member/comment/select 获取会员评论列表(不分页)
   * @apiDescription 获取会员评论列表(不分页)
   * @apiGroup 会员评论模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/member/comment/select
   * @apiParam {int} member_id 会员编号（可以为空）
   * @apiParam {int} appraiser_id 评价人编号（可以为空）
   *
   * @apiSuccess {int} member_id 学员编号
   * @apiSuccess {int} score 评价分数
   * @apiSuccess {int} content 评价内容
   * @apiSuccess {int} appraiser_id 评价人
   * @apiSuccess {int} create_time 评价时间
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
   * @api {get} /api/member/comment/view/{id} 获取会员评论详情
   * @apiDescription 获取会员评论详情
   * @apiGroup 会员评论模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/member/comment/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    $condition = self::getBaseWhereData();

    $where = ['id' => $id];

    $condition = array_merge($condition, $where);

    $response = $this->_model::getRow($condition, $this->_relevance);

    return self::success($response);
  }


  /**
   * @api {post} /api/member/comment/handle 评论操作
   * @apiDescription 评论操作
   * @apiGroup 会员评论模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} member_id 学员编号（不能为空）
   * @apiParam {int} score 评价分数1-5（不能为空）
   * @apiParam {string} content 评价内容（不能为空）
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'member_id.required' => '请您输入作业编号',
      'score.required'     => '请您输入作业答案',
      'content.required'   => '请您输入作业答案',
    ];

    $validator = Validator::make($request->all(), [
      'member_id' => 'required',
      'score'     => 'required',
      'content'   => 'required',
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
      try
      {
        $organization_id = self::getOrganizationId();
        $appraiser_id       = self::getCurrentId();

        $model = $this->_model::firstOrNew(['id' => $request->id]);

        $model->organization_id = $organization_id;
        $model->member_id       = $request->member_id;
        $model->score           = $request->score;
        $model->content         = $request->content;
        $model->appraiser_id    = $appraiser_id;
        $model->save();

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        self::record($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }


  /**
   * @api {post} /api/member/comment/delete 删除会员评论
   * @apiDescription 删除会员评论
   * @apiGroup 会员评论模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} id 评论编号
   * @apiSampleRequest /api/member/comment/delete
   * @apiVersion 1.0.0
   */
  public function delete(Request $request)
  {
    try
    {
      $condition = self::getBaseWhereData();

      $id = json_decode($request->id) ?? [0];

      $response = $this->_model::remove($id);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      return self::error(Code::ERROR);
    }
  }
}
