<?php
namespace App\Models\Common\Module\Education\Course;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-11
 *
 * 课程资料模型类
 */
class Resource extends Base
{
  // 表名
  public $table = "module_course_resource";

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
   * 资料与资料分类关联函数
   * ------------------------------------------
   *
   * 资料与资料分类关联函数
   *
   * @return [关联对象]
   */
  public function category()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Course\Resource\Category', 'category_id', 'id')
                ->where(['status'=>1]);
  }
}
