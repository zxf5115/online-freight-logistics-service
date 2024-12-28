<?php
namespace App\Http\Controllers\Platform\Module\Advertising;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;
use App\Models\Platform\Module\Advertising\Position;


class AdvertisingController extends BaseController
{
  /**
   * 模型
   */
  protected $_model = 'App\Models\Platform\Module\Advertising\Advertising';

  protected $_where = [];

  protected $_params = [
    'location_id',
  ];

  /**
   * 排序条件
   */
  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'position'
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
      'location_id.required' => '请您输入广告位标题',
      'title.required'       => '请您输入广告标题',
    ];

    $validator = Validator::make($request->all(), [
      'location_id' => 'required',
      'title'       => 'required',
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

      $model->organization_id  = self::getOrganizationId();
      $model->location_id      = $request->location_id;
      $model->title            = $request->title;
      $model->picture          = $request->picture;
      $model->url              = $request->url;
      $model->link             = $request->link;
      $model->sort             = $request->sort;

      $response = $model->save();

      if($response)
      {
        return self::success(Code::message(Code::HANDLE_SUCCESS));
      }
      else
      {
        return self::error(Code::message(Code::HANDLE_FAILURE));
      }
    }
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-07-07
   * ------------------------------------------
   * 获取广告位
   * ------------------------------------------
   *
   * 获取广告位，在不同地方显示不同广告
   *
   * @return [type]
   */
  public function position()
  {
    $where = ['status' => 1, 'is_open' => 1];

    $list = Position::getList($where, false);

    return self::success($list);
  }
}
