<?php
namespace App\Models\Common\Module\Organization\Relevance;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-24
 *
 * 机构课程模型类
 */
class Course extends Base
{
  // 表名
  public $table = "module_organization_course_relevance";

  // 可以批量修改的字段
  public $fillable = ['id'];

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];


  // 关联函数 ------------------------------------------------------



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 机构课程与机构关联函数
   * ------------------------------------------
   *
   * 机构课程与机构关联函数
   *
   * @return [关联对象]
   */
  public function organization()
  {
    return $this->belongsTo('App\Models\Common\Module\Organization\Organization', 'organization_id', 'id')
                ->where(['status'=>1]);
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 机构课程与课程关联函数
   * ------------------------------------------
   *
   * 机构课程与课程关联函数
   *
   * @return [关联对象]
   */
  public function course()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Course\Course', 'course_id', 'id')
                ->where(['status'=>1]);
  }

}
