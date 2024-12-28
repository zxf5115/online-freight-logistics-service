<?php
namespace App\Http\Controllers\Platform\System;

use App\Http\Constant\Code;
use Illuminate\Http\Request;
use App\Models\Platform\System\Config;
use App\Models\Platform\System\Config\Category;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-09
 *
 * 系统配置控制器类
 */
class SettingController extends BaseController
{
  protected $_model = 'App\Models\Platform\System\Config';

  protected $_where = [];

  protected $_params = [
    'category_id',
  ];

  protected $_order = [
    ['key' => 'id', 'value' => 'asc'],
  ];

  protected $_relevance = 'category';


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-07-09
   * ------------------------------------------
   * 系统配置
   * ------------------------------------------
   *
   * 网站配置信息
   *
   * @param Request $request 请求数据
   * @return [type]
   */
  public function data(Request $request)
  {
    try
    {
      $response = Config::change($request->all());

      if($response)
      {
        return self::success();
      }

      return self::error(Code::HANDLE_FAILURE);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }

}
