<?php
namespace App\Enum\Module\Education;

use App\Enum\BaseEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-22
 *
 * 知识点枚举类
 */
class PointEnum extends BaseEnum
{
  // 知识点推荐
  const UNRECOMMENT = 0;
  const RECOMMENT = 1;

  // 知识点类型
  const STEP = 1;
  const PROCESS = 2;


  // 知识点推荐
  public static $recommend = [
    self::UNRECOMMENT => [
      'value' => self::UNRECOMMENT,
      'text' => '未推荐'
    ],

    self::RECOMMENT => [
      'value' => self::RECOMMENT,
      'text' => '已推荐'
    ]
  ];


  // 是否是技能
  public static $skill = [
    self::UNRECOMMENT => [
      'value' => self::UNRECOMMENT,
      'text' => '不是'
    ],

    self::RECOMMENT => [
      'value' => self::RECOMMENT,
      'text' => '是'
    ]
  ];


  // 知识点类型
  public static $type = [
    self::STEP => [
      'value' => self::STEP,
      'text' => '分步学习'
    ],

    self::PROCESS => [
      'value' => self::PROCESS,
      'text' => '全流程学习'
    ]
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-24
   * ------------------------------------------
   * 知识点推荐状态值
   * ------------------------------------------
   *
   * 知识点推荐状态值
   *
   * @param int $code 信息代码
   * @return 信息内容
   */
  public static function getRecommendStatus($code)
  {
    return self::$recommend[$code] ?: self::$recommend[self::UNRECOMMENT];
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-24
   * ------------------------------------------
   * 知识点推荐状态值
   * ------------------------------------------
   *
   * 知识点推荐状态值
   *
   * @param int $code 信息代码
   * @return 信息内容
   */
  public static function getSkillStatus($code)
  {
    return self::$skill[$code] ?: self::$skill[self::UNRECOMMENT];
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-24
   * ------------------------------------------
   * 知识点类型状态值
   * ------------------------------------------
   *
   * 知识点类型状态值
   *
   * @param int $code 信息代码
   * @return 信息内容
   */
  public static function getTypeStatus($code)
  {
    return self::$type[$code] ?: self::$type[self::STEP];
  }
}
