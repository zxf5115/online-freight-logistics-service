<?php
namespace App\Models\Api\Module\Keyword;

use App\Models\Common\Module\Keyword\Keyword as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 热门关键字模型类
 */
class Keyword extends Common
{
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
    'id',
    'title',
    'total'
  ];


}
