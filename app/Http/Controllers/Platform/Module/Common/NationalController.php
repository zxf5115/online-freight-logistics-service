<?php
namespace App\Http\Controllers\Platform\Module\Common;

use Illuminate\Http\Request;

use App\Http\Constant\Code;
use App\Enum\Common\NationalEnum;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-25
 *
 * 民族控制器类
 */
class NationalController extends BaseController
{

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-12
   * ------------------------------------------
   * 获取民族数据
   * ------------------------------------------
   *
   * 获取民族数据
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function list(Request $request)
  {
    try
    {
      $national = NationalEnum::$national;

      $value = array_column($national, 'value');
      $text  = array_column($national, 'text');

      $response = array_combine($value, $text);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      \Log::error($e->getMessage());
    }
  }
}
