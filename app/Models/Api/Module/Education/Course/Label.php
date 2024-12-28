<?php
namespace App\Models\Api\Module\Education\Course;

use App\Models\Common\Module\Education\Course\Label as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-29
 *
 * 课程标签模型类
 */
class Label extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'create_time',
    'update_time'
  ];
}
