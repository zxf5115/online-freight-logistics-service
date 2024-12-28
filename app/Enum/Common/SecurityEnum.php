<?php
namespace App\Enum\Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 性别枚举类
 */
class SecurityEnum
{
  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-21
   * ------------------------------------------
   * 登录手机号码安全性显示
   * ------------------------------------------
   *
   * 登录手机号码安全性显示
   *
   * @param int $code 状态代码
   * @return 状态信息
   */
  public static function getMobile($value)
  {
    return substr_replace($value, '****', 3, 4);
  }
}
