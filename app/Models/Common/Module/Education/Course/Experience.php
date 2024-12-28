<?php
namespace App\Models\Common\Module\Education\Course;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 体验模型类
 */
class Experience extends Base
{
  // 表名
  public $table = "module_course_experience";

  // 可以批量修改的字段
  public $fillable = [
    'id',
    'course_id'
  ];

  // 隐藏的属性
  public $hidden = [];


  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-22
   * ------------------------------------------
   * 体验与课程关联函数
   * ------------------------------------------
   *
   * 体验与课程关联函数
   *
   * @return [关联对象]
   */
  public function course()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Course\Course', 'course_id', 'id')
                ->where(['status'=>1]);
  }
}
