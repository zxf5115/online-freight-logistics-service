<?php
namespace App\Models\Common\Module\Member\Homework\Relevance;

use App\Models\Base;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-24
 *
 * 会员作业附件模型类
 */
class Attachment extends Base
{
  // 表名
  public $table = "module_member_homework_attachment";

  // 可以批量修改的字段
  public $fillable = [
    'organization_id',
    'title',
    'url'
  ];

  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'create_time',
    'update_time'
  ];
}
