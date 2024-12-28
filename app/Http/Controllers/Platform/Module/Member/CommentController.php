<?php
namespace App\Http\Controllers\Platform\Module\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-24
 *
 * 会员档案控制器类
 */
class CommentController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Member\Comment';

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  // 关联数组
  protected $_relevance = [
    'member'
  ];


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
      'member_id.required' => '请您输入会员编号',
      'score.required'     => '请您输入评价分数',
      'content.required'   => '请您输入评价内容',
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
        $model = $this->_model::firstOrNew(['id' => $request->id]);

        $model->member_id    = $request->member_id;
        $model->score        = $request->score;
        $model->content      = $request->content;
        $model->appraiser_id = 1;
        $model->save();

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }
}
