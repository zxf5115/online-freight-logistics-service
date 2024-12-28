<?php
namespace App\Models\Common\Module\Education\Homework;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-14
 *
 * 作业模型类
 */
class Homework extends Base
{
  // 表名
  public $table = "module_homework";

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [];

  // 批量添加
  public $fillable = ['id'];


  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-13
   * ------------------------------------------
   * 作业与课程关联函数
   * ------------------------------------------
   *
   * 作业与课程关联函数
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
   * @dateTime 2020-10-13
   * ------------------------------------------
   * 作业与班级关联函数
   * ------------------------------------------
   *
   * 作业与班级关联函数
   *
   * @return [关联对象]
   */
  public function squad()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Organization\Squad\Squad',
      'module_homework_squad_relevance',
      'homework_id',
      'squad_id'
    )->wherePivot('status', 1);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-13
   * ------------------------------------------
   * 作业与班级关联函数
   * ------------------------------------------
   *
   * 作业与班级关联函数
   *
   * @return [关联对象]
   */
  public function squadRelevance()
  {
    return $this->hasMany('App\Models\Common\Module\Education\Homework\Relevance\Squad', 'homework_id', 'id')
                ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-14
   * ------------------------------------------
   * 作业与作业资源关联函数
   * ------------------------------------------
   *
   * 作业与作业资源关联函数
   *
   * @return [关联对象]
   */
  public function resource()
  {
    return $this->hasMany('App\Models\Common\Module\Education\Homework\Relevance\Resource', 'homework_id', 'id')
                ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 会员作业与作业答案关联表
   * ------------------------------------------
   *
   * 会员作业与作业答案关联表
   *
   * @return [关联对象]
   */
  public function answer()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Member\Member',
      'module_member_homework_relevance',
      'homework_id',
      'member_id'
    )->withPivot('answer', 'result', 'remark')->wherePivot('status', 1);
  }
}
