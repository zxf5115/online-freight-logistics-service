<?php
namespace App\Http\Controllers\Api\Module\Common;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-20
 *
 * 全国区域控制器类
 */
class AreaController extends BaseController
{
  protected $_model = 'App\Models\Common\Module\Common\Area';

  protected $_where = [
    'parent_id' => 0
  ];

  protected $_params = [
    'id',
    'parent_id'
  ];

  protected $_order = [
    ['key' => 'id', 'value' => 'asc'],
  ];

  protected $_relevance = false;


  /**
   * @api {post} /api/common/area/list 1. 获取地区列表
   * @apiDescription 获取省市县地区列表
   * @apiGroup 03. 公共模块
   *
   * @apiParam {string} parent_id 上级地区编号
   *
   * @apiSuccess (字段说明) {String} id 地区编号
   * @apiSuccess (字段说明) {String} parent_id 上级编号
   * @apiSuccess (字段说明) {String} title 地区名字
   *
   * @apiSampleRequest /api/common/area/list
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    try
    {
      $condition = [
        ['status', '>', Status::DELETE]
      ];
      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      $response = $this->_model::getList($condition, $this->_relevance, $this->_order);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }
}
