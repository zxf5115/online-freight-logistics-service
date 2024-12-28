<?php
namespace App\Http\Controllers\Api\Module\Member\Paper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Http\Controllers\Api\BaseController;
use App\Models\Api\Module\Member\Relevance\MemberCourseRelevance;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-11-09
 *
 * 会员试卷控制器类
 */
class PaperController extends BaseController
{
  protected $_model = 'App\Models\Common\Module\Member\Paper\Paper';

  protected $_where = [];

  protected $_params = [
    'member_id',
    'squad_id',
    'course_id',
  ];

  protected $_order = [];

  protected $_relevance = [
    'paper',
    'course'
  ];


  /**
   * @api {get} /api/member/paper/list?page={page} 获取用户笔记列表(分页)
   * @apiDescription 获取用户笔记列表(分页)
   * @apiGroup 会员笔记模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} page 当前页数
   * @apiParam {int} squad_id 班级编号（可以为空）
   * @apiParam {int} course_id 课程编号（可以为空）
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
   * @api {get} /api/member/paper/select 获取用户试卷列表(不分页)
   * @apiDescription 获取用户试卷列表(不分页)
   * @apiGroup 会员试卷模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/member/paper/select
   * @apiParam {int} squad_id 班级编号（可以为空）
   * @apiParam {int} course_id 课程编号（可以为空）
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
   * @api {get} /api/member/paper/view/{id} 获取当前用户试卷详情
   * @apiDescription 获取用户试卷详情
   * @apiGroup 会员试卷模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/member/paper/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    $condition = self::getCurrentWhereData();

    $where = ['id' => $id];

    $condition = array_merge($condition, $where);

    $response = $this->_model::getRow($condition, $this->_relevance);

    return self::success($response);
  }



  /**
   * @api {post} /api/member/paper/handle 提交试卷答案
   * @apiDescription 提交试卷答案
   * @apiGroup 会员试卷模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} course_id 课程编号
   * @apiParam {int} intensify_id 考前强化编号
   * @apiParam {int} paper_id 试卷编号
   * @apiParam {int} score 试卷得分
   * @apiParam {int} answer 试卷答案
   * @apiParam {json} example {"course_id":"2","intensify_id":"11","paper_id":"1","score":"85","answer":[{"question_id":1,"result":1},{"question_id":1,"result":2},{"question_id":1,"result":1},{"question_id":1,"result":1},{"question_id":1,"result":1}]}
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'course_id.required'    => '请您输入课程编号',
      'intensify_id.required' => '请您输入考前强化编号',
      'paper_id.required'     => '请您输入试卷编号',
      'score.required'        => '请您输入试卷得分',
      'answer.required'       => '请您输入试卷答案',
    ];

    $validator = Validator::make($request->all(), [
      'course_id'    => 'required',
      'intensify_id' => 'required',
      'paper_id'     => 'required',
      'score'        => 'required',
      'answer'       => 'required',
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
      DB::beginTransaction();

      try
      {
        $organization_id = self::getOrganizationId();
        $member_id       = self::getCurrentId();

        $where = [
          'organization_id' => $organization_id,
          'member_id'       => $member_id,
          'course_id'       => $request->course_id
        ];

        $squad_id = MemberCourseRelevance::getSquadId($where);

        $model = new $this->_model();

        $model->organization_id = $organization_id;
        $model->squad_id        = $squad_id;
        $model->member_id       = $member_id;
        $model->course_id       = $request->course_id;
        $model->intensify_id    = $request->intensify_id;
        $model->paper_id        = $request->paper_id;
        $model->score           = $request->score;

        $response = $model->save();

        $data = json_decode($request->answer, true);

        if(!empty($data))
        {
          foreach($data as &$item)
          {
            $item['organization_id'] = $organization_id;
            $item['squad_id']        = $squad_id;
            $item['member_id']       = $member_id;
            $item['course_id']       = $request->course_id;
            $item['intensify_id']    = $request->intensify_id;
            $item['paper_id']        = $request->paper_id;
          }

          $model->question()->delete();

          $model->question()->createMany($data);
        }

        MemberCourseRelevance::handleSimulationExamData($request, $organization_id, $squad_id, $member_id);

        DB::commit();

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        DB::rollback();

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }
}
