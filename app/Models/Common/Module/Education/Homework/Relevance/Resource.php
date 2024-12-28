<?php
namespace App\Models\Common\Module\Education\Homework\Relevance;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-14
 *
 * 作业与作业资源关联模型类
 */
class Resource extends Base
{
  // 表名
  public $table = "module_homework_resource";

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
  public $fillable = [
    'organization_id',
    'title',
    'url',
  ];

}
