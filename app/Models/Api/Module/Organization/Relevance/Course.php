<?php
namespace App\Models\Api\Module\Organization\Relevance;

use App\Models\Common\Module\Organization\Relevance\Course as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-04
 *
 * 机构课程模型类
 */
class Course extends Common
{
  // 隐藏的属性
  public $hidden = [
    'status',
    'update_time'
  ];
}
