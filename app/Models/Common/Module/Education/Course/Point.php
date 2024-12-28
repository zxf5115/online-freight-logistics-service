<?php
namespace App\Models\Common\Module\Education\Course;

use App\Models\Base;
use App\Enum\Module\Education\PointEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 知识点模型类
 */
class Point extends Base
{
  // 表名
  public $table = "module_course_point";

  // 可以批量修改的字段
  public $fillable = [
    'id'
  ];

  // 隐藏的属性
  public $hidden = [];



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-31
   * ------------------------------------------
   * 是否技能封装
   * ------------------------------------------
   *
   * 是否技能封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getIsSkillAttribute($value)
  {
    return PointEnum::getSkillStatus($value);
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
    return PointEnum::getRecommendStatus($value);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-31
   * ------------------------------------------
   * 类型状态封装
   * ------------------------------------------
   *
   * 类型状态封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getTypeAttribute($value)
  {
    return PointEnum::getTypeStatus($value);
  }



  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-22
   * ------------------------------------------
   * 知识点与课程关联函数
   * ------------------------------------------
   *
   * 知识点与课程关联函数
   *
   * @return [关联对象]
   */
  public function course()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Course\Course', 'course_id', 'id')
                ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-22
   * ------------------------------------------
   * 知识点与课程单元关联函数
   * ------------------------------------------
   *
   * 知识点与课程单元关联函数
   *
   * @return [关联对象]
   */
  public function unit()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Course\Unit', 'unit_id', 'id')
                ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-13
   * ------------------------------------------
   * 课程知识点与课程重点关联函数
   * ------------------------------------------
   *
   * 课程知识点与课程重点关联函数
   *
   * @return [关联对象]
   */
  public function emphasis()
  {
    return $this->hasOne('App\Models\Common\Module\Education\Course\Point\Emphasis', 'point_id', 'id')
                ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-12
   * ------------------------------------------
   * 课程知识点与练习题关联函数
   * ------------------------------------------
   *
   * 课程知识点与练习题关联函数
   *
   * @return [关联对象]
   */
  public function question()
  {
    return $this->hasMany('App\Models\Common\Module\Education\Course\Point\Relevance\Question', 'point_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-13
   * ------------------------------------------
   * 课程知识点与已学习课程知识点关联函数
   * ------------------------------------------
   *
   * 课程知识点与已学习课程知识点关联函数
   *
   * @return [关联对象]
   */
  public function memberCourse()
  {
    return $this->hasOne('App\Models\Common\Module\Member\Relevance\MemberCourseRelevance', 'point_id', 'id')
                ->where(['status'=>1]);
  }
}
