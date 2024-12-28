<?php
namespace App\Http\Controllers\Platform\Module\Common;

use Illuminate\Http\Request;

use App\Http\Constant\Code;
use App\Enum\Common\EducationEnum;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-25
 *
 * 教育控制器类
 */
class EducationController extends BaseController
{

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-12
   * ------------------------------------------
   * 获取教育程度数据
   * ------------------------------------------
   *
   * 获取教育程度数据
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function degree(Request $request)
  {
    try
    {
      $degree = EducationEnum::$degree;

      $value = array_column($degree, 'value');
      $text  = array_column($degree, 'text');

      $response = array_combine($value, $text);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      \Log::error($e->getMessage());
    }
  }
}
