<?php
namespace App\Enum\Module\Education;

use App\Enum\BaseEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-22
 *
 * 课程枚举类
 */
class CourseEnum extends BaseEnum
{
  // 课程类型
  const SPEAK     = 1; // 讲授
  const OPERATION = 2; // 操作
  const PRACTICE  = 3; // 练习

  // 课程推荐
  const RECOMMENT = 1;
  const UNRECOMMENT = 2;

  // 课程显示
  const HIDDEN = 1;
  const UNHIDDEN = 2;


  // 课程类型
  public static $type = [
    self::SPEAK => [
      'value' => self::SPEAK,
      'text' => '讲授'
    ],

    self::OPERATION => [
      'value' => self::OPERATION,
      'text' => '操作'
    ],

    self::PRACTICE => [
      'value' => self::PRACTICE,
      'text' => '练习'
    ]
  ];


  // 课程推荐
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

  // 课程显示
  public static $hidden = [
    self::UNHIDDEN => [
      'value' => self::UNHIDDEN,
      'text' => '显示'
    ],

    self::HIDDEN => [
      'value' => self::HIDDEN,
      'text' => '隐藏'
    ]
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-24
   * ------------------------------------------
   * 课程类型状态值
   * ------------------------------------------
   *
   * 课程类型状态值
   *
   * @param int $code 信息代码
   * @return 信息内容
   */
  public static function getTypeStatus($code)
  {
    return self::$type[$code] ?: self::$type[self::SPEAK];
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-24
   * ------------------------------------------
   * 课程推荐状态值
   * ------------------------------------------
   *
   * 课程推荐状态值
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
   * 课程显示状态值
   * ------------------------------------------
   *
   * 课程显示状态值
   *
   * @param int $code 信息代码
   * @return 信息内容
   */
  public static function getHiddenStatus($code)
  {
    return self::$hidden[$code] ?: self::$hidden[self::UNHIDDEN];
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-23
   * ------------------------------------------
   * 课程类型列表
   * ------------------------------------------
   *
   * 课程类型列表
   *
   * @return [type]
   */
  public static function getTypeList()
  {
    return self::$type;
  }
}
