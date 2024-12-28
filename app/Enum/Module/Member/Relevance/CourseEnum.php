<?php
namespace App\Enum\Module\Member\Relevance;

use App\Enum\BaseEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-25
 *
 * 会员课程枚举类
 */
class CourseEnum extends BaseEnum
{
  // 学习设备类型
  const COMPUTER = 1;
  const MOBILE   = 2;


  // 学习设备类型
  public static $type = [
    self::COMPUTER => [
      'value' => self::COMPUTER,
      'text' => '电脑端'
    ],

    self::MOBILE => [
      'value' => self::MOBILE,
      'text' => '移动端'
    ]
  ];

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-24
   * ------------------------------------------
   * 学习设备类型状态值
   * ------------------------------------------
   *
   * 学习设备类型状态值
   *
   * @param int $code 信息代码
   * @return 信息内容
   */
  public static function getTypeStatus($code)
  {
    return self::$type[$code] ?: self::$type[self::COMPUTER];
  }
}
