<?php
namespace App\Enum\Module\Education;

use App\Enum\BaseEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-14
 *
 * 审核枚举类
 */
class GraduationEnum extends BaseEnum
{
  // 审核状态
  const WAIT     = 0; // 待审核
  const AGREE    = 1; // 同意
  const REJECT   = 2; // 拒绝


  // 审核状态
  public static $audit = [
    self::WAIT => [
      'value' => self::WAIT,
      'text' => '待审核'
    ],

    self::AGREE => [
      'value' => self::AGREE,
      'text' => '同意'
    ],

    self::REJECT => [
      'value' => self::REJECT,
      'text' => '拒绝'
    ],
  ];


  // 结业状态
  public static $graduation = [
    self::WAIT => [
      'value' => self::WAIT,
      'text' => '待审核'
    ],

    self::AGREE => [
      'value' => self::AGREE,
      'text' => '同意结业'
    ],

    self::REJECT => [
      'value' => self::REJECT,
      'text' => '拒绝结业'
    ],
  ];



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-14
   * ------------------------------------------
   * 审核状态封装
   * ------------------------------------------
   *
   * 审核状态封装
   *
   * @param int $code 信息代码
   * @return 信息内容
   */
  public static function getAuditStatus($code)
  {
    return self::$audit[$code] ?: self::$audit[self::WAIT];
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-14
   * ------------------------------------------
   * 结业状态封装
   * ------------------------------------------
   *
   * 结业状态封装
   *
   * @param int $code 信息代码
   * @return 信息内容
   */
  public static function getGraduationStatus($code)
  {
    return self::$graduation[$code] ?: self::$graduation[self::WAIT];
  }
}
