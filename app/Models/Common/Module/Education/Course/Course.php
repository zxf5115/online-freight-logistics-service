<?php
namespace App\Models\Common\Module\Education\Course;

use App\Models\Base;
use App\Enum\Module\Education\CourseEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 课程模型类
 */
class Course extends Base
{
  // 表名
  public $table = "module_course";

  // 可以批量修改的字段
  public $fillable = [
    'id'
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [];

  // 隐藏的属性
  public $hidden = [];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-31
   * ------------------------------------------
   * 课程类型封装
   * ------------------------------------------
   *
   * 课程类型封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getTypeAttribute($value)
  {
    return CourseEnum::getTypeStatus($value);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-31
   * ------------------------------------------
   * 推荐状态封装
   * ------------------------------------------
   *
   * 推荐状态封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getIsRecommendAttribute($value)
  {
    return CourseEnum::getRecommendStatus($value);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-31
   * ------------------------------------------
   * 显示状态封装
   * ------------------------------------------
   *
   * 显示状态封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getIsHiddenAttribute($value)
  {
    return CourseEnum::getHiddenStatus($value);
  }


  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-28
   * ------------------------------------------
   * 课程与课程标签关联函数
   * ------------------------------------------
   *
   * 课程与课程标签关联函数
   *
   * @return [关联对象]
   */
  public function labelRelevance()
  {
    return $this->hasMany('App\Models\Common\Module\Education\Course\Relevance\Label', 'course_id', 'id');
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-29
   * ------------------------------------------
   * 课程与课程标签函数
   * ------------------------------------------
   *
   * 课程与课程标签函数
   *
   * @return [关联对象]
   */
  public function label()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Education\Course\Label',
      'module_course_label_relevance',
      'course_id',
      'label_id'
    )->wherePivot('status', 1);
  }


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
  public function unit()
  {
    return $this->hasMany('App\Models\Common\Module\Education\Course\Unit', 'course_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 课程与课程知识点关联函数
   * ------------------------------------------
   *
   * 课程与课程知识点关联函数
   *
   * @return [关联对象]
   */
  public function point()
  {
    return $this->hasMany('App\Models\Common\Module\Education\Course\Point', 'course_id', 'id');
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-13
   * ------------------------------------------
   * 课程与课程资料关联函数
   * ------------------------------------------
   *
   * 课程与课程资料关联函数
   *
   * @return [关联对象]
   */
  public function resource()
  {
    return $this->hasMany('App\Models\Common\Module\Education\Course\Resource\Category', 'course_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-13
   * ------------------------------------------
   * 课程与已学习课程关联函数
   * ------------------------------------------
   *
   * 课程与已学习课程关联函数
   *
   * @return [关联对象]
   */
  public function memberCourse()
  {
    return $this->hasOne('App\Models\Common\Module\Member\Relevance\MemberCourseRelevance', 'course_id', 'id')
                ->where(['status'=>1]);
  }
}
