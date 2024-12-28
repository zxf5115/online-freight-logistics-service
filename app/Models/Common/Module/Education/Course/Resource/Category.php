<?php
namespace App\Models\Common\Module\Education\Course\Resource;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-22
 *
 * 课程资料分类模型类
 */
class Category extends Base
{
  // 表名
  public $table = "module_course_resource_category";

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];

  // 批量添加
  public $fillable = ['id'];




  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-25
   * ------------------------------------------
   * 考前强化分类与课程关联函数
   * ------------------------------------------
   *
   * 考前强化分类与课程关联函数
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
   * 课程资料分类与课程资料关联函数
   * ------------------------------------------
   *
   * 课程资料分类与课程资料关联函数
   *
   * @return [关联对象]
   */
  public function resource()
  {
    return $this->hasMany('App\Models\Common\Module\Education\Course\Resource', 'category_id', 'id')
                ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-25
   * ------------------------------------------
   * 课程单元本类关联函数
   * ------------------------------------------
   *
   * 课程单元无限单元下，使用本类进行关联查询
   *
   * @return [type]
   */
  public function children()
  {
    return $this->hasMany(__CLASS__, 'parent_id')
                ->with('children')
                ->where(['status'=>1])
                ->orderBy('sort', 'desc');
  }
}
