<?php
namespace App\Http\Controllers\Platform\Module\Advertising;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Models\Advertising\Advertising;
use App\Http\Controllers\Platform\BaseController;
use App\Models\Advertising\AdvertisingPosition;

class PositionController extends BaseController
{
  /**
   * 模型
   */
  protected $_model = 'App\Models\Platform\Module\Advertising\Position';

  /**
   * 排序条件
   */
  protected $_order = [
    ['key' => 'id', 'value' => 'asc'],
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
      'title.required'  => '请您输入广告位标题',
      'width.required'  => '请您输入广告位宽度',
      'height.required' => '请您输入广告位高度',
    ];

    $validator = Validator::make($request->all(), [
      'title' => 'required',
      'width' => 'required',
      'height' => 'required',
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

      $model->organization_id = self::getOrganizationId();
      $model->course_id       = $request->course_id;
      $model->title           = $request->title;
      $model->is_open         = $request->is_open;
      $model->width           = $request->width;
      $model->height          = $request->height;

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
}
