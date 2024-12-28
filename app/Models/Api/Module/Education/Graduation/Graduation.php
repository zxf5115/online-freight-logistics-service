<?php
namespace App\Models\Api\Module\Education\Graduation;

use App\Models\Common\Module\Education\Graduation\Graduation as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-25
 *
 * 结业模型类
 */
class Graduation extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'update_time'
  ];
}
