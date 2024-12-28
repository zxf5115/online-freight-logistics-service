<?php
namespace App\Models\Common\Module\Member;

use App\Models\Base;
use App\Http\Constant\Parameter;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-15
 *
 * 会员角色模型类
 */
class Role extends Base
{
  // 表名
  public $table = "module_member_role";

  // 可以批量修改的字段
  public $fillable = ['title', 'content'];

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-07-16
   * ------------------------------------------
   * 获取菜单编号
   * ------------------------------------------
   *
   * 获取菜单编号
   *
   * @param array $request 菜单编号
   * @param array $organization_id 机构编号
   * @return 菜单编号
   */
  public static function getMenuId($request, $organization_id)
  {
    $response = [];

    // 下标0 为半选中  下标1 为全选中
    // $requ

    foreach($request as $key => $item)
    {
      $response[$key]['menu_id']     = $item;
      $response[$key]['organization_id'] = $organization_id;
    }

    return $response;
  }



  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 用户与角色关联函数
   * ------------------------------------------
   *
   * 用户与角色关联函数
   *
   * @return [关联对象]
   */
  public function menu()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Menu',
      'module_member_role_permission',
      'role_id',
      'menu_id'
    )->wherePivot('status', 1);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-07-16
   * ------------------------------------------
   * 角色与权限关联函数
   * ------------------------------------------
   *
   * 角色与权限关联函数
   *
   * @return [关联对象]
   */
  public function permission()
  {
      return $this->hasMany('App\Models\Common\Module\Member\Permission', 'role_id');
  }
}
