<?php
namespace App\Models\Common\Module\Education\Course\Relevance;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-13
 *
 * 课程与课程资料关联模型类
 */
class Resource extends Base
{
  // 表名
  public $table = "module_course_resource_relevance";

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];

  // 批量添加
  public $fillable = [
    'course_id',
    'resource_id'
  ];


  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-25
   * ------------------------------------------
   * 会员资料与资料关联函数
   * ------------------------------------------
   *
   * 会员资料与资料关联函数
   *
   * @return [关联对象]
   */
  public function resource()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Course\Resource', 'resource_id', 'id')
                ->where(['status'=>1]);
  }
}
