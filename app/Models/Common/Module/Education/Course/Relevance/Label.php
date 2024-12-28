<?php
namespace App\Models\Common\Module\Education\Course\Relevance;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-29
 *
 * 课程与课程标签关联模型类
 */
class Label extends Base
{
  // 表名
  public $table = "module_course_label_relevance";

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];

  // 批量添加
  public $fillable = [
    'course_id',
    'label_id'
  ];
}
