<?php
namespace App\Enum\Module\Education;

use App\Enum\BaseEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-22
 *
 * 单元枚举类
 */
class UnitEnum extends BaseEnum
{
  // 单元栏目
  const YES = 1; // 是
  const NO  = 2; // 否


  // 单元栏目
  public static $column = [
    self::YES => [
      'value' => self::YES,
      'text' => '是'
    ],

    self::NO => [
      'value' => self::NO,
      'text' => '否'
    ]
  ];

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-24
   * ------------------------------------------
   * 单元栏目状态值
   * ------------------------------------------
   *
   * 单元栏目状态值
   *
   * @param int $code 信息代码
   * @return 信息内容
   */
  public static function getColumnStatus($code)
  {
    return self::$column[$code] ?: self::$column[self::NO];
  }
}
