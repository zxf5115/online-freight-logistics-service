<?php
namespace App\Models\Common\Module\Organization\Squad\Relevance;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-19
 *
 * 班级与课程模型类
 */
class Course extends Base
{
  // 表名
  public $table = "module_squad_course_relevance";

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [];

  // 批量添加
  public $fillable = ['squad_id', 'course_id'];



  // 关联函数 ------------------------------------------------------


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 班级所选课程与课程关联函数
   * ------------------------------------------
   *
   * 班级所选课程与课程关联函数
   *
   * @return [关联对象]
   */
  public function course()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Course\Course', 'course_id', 'id')
                ->where('status', 1);
  }
}
