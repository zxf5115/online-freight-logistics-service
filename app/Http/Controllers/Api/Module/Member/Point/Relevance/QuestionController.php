<?php
namespace App\Http\Controllers\Api\Module\Member\Point\Relevance;

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
 * 会员知识点练习题控制器类
 */
class QuestionController extends BaseController
{
  protected $_model = 'App\Models\Common\Module\Member\Question\Question';

  protected $_where = [];

  protected $_params = [];

  protected $_order = [];

  protected $_relevance = [];


  /**
   * @api {post} /api/member/point/question/handle 提交练习题答案
   * @apiDescription 提交练习题答案
   * @apiGroup 练习题模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} squad_id 班级编号
   * @apiParam {int} course_id 课程编号
   * @apiParam {int} point_id 知识点编号
   * @apiParam {int} question_id 练习题编号
   * @apiParam {int} type 练习题类型 1 普通类型 2 特殊类型
   * @apiParam {int} result 练习题结果 1 正确 2 错误
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'squad_id.required'    => '请您输入班级编号',
      'course_id.required'   => '请您输入课程编号',
      'point_id.required'    => '请您输入知识点编号',
      'question_id.required' => '请您输入练习题编号',
      'result.required'      => '请您输入练习题结果',
    ];

    $validator = Validator::make($request->all(), [
      'squad_id'    => 'required',
      'course_id'   => 'required',
      'point_id'    => 'required',
      'question_id' => 'required',
      'result'      => 'required',
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

        $model = $this->_model::firstOrNew([
          'organization_id' => $organization_id,
          'member_id' => $member_id,
          'course_id' => $request->course_id,
          'point_id' => $request->point_id,
          'question_id' => $request->question_id,
        ]);

        $model->type   = $request->type ?? 1;
        $model->result = $request->result;

        $response = $model->save();

        MemberCourseRelevance::handleQuestionData($request, $organization_id, $request->squad_id, $member_id, $request->point_id);

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
