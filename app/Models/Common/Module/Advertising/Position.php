<?php
namespace App\Models\Common\Module\Advertising;

use App\Models\Base;
use App\Enum\Module\Advertising\PositionEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-05
 *
 * 广告位模型类
 */
class Position extends Base
{
  // 表名
  protected $table = "module_advertising_position";

  // 隐藏的属性
  protected $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [];

  // 批量添加
  protected $fillable = ['id'];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 状态属性类型转换函数
   * ------------------------------------------
   *
   * 状态属性类型转换函数
   *
   * @param int $value [数据库存在的值]
   * @return 状态值
   */
  public function getIsOpenAttribute($value)
  {
    return PositionEnum::getIsOpenStatus($value);
  }
}
