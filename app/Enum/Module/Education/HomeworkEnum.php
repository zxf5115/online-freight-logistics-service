<?php
namespace App\Enum\Module\Education;

use App\Enum\BaseEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-09
 *
 * 作业枚举类
 */
class HomeworkEnum extends BaseEnum
{
  // 作业结果
  const WAIT    = 0; // 待批准
  const CORRECT = 1; // 回答正确
  const ERROR   = 2; // 回答错误

  // 广告位启用状态
  public static $result = [
    self::WAIT       => [
      'value' => self::WAIT,
      'text' => '待批准'
    ],

    self::CORRECT       => [
      'value' => self::CORRECT,
      'text' => '回答正确'
    ],

    self::ERROR       => [
      'value' => self::ERROR,
      'text' => '回答错误'
    ]
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 作业结果状态封装
   * ------------------------------------------
   *
   * 作业结果状态封装
   *
   * @param int $code 信息代码
   * @return 信息内容
   */
  public static function getResultStatus($code)
  {
    return self::$result[$code] ?: self::$result[self::WAIT];
  }
}
