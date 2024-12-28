<?php
namespace App\Http\Controllers\Platform\Module\Message;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;

use App\Models\Common\Module\Member\Member;
use App\Models\Common\Module\Member\Relevance\MemberRoleRelevance;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-17
 *
 * Message接口控制器类
 */
class MessageController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Message\Message';

  protected $_where = [
    'type' => 1
  ];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
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
      'title.required'   => '请您输入标题',
      'content.required' => '请您输入内容',
    ];

    $validator = Validator::make($request->all(), [
      'title'   => 'required',
      'content' => 'required',
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
        $model = $this->_model::firstOrNew(['id' => $request->id]);

        $model->type       = 1;
        $model->title      = $request->title;
        $model->content    = $request->content;
        $model->founder_id = 1;
        $model->save();

        $organization_id = $request->organization_id;

        $where = [
          'status' => 1
        ];

        if(empty($organization_id))
        {
          $member_id = Member::getPluck('id', $where, false, false, true);
        }
        else if(-1 == $organization_id)
        {
          $condition = array_merge($where, ['role_id' => 1]);

          $member_id = MemberRoleRelevance::getPluck('user_id', $condition, false, false, true);
        }
        else
        {
          $condition = array_merge($where, ['organization_id' => $organization_id]);

          $member_id = Member::getPluck('id', $where, false, false, true);

          $condition = array_merge($where, ['role_id' => 1], [['user_id', $member_id]]);

          $member_id = MemberRoleRelevance::getPluck('user_id', $condition, false, false, true);
        }

        if(!empty($member_id))
        {
          $data = [];

          foreach($member_id as $key => $item)
          {
            $data[$key]['member_id'] = $item;
          }

          if(!empty($data))
          {
            $model->relevance()->delete();
            $model->relevance()->createMany($data);
          }
        }

        DB::commit();

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        DB::rollback();
dd($e);
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
