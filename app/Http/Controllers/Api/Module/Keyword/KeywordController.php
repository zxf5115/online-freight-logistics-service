<?php
namespace App\Http\Controllers\Api\Module\Keyword;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-25
 *
 * 热门关键字控制器类
 */
class KeywordController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Keyword\Keyword';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [];

  // 附加关联查询条件
  protected $_addition = [];

  protected $_order = [
    ['key' => 'total', 'value' => 'desc'],
  ];

  // 关联数组
  protected $_relevance = [];


  /**
   * @api {get} /api/keyword/list?page={page} 1. 热门关键字列表(分页)
   * @apiDescription 获取当前用户热门关键字列表(分页)
   * @apiGroup 08. 热门关键字模块
   *
   * @apiParam {int} page 当前页数
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    try
    {
      $condition = self::getSimpleWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::success(false);
    }
  }


  /**
   * @api {get} /api/keyword/select 2. 热门关键字列表(不分页)
   * @apiDescription 获取当前用户热门关键字列表(不分页)
   * @apiGroup 08. 热门关键字模块
   *
   * @apiSampleRequest /api/keyword/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    try
    {
      $condition = self::getSimpleWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      $response = $this->_model::getList($condition, $this->_relevance, $this->_order, true, 10);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::success(false);
    }
  }
}
