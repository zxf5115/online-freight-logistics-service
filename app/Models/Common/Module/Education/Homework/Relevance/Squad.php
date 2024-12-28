<?php
namespace App\Models\Common\Module\Education\Homework\Relevance;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-14
 *
 * 作业与班级关联模型类
 */
class Squad extends Base
{
  // 表名
  public $table = "module_homework_squad_relevance";

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];

  // 批量添加
  public $fillable = [
    'organization_id',
    'url'
  ];

}
