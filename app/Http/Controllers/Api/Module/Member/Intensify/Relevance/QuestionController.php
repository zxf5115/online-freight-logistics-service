<?php
namespace App\Http\Controllers\Api\Module\Member\Intensify\Relevance;

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
 * 会员强化练习题控制器类
 */
class QuestionController extends BaseController
{
  protected $_model = 'App\Models\Common\Module\Member\Intensify\Question';

  protected $_where = [];

  protected $_params = [];

  protected $_order = [];

  protected $_relevance = [];


  /**
   * @api {post} /api/member/intensify/question/handle 提交强化练习题答案
   * @apiDescription 提交强化练习题答案
   * @apiGroup 考前强化模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} course_id 课程编号
   * @apiParam {int} intensify_id 考前强化编号
   * @apiParam {int} question_id 练习题编号
   * @apiParam {int} result 练习题结果 1 正确 2 错误
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'course_id.required'    => '请您输入课程编号',
      'intensify_id.required' => '请您输入考前强化编号',
      'question_id.required'  => '请您输入练习题编号',
      'result.required'       => '请您输入练习题结果',
    ];

    $validator = Validator::make($request->all(), [
      'course_id'    => 'required',
      'intensify_id' => 'required',
      'question_id'  => 'required',
      'result'       => 'required',
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
          'course_id'       => $request->course_id,
        ];

        $result = MemberCourseRelevance::getRow($where);

        if(empty($result))
        {
          return self::error(Code::ERROR);
        }

        $squad_id = $result->squad_id;

        $model = $this->_model::firstOrNew([
          'organization_id' => $organization_id,
          'squad_id'        => $squad_id,
          'member_id'       => $member_id,
          'course_id'       => $request->course_id,
          'intensify_id'    => $request->intensify_id,
          'question_id'     => $request->question_id,
        ]);

        $model->result = $request->result;

        $response = $model->save();

        $where = [
          'organization_id' => $organization_id,
          'squad_id'        => $squad_id,
          'member_id'       => $member_id,
          'course_id'       => $request->course_id,
        ];

        MemberCourseRelevance::handleQuestionData($request, $organization_id, $squad_id, $member_id);

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
