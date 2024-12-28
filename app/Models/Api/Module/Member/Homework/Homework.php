<?php
namespace App\Models\Api\Module\Member\Homework;

use App\Models\Common\Module\Member\Homework\Homework as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-24
 *
 * 会员笔记模型类
 */
class Homework extends Common
{
  use \Awobaz\Compoships\Compoships;

  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'create_time',
    'update_time'
  ];
}
