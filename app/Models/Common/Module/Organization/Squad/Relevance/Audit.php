<?php
namespace App\Models\Common\Module\Organization\Squad\Relevance;

use App\Models\Base;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-20
 *
 * 会员详情模型类
 */
class Audit extends Base
{
  // 表名
  public $table = "module_squad_audit";

  // 可以批量修改的字段
  public $fillable = [
    'organization_id',
    'squad_id',
    'content'
  ];

  // 隐藏的属性
  public $hidden = [];
}
