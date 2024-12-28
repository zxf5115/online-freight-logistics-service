<?php
namespace App\Models\Common\Module\Member\Relevance;

use App\Models\Base;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-24
 *
 * 会员详情模型类
 */
class Detail extends Base
{
  // 表名
  public $table = "module_member_detail";

  // 可以批量修改的字段
  public $fillable = [];

  // 隐藏的属性
  public $hidden = [];
}
