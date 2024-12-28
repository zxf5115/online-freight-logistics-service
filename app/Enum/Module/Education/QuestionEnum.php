<?php
namespace App\Enum\Module\Education;

use App\Enum\BaseEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-09
 *
 * 练习题枚举类
 */
class QuestionEnum extends BaseEnum
{
  // 练习题类型
  const SELECT          = 1; // 选择题
  const JUDGE           = 2; // 判断题
  const COMPUTE         = 3; // 计算题
  const CONNECT         = 4; // 连线题
  const MULTIPLE_SELECT = 5; // 多选题
  const FILL_IN_BLANK   = 6; // 填空题
  const EXPLAIN         = 7; // 名词解析题
  const SPECIAL         = 8; // 特殊题

  // 广告位启用状态
  public static $type = [
    self::SELECT       => [
      'value' => self::SELECT,
      'text' => '选择题'
    ],

    self::JUDGE       => [
      'value' => self::JUDGE,
      'text' => '判断题'
    ],

    self::COMPUTE       => [
      'value' => self::COMPUTE,
      'text' => '计算题'
    ],

    self::CONNECT       => [
      'value' => self::CONNECT,
      'text' => '连线题'
    ],

    self::MULTIPLE_SELECT       => [
      'value' => self::MULTIPLE_SELECT,
      'text' => '多选题'
    ],

    self::FILL_IN_BLANK       => [
      'value' => self::FILL_IN_BLANK,
      'text' => '填空题'
    ],

    self::EXPLAIN       => [
      'value' => self::EXPLAIN,
      'text' => '名词解析题'
    ],

    self::SPECIAL       => [
      'value' => self::SPECIAL,
      'text' => '特殊题'
    ]
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 练习题类型状态封装
   * ------------------------------------------
   *
   * 练习题类型状态封装
   *
   * @param int $code 信息代码
   * @return 信息内容
   */
  public static function getTypeStatus($code)
  {
    return self::$type[$code] ?: self::$type[self::SELECT];
  }
}
