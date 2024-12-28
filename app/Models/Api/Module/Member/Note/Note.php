<?php
namespace App\Models\Api\Module\Member\Note;

use App\Models\Common\Module\Member\Note\Note as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-24
 *
 * 会员笔记模型类
 */
class Note extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'create_time',
    'update_time'
  ];
}
