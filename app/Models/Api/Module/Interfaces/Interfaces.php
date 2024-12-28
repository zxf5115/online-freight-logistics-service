<?php
namespace App\Models\Api\Module\Interfaces;

use App\Models\Common\Module\Interfaces\Interfaces as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-04
 *
 * 菜单模型类
 */
class Interfaces extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'update_time'
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-20
   * ------------------------------------------
   * 获取当前用户可访问的菜单数据
   * ------------------------------------------
   *
   * 获取当前用户可访问的菜单数据
   *
   * @param [type] $menu_id 菜单编号
   * @return [type]
   */
  public static function getCurrentUserMenuData($menu_id)
  {
    try
    {
      $menu = self::with(['navigation' => function($query) use ($menu_id) {
                    $query->whereIn('id', $menu_id)->orderBy('sort', 'DESC');
                  }])
                  ->whereIn('id', $menu_id)
                  ->where(['parent_id' => 0])
                  ->whereIn('type', [1, 3])
                  ->where(['status' => 1])
                  ->orderBy('sort', 'DESC')
                  ->get()
                  ->toArray();

      $button = self::whereIn('id', $menu_id)
                    ->whereIn('type', [2, 3])
                    ->where(['status' => 1])
                    ->orderBy('sort')
                    ->get()
                    ->toArray();

      $button = array_column($button, 'url');

      $button = array_map(function($item) {
        return str_replace('/', ':', $item);
      }, $button);

      return ['menu' => $menu, 'button' => $button];
    }
    catch(\Exception $e)
    {
      self::log($e);

      return false;
    }
  }
}