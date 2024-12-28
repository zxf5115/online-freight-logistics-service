<?php
namespace App\Http\Controllers\Api\System;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

use App\Http\Constant\Code;
use App\Http\Constant\Parameter;
use App\Http\Controllers\Api\BaseController;

use App\Models\Api\System\Config;
use App\Models\Api\Module\Member\Online;
use App\Models\Api\Module\Member\Member;
use App\Models\Api\Module\Organization\Organization;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-26
 *
 * 系统控制器类
 */
class SystemController extends BaseController
{
  protected $_model = 'App\Models\Api\System\Config';

  protected $_where = [];

  protected $_params = [];

  protected $_order = [];

  protected $_relevance = [];


  /**
   * @api {get} /api/system/kernel 1. 系统配置信息
   * @apiDescription 获取系统配置信息
   * @apiGroup 01. 系统模块
   *
   * @apiSuccess (字段说明) {String} web_chinese_name 网站中文名称
   * @apiSuccess (字段说明) {String} web_english_name 网站英文名字
   * @apiSuccess (字段说明) {String} web_url 站点链接
   * @apiSuccess (字段说明) {String} keywords 网站关键字
   * @apiSuccess (字段说明) {String} description 网站描述
   * @apiSuccess (字段说明) {String} logo 网站logo
   * @apiSuccess (字段说明) {String} mobile 公司电话
   * @apiSuccess (字段说明) {String} email 公司邮箱
   * @apiSuccess (字段说明) {String} copyright 备案号
   * @apiSuccess (字段说明) {String} web_status 站点状态
   * @apiSuccess (字段说明) {String} web_close_info 站点关闭原因
   * @apiSuccess (字段说明) {String} contact_mobile 联系电话
   * @apiSuccess (字段说明) {String} qr_code 二维码
   *
   * @apiSampleRequest /api/system/kernel
   * @apiVersion 1.0.0
   */
  public function kernel(Request $request)
  {
    try
    {
      $where = self::getSimpleWhereData(1, 'category_id');

      $response = $this->_model::getList($where);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @api {get} /api/system/data 2. 首页统计数据
   * @apiDescription 获取首页统计数据
   * @apiGroup 01. 系统模块
   *
   * @apiSuccess (字段说明) {Number} online 在线学习人数
   * @apiSuccess (字段说明) {Number} member 系统会员总数
   * @apiSuccess (字段说明) {Number} organization 系统入住机构数
   * @apiSuccess (字段说明) {Number} subsidy 政策性补贴人数
   *
   * @apiSampleRequest /api/system/data
   * @apiVersion 1.0.0
   */
  public function data(Request $request)
  {
    try
    {
      $response     = [];

      $online       = 0;
      $member       = 0;
      $organization = 0;
      $subsidy      = 0;

      // 获取系统配置
      $config = Config::getSystemData();

      // 统计数据盐值
      $salt    = $config['salt'] ?? 0;

      // 政策性补贴人数
      $subsidy = $config['subsidy'] ?? 0;

      // 在线人数
      $online = Online::getCount(['online_status' => 1]);
      $where = self::getSimpleWhereData();
      $member = Member::getCount($where);
      $organization = Organization::getCount($where);

      $online       = $online + $salt;
      $member       = $member + $salt;
      $organization = $organization + $salt;
      $subsidy      = $subsidy + $salt;

      $response = [
        'online'       => $online,
        'member'       => $member,
        'organization' => $organization,
        'subsidy'      => $subsidy,
      ];

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
