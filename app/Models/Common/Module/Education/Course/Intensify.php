<?php
namespace App\Models\Common\Module\Education\Course;

use App\Models\Base;
use App\Enum\Module\Education\IntensifyEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-11
 *
 * 考前强化模型类
 */
class Intensify extends Base
{
  // 表名
  public $table = "module_course_intensify";

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];

  // 批量添加
  public $fillable = ['id'];


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
  public function getTypeAttribute($value)
  {
    return IntensifyEnum::getTypeStatus($value);
  }


  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-25
   * ------------------------------------------
   * 资料与课程关联函数
   * ------------------------------------------
   *
   * 资料与课程关联函数
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
   * @dateTime 2020-09-25
   * ------------------------------------------
   * 资料与资料分类关联函数
   * ------------------------------------------
   *
   * 资料与资料分类关联函数
   *
   * @return [关联对象]
   */
  public function category()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Course\Intensify\Category', 'category_id', 'id')
                ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-28
   * ------------------------------------------
   * 考前强化与试题关联函数
   * ------------------------------------------
   *
   * 考前强化与试题关联函数
   *
   * @return [关联对象]
   */
  public function questionRelevance()
  {
    return $this->hasMany('App\Models\Common\Module\Education\Course\Intensify\Question\Question', 'intensify_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-25
   * ------------------------------------------
   * 考前强化与试卷关联函数
   * ------------------------------------------
   *
   * 考前强化与试卷关联函数
   *
   * @return [关联对象]
   */
  public function question()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Education\Course\Intensify\Question',
      'module_course_intensify_question_relevance',
      'intensify_id',
      'question_id'
    )->wherePivot('status', 1);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-28
   * ------------------------------------------
   * 考前强化与试卷关联函数
   * ------------------------------------------
   *
   * 考前强化与试卷关联函数
   *
   * @return [关联对象]
   */
  public function paperRelevance()
  {
    return $this->hasMany('App\Models\Common\Module\Education\Course\Intensify\Paper', 'intensify_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-25
   * ------------------------------------------
   * 考前强化与试卷关联函数
   * ------------------------------------------
   *
   * 考前强化与试卷关联函数
   *
   * @return [关联对象]
   */
  public function paper()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Education\Paper\Paper',
      'module_course_intensify_paper_relevance',
      'intensify_id',
      'paper_id'
    )->wherePivot('status', 1);
  }
}
