<?php
namespace App\Models\Common\Module\Education\Course;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-29
 *
 * 课程标签模型类
 */
class Label extends Base
{
  // 表名
  public $table = "module_course_label";

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];

  // 批量添加
  public $fillable = ['id'];




  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-25
   * ------------------------------------------
   * 课程分类与课程关联函数
   * ------------------------------------------
   *
   * 课程分类与课程关联函数
   *
   * @return [关联对象]
   */
  public function course()
  {
    return $this->hasMany('App\Models\Common\Module\Education\Course\Course', 'category_id', 'id')
                ->where(['status'=>1]);
  }
}
