<?php
namespace App\Models\Common\Module\Education\Course\Point;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-13
 *
 * 知识点重点模型类
 */
class Emphasis extends Base
{
  // 表名
  public $table = "module_course_point_emphasis";

  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'create_time',
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];

  // 批量添加
  public $fillable = ['id'];


  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-22
   * ------------------------------------------
   * 课程知识点与知识点附件关联函数
   * ------------------------------------------
   *
   * 课程知识点与知识点附件关联函数
   *
   * @return [关联对象]
   */
  public function attachment()
  {
    return $this->hasMany('App\Models\Common\Module\Education\Course\Point\Emphasis\Attachment', 'emphasis_id', 'id')
                ->where(['status'=>1]);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-29
   * ------------------------------------------
   * 课程知识点重点提示与班级函数
   * ------------------------------------------
   *
   * 课程知识点重点提示与班级函数
   *
   * @return [关联对象]
   */
  public function squad()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Organization\Squad\Squad',
      'module_course_point_emphasis_squad_relevance',
      'emphasis_id',
      'squad_id'
    )->wherePivot('status', 1);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-22
   * ------------------------------------------
   * 课程知识点重点提示与班级函数
   * ------------------------------------------
   *
   * 课程知识点重点提示与班级函数
   *
   * @return [关联对象]
   */
  public function squadRelevance()
  {
    return $this->hasMany('App\Models\Common\Module\Education\Course\Point\Emphasis\Squad', 'emphasis_id', 'id')
                ->where(['status'=>1]);
  }
}
