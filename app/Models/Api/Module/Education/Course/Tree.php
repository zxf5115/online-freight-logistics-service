<?php
namespace App\Models\Api\Module\Education\Course;

use App\Models\Common\Module\Education\Course\Course as Common;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-23
 *
 * 课程模型类
 */
class Tree extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [];


  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 课程与课程单元关联函数
   * ------------------------------------------
   *
   * 课程与课程单元关联函数
   *
   * @return [关联对象]
   */
  public function children()
  {
    return $this->hasMany('App\Models\Common\Module\Education\Course\Unit', 'course_id', 'id')
                ->where(['status'=>1])
                ->orderBy('sort', 'desc')->select(['id', 'course_id', 'parent_id', 'title as label']);
  }
}
