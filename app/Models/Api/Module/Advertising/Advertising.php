<?php
namespace App\Models\Api\Module\Advertising;

use App\Models\Common\Module\Advertising\Advertising as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-06
 *
 * 广告模型类
 */
class Advertising extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'sort',
    'status',
    'create_time',
    'update_time'
  ];

  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 广告与广告位关联函数
   * ------------------------------------------
   *
   * 广告与广告位关联函数
   *
   * @return [关联对象]
   */
  public function position()
  {
    return $this->belongsTo('App\Models\Api\Module\Advertising\Position', 'location_id', 'id')
                ->where(['status'=>1]);
  }
}
