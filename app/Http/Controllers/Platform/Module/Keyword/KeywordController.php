<?php
namespace App\Http\Controllers\Platform\Module\Keyword;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-25
 *
 * 热门关键字控制器类
 */
class KeywordController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Keyword\Keyword';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'title'
  ];

  // 附加关联查询条件
  protected $_addition = [];

  protected $_order = [
    ['key' => 'total', 'value' => 'desc'],
  ];

  // 关联数组
  protected $_relevance = [];


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
      'title.required' => '请您输入热门标题',
      'total.required' => '请您输入搜索次数',
    ];

    $validator = Validator::make($request->all(), [
      'title' => 'required',
      'total' => 'required',
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

      $model->organization_id = $organization_id;
      $model->title           = $request->title;
      $model->total           = $request->total;
      $model->status          = intval($request->status);

      try
      {
        $response = $model->save();

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }
}
