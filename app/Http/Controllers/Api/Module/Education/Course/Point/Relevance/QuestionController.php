<?php
namespace App\Http\Controllers\Api\Module\Education\Course\Point\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-13
 *
 * 课程练习题控制器类
 */
class QuestionController extends BaseController
{
  protected $_model = 'App\Models\Common\Module\Education\Course\Point\Relevance\Question';

  protected $_where = [];

  protected $_params = [];

  protected $_order = [];

  protected $_relevance = [];


  /**
   * @api {post} /api/education/course/point/question/reply 回答练习题
   * @apiDescription 回答练习题
   * @apiGroup 练习题模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} course_id 课程编号
   * @apiParam {int} point_id 知识点编号
   * @apiParam {int} question_id 练习题编号
   * @apiParam {int} result 回答结果 1 正常 2 错误
   * @apiVersion 1.0.0
   */
  public function reply(Request $request)
  {
    $messages = [
      'course_id.required'   => '请您输入课程编号',
      'point_id.required'    => '请您输入知识点编号',
      'question_id.required' => '请您输入练习题编号',
      'result.required'      => '请您输入练习题编号',
    ];

    $validator = Validator::make($request->all(), [
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
      $model = new $this->_model();

      $model->organization_id = self::getOrganizationId();
      $model->member_id       = self::getCurrentId();
      $model->course_id       = $request->course_id;
      $model->point_id        = $request->point_id;
      $model->question_id     = $request->question_id;
      $model->result          = $request->result;

      $response = $model->save();

      if($response)
      {
        return self::success(Code::HANDLE_SUCCESS);
      }
      else
      {
        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }
}
