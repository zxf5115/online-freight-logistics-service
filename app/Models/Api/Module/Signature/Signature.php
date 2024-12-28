<?php
namespace App\Models\Api\Module\Signature;

use App\Models\Common\Module\Signature\Signature as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 签到模型类
 */
class Signature extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'create_time',
    'update_time'
  ];
}
