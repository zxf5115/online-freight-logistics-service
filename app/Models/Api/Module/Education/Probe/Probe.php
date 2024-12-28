<?php
namespace App\Models\Api\Module\Education\Probe;

use App\Models\Common\Module\Education\Probe\Probe as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-14
 *
 * 探针模型类
 */
class Probe extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'create_time',
    'update_time'
  ];
}
