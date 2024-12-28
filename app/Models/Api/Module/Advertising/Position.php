<?php
namespace App\Models\Api\Module\Advertising;

use App\Models\Common\Module\Advertising\Position as Common;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-06
 *
 * 广告位模型类
 */
class Position extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'width',
    'height',
    'is_open',
    'sort',
    'status',
    'create_time',
    'update_time'
  ];
}
