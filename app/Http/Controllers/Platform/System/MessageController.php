<?php
namespace App\Http\Controllers\Platform\System;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;
use App\Models\Platform\System\User\UserMessageRelevance;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-17
 *
 * Message接口控制器类
 */
class MessageController extends BaseController
{
  protected $_model = 'App\Models\Platform\System\Message';

  protected $_where = [];

  protected $_params = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'user',
  ];




  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-25
   * ------------------------------------------
   * 新增系统消息
   * ------------------------------------------
   *
   * 具体描述一些细节
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function handle(Request $request)
  {
    $messages = [
      'type.required'    => '请您输入消息类型',
      'title.required'   => '请您输入标题',
      'content.required' => '请您输入内容',
    ];

    $validator = Validator::make($request->all(), [
      'title' => 'required',
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

      $organization_id = self::getOrganizationId();
      $current_id = self::getCurrentId();

      $model->organization_id = $organization_id;
      $model->type        = intval($request->type);
      $model->title       = $request->title;
      $model->content     = strval($request->content);
      $model->accept_type = $request->accept_type;
      $model->author      = $request->author;

      // 获取推送用户
      $users = $this->_model::getUsers($request, $current_id, $organization_id);

      DB::beginTransaction();

      try
      {
        $response = $model->save();

        $model->relevance()->delete();

        $relevance = $model->relevance()->createMany($users);

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



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-23
   * ------------------------------------------
   * 获取消息类型
   * ------------------------------------------
   *
   * 获取消息类型
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function type(Request $request)
  {
    try
    {
      $response = $this->_model::getTypeTextList();

      return self::success($response);
    }
    catch(\Exception $e)
    {
      self::local($e);

      return self::error(Code::$message[Code::ERROR]);
    }
  }
}
