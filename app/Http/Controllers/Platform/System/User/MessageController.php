<?php
namespace App\Http\Controllers\Platform\System\User;

use App\Http\Constant\Code;
use Illuminate\Http\Request;
use App\Models\Platform\System\Message;
use Illuminate\Support\Facades\Validator;
use App\Models\Platform\System\User\UserMessageRelevance;
use App\Http\Controllers\Platform\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-14
 *
 * 用户控制器类
 */
class MessageController extends BaseController
{
  protected $_model = 'App\Models\Platform\System\User';

  protected $_where = [];

  protected $_params = [
    'title'
  ];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'role',
    'asset',
    'invite'
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-27
   * ------------------------------------------
   * 当前用户消息
   * ------------------------------------------
   *
   * 当前用户消息
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function list(Request $request)
  {
    try
    {
      $user_id = self::getCurrentId();

      $unread = UserMessageRelevance::where(['user_id' => $user_id])->with(['message'=>function($query){
        $query->where(['status'=>1]);
      }])->where(['status'=>1])->get();

      $unread_count = count($unread) > 0 ? count($unread) : '';


      $readed =  UserMessageRelevance::where(['user_id' => $user_id])->with(['message'=>function($query){
        $query->where(['status'=>1]);
      }])->where(['status'=>2 ])->paginate(10);

      $response = [
        'unread'       => $unread,
        'unread_count' => $unread_count,
        'readed'       => $readed,
      ];

      return self::success($response);
    }
    catch(\Exception $e)
    {
      self::local($e);

      return self::error(Code::$message[Code::ERROR]);
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-22
   * ------------------------------------------
   * 是否存在未读消息
   * ------------------------------------------
   *
   * 是否存在未读消息
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function unread(Request $request)
  {
    try
    {
      $user_id = $this->user->id;

      $response = UserMessageRelevance::getCount(['user_id' => $user_id, 'status' => 1]);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      return self::error(Code::$message[Code::ERROR]);
    }
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-２8
   * ------------------------------------------
   * 消息设置为已读
   * ------------------------------------------
   *
   * 消息设置为已读
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function readed(Request $request)
  {
    try
    {
      $id = $request->id ?? '';

      $current_id = self::getCurrentId();

      // 设置为已读
      $response = UserMessageRelevance::setReaded($id, $current_id);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      return self::error(Code::$message[Code::ERROR]);
    }
  }




  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-28
   * ------------------------------------------
   * 函数功能简述
   * ------------------------------------------
   *
   * 具体描述一些细节
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function delete(Request $request)
  {
    try
    {
      $id = $request->id ?? '';
      $user_id = self::getCurrentId();

      $model = UserMessageRelevance::where(['user_id' => $user_id])->where(['status' => 2]);

      if($id > 0)
      {
        $model = $model->where(['id' => $id]);
      }

      $model->delete();

      return self::success(Code::$message[Code::HANDLE_SUCCESS]);
    }
    catch(\Exception $e)
    {
      self::log($e);

      return self::error(Code::$message[Code::HANDLE_FAILURE]);
    }
  }
}
