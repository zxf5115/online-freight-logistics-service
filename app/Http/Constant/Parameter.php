<?php
namespace App\Http\Constant;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-15
 *
 * 默认参数常量类
 */
class Parameter
{
  // 默认头像
  const AVATER = 'https://video.vstown.cc/image/default/A3BBB5E0EB3D41AC8A92082748DA80F5-6-2.png';

  // 默认密码
  const PASSWORD = '123456';

  // Redis -------------------------------------------

  // Redis平台菜单键名
  const REDIS_PLATFORM_ROUTER = 'platform_router';
  const REDIS_PLATFORM_MENU = 'platform_menu';
  const REDIS_PLATFORM_NAVIGATION = 'platform_navigation';

  // Redis机构菜单键名
  const REDIS_ORGAN_MENU = 'organ_menus';


  // Redis 在线人数
  const REDIS_ONLINE_PEOPLE_TOTAL = 'online_people_total';

  // Redis 课程单元知识点
  const REDIS_COURSE_UNIT = 'course_unit_point';
}
