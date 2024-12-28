<?php
namespace App\Http\Controllers\Platform\Module\Education\Course\Point\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;


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
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-12
   * ------------------------------------------
   * 函数功能简述
   * ------------------------------------------
   *
   * 具体描述一些细节
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function list(Request $request)
  {
    $id = $request->id;

    $condition = self::getBaseWhereData();

    $where = ['point_id' => $id];

    $condition = array_merge($condition, $this->_where, $where);

    $result = $this->_model::getList($where, false, false, true);

    $response = array_column($result, 'question_id');

    return  self::success($response);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-12
   * ------------------------------------------
   * 操作信息
   * ------------------------------------------
   *
   * 操作信息
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function handle(Request $request)
  {
    $messages = [
      'point_id.required'    => '请您输入课程编号',
      'question_id.required' => '请您输入练习题编号'
    ];

    $validator = Validator::make($request->all(), [
      'point_id'    => 'required',
      'question_id' => 'required'
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
      $model = $this->_model::firstOrNew([
        'point_id' => $request->point_id,
        'question_id' => $request->question_id,
      ]);

      if(!empty($model->id))
      {
        $response = $model->delete();
      }
      else
      {
        $model->point_id = $request->point_id;
        $model->question_id = $request->question_id;

        $response = $model->save();
      }

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
