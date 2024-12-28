<?php
namespace App\Models\Api\Module\Message;

use App\Models\Common\Module\Message\Message as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 消息模型类
 */
class Message extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];

  // 批量添加
  public $fillable = [
    'id',
    'title',
    'content'
  ];
}
