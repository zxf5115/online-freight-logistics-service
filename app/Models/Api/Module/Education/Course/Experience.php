<?php
namespace App\Models\Api\Module\Education\Course;

use App\Models\Common\Module\Education\Course\Experience as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-24
 *
 * 课程体验模型类
 */
class Experience extends Common
{
  // 隐藏的属性
  public $hidden = [
    'id',
    'organization_id',
    'status',
    'update_time',
  ];
}
