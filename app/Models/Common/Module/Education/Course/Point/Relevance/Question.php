<?php
namespace App\Models\Common\Module\Education\Course\Point\Relevance;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-12
 *
 * 知识点与练习题关联模型类
 */
class Question extends Base
{
  // 表名
  public $table = "module_course_point_question_relevance";

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];

  // 批量添加
  public $fillable = [
    'point_id',
    'question_id'
  ];
}
