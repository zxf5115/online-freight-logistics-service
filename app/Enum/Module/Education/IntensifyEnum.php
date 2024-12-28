<?php
namespace App\Enum\Module\Education;

use App\Enum\BaseEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-09
 *
 * 考前强化枚举类
 */
class IntensifyEnum extends BaseEnum
{
  // 作业结果
  const PICTURE  = 1; // 图片内容
  const QUESTION = 2; // 试题内容
  const PAPER    = 3; // 试卷内容

  // 广告位启用状态
  public static $type = [
    self::PICTURE       => [
      'value' => self::PICTURE,
      'text' => '图片内容'
    ],

    self::QUESTION       => [
      'value' => self::QUESTION,
      'text' => '试题内容'
    ],

    self::PAPER       => [
      'value' => self::PAPER,
      'text' => '试卷内容'
    ]
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 考前强化类型状态封装
   * ------------------------------------------
   *
   * 考前强化类型状态封装
   *
   * @param int $code 信息代码
   * @return 信息内容
   */
  public static function getTypeStatus($code)
  {
    return self::$type[$code] ?: self::$type[self::PICTURE];
  }
}
