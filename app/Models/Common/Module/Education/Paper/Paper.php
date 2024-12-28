<?php
namespace App\Models\Common\Module\Education\Paper;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-14
 *
 * 试卷模型类
 */
class Paper extends Base
{
  // 表名
  public $table = "module_paper";

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
   * 作业与课程关联函数
   * ------------------------------------------
   *
   * 作业与课程关联函数
   *
   * @return [关联对象]
   */
  public function question()
  {
    return $this->hasMany('App\Models\Common\Module\Education\Paper\Relevance\Question', 'paper_id', 'id')
                ->where(['status'=>1]);
  }
}
