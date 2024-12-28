<?php
namespace App\Models\Common\Module\Organization\Relevance;

use App\Models\Base;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-20
 *
 * 机构认证模型类
 */
class Certification extends Base
{
  // 表名
  public $table = "module_organization_certification";

  // 可以批量修改的字段
  public $fillable = [
    'id',
    'organization_id',
    'content'
  ];

  // 隐藏的属性
  public $hidden = [];
}
