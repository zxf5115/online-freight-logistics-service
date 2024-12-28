<?php
namespace App\Http\Controllers\Platform\System\Setting;

use App\Http\Constant\Code;
use Illuminate\Http\Request;
use App\Models\Platform\System\Config;
use App\Models\Platform\System\Config\Category;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-13
 *
 * 支付配置控制器类
 */
class PayConfigController extends BaseController
{
  protected $_model = 'App\Models\Platform\System\Config';

  protected $_where = [];

  protected $_params = [];

  protected $_order = [
    ['key' => 'sort', 'value' => 'asc'],
  ];

  protected $_relevance = 'category';


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-07-13
   * ------------------------------------------
   * 微信支付H5配置
   * ------------------------------------------
   *
   * 配置微信支付H5配置信息
   *
   * @param Request $request 请求数据
   * @return [type]
   */
  public function wxpay_h5(Request $request)
  {
    if($request->isMethod('post'))
    {
      $response = Config::saveConfig($request->all());

      if($response)
      {
        return self::success();
      }

      return self::error(Code::message(Code::HANDLE_FAILURE));
    }

    $where = [
      'title' => 'WXPAY_H5_CONFIG',
      'status' => 1
    ];

    $category = Category::getRow($where);
    $category_id = $category->id ?? 0;
    $where = [
      'category_id' => $category_id
    ];

    $response = $this->_model::getList($where);

    return self::success($response);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-07-13
   * ------------------------------------------
   * 微信支付APP配置
   * ------------------------------------------
   *
   * 配置微信支付APP配置信息
   *
   * @param Request $request 请求数据
   * @return [type]
   */
  public function wxpay_app(Request $request)
  {
    if($request->isMethod('post'))
    {
      $response = Config::saveConfig($request->all());

      if($response)
      {
        return self::success();
      }

      return self::error(Code::message(Code::HANDLE_FAILURE));
    }

    $where = [
      'title' => 'WXPAY_APP_CONFIG',
      'status' => 1
    ];

    $category = Category::getRow($where);
    $category_id = $category->id ?? 0;
    $where = [
      'category_id' => $category_id
    ];

    $response = $this->_model::getList($where);

    return self::success($response);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-07-13
   * ------------------------------------------
   * 微信支付JS配置
   * ------------------------------------------
   *
   * 配置微信支付JS配置信息
   *
   * @param Request $request 请求数据
   * @return [type]
   */
  public function wxpay_js(Request $request)
  {
    if($request->isMethod('post'))
    {
      $response = Config::saveConfig($request->all());

      if($response)
      {
        return self::success();
      }

      return self::error(Code::message(Code::HANDLE_FAILURE));
    }

    $where = [
      'title' => 'WXPAY_JS_CONFIG',
      'status' => 1
    ];

    $category = Category::getRow($where);
    $category_id = $category->id ?? 0;
    $where = [
      'category_id' => $category_id
    ];

    $response = $this->_model::getList($where);

    return self::success($response);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-07-13
   * ------------------------------------------
   * 微信支付MINI配置
   * ------------------------------------------
   *
   * 配置微信支付MINI配置信息
   *
   * @param Request $request 请求数据
   * @return [type]
   */
  public function wxpay_mini(Request $request)
  {
    if($request->isMethod('post'))
    {
      $response = Config::saveConfig($request->all());

      if($response)
      {
        return self::success();
      }

      return self::error(Code::message(Code::HANDLE_FAILURE));
    }

    $where = [
      'title' => 'WXPAY_MINI_CONFIG',
      'status' => 1
    ];

    $category = Category::getRow($where);
    $category_id = $category->id ?? 0;
    $where = [
      'category_id' => $category_id
    ];

    $response = $this->_model::getList($where);

    return self::success($response);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-07-13
   * ------------------------------------------
   * 支付宝支付H5配置
   * ------------------------------------------
   *
   * 配置支付宝支付H5配置信息
   *
   * @param Request $request 请求数据
   * @return [type]
   */
  public function alipay_h5(Request $request)
  {
    if($request->isMethod('post'))
    {
      $response = Config::saveConfig($request->all());

      if($response)
      {
        return self::success();
      }

      return self::error(Code::message(Code::HANDLE_FAILURE));
    }

    $where = [
      'title' => 'ALIPAY_H5_CONFIG',
      'status' => 1
    ];

    $category = Category::getRow($where);
    $category_id = $category->id ?? 0;
    $where = [
      'category_id' => $category_id
    ];

    $response = $this->_model::getList($where);

    return self::success($response);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-07-13
   * ------------------------------------------
   * 微信支付宝app配置
   * ------------------------------------------
   *
   * 配置支付宝支付app配置信息
   *
   * @param Request $request 请求数据
   * @return [type]
   */
  public function alipay_app(Request $request)
  {
    if($request->isMethod('post'))
    {
      $response = Config::saveConfig($request->all());

      if($response)
      {
        return self::success();
      }

      return self::error(Code::message(Code::HANDLE_FAILURE));
    }

    $where = [
      'title' => 'ALIPAY_APP_CONFIG',
      'status' => 1
    ];

    $category = Category::getRow($where);
    $category_id = $category->id ?? 0;
    $where = [
      'category_id' => $category_id
    ];

    $response = $this->_model::getList($where);

    return self::success($response);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-07-13
   * ------------------------------------------
   * 支付宝支付PC配置
   * ------------------------------------------
   *
   * 配置支付宝支付PC配置信息
   *
   * @param Request $request 请求数据
   * @return [type]
   */
  public function alipay_pc(Request $request)
  {
    if($request->isMethod('post'))
    {
      $response = Config::saveConfig($request->all());

      if($response)
      {
        return self::success();
      }

      return self::error(Code::message(Code::HANDLE_FAILURE));
    }

    $where = [
      'title' => 'ALIPAY_PC_CONFIG',
      'status' => 1
    ];

    $category = Category::getRow($where);
    $category_id = $category->id ?? 0;
    $where = [
      'category_id' => $category_id
    ];

    $response = $this->_model::getList($where);

    return self::success($response);
  }
}
