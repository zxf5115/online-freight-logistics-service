<?php
namespace App\Http\Controllers\Api\Module\Education\Course\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;
use App\Events\Api\Organization\OperateLogEvent;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-13
 *
 * 课程资料控制器类
 */
class ResourceController extends BaseController
{
  protected $_model = 'App\Models\Common\Module\Education\Course\Relevance\Resource';

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

    $where = ['course_id' => $id];

    $condition = array_merge($condition, $this->_where, $where);

    $result = $this->_model::getList($where, false, false, true);

    $response = array_column($result, 'resource_id');

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
      'course_id.required'   => '请您输入课程编号',
      'resource_id.required' => '请您输入课程资料编号'
    ];

    $validator = Validator::make($request->all(), [
      'course_id' => 'required',
      'resource_id' => 'required'
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
        'course_id' => $request->course_id,
        'resource_id' => $request->resource_id,
      ]);

      if(!empty($model->id))
      {
        $response = $model->delete();
      }
      else
      {
        $model->course_id = $request->course_id;
        $model->resource_id = $request->resource_id;

        // 记录操作行为日志
        event(new OperateLogEvent($this->user, $request));

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
