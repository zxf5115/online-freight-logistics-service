<?php
namespace App\Models\Common\Module\Keyword;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-25
 *
 * 热门关键字模型类
 */
class Keyword extends Base
{
  // 表名
  public $table = "module_keyword";

  // 可以批量修改的字段
  public $fillable = [
    'id'
  ];

  // 隐藏的属性
  public $hidden = [];

  /**
   * 转换属性类型
   */
  protected $casts = [];

}
