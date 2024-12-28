<?php
namespace app\Models\Common\Module\Education\Course\Point\Emphasis;

use App\Models\Base;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-24
 *
 * 课程知识点班级模型类
 */
class Squad extends Base
{
  // 表名
  public $table = "module_course_point_emphasis_squad_relevance";

  // 可以批量修改的字段
  public $fillable = [
    'organization_id',
    'emphasis_id',
    'squad_id',
  ];

  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'create_time',
    'update_time'
  ];
}
