<?php
namespace app\Models\Common\Module\Education\Course\Point\Emphasis;

use App\Models\Base;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-24
 *
 * 课程知识点附件模型类
 */
class Attachment extends Base
{
  // 表名
  public $table = "module_course_point_emphasis_attachment";

  // 可以批量修改的字段
  public $fillable = [
    'organization_id',
    'emphasis_id',
    'title',
    'url',
  ];

  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'create_time',
    'update_time'
  ];
}
