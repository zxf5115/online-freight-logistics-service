<?php
namespace App\Models\Common\Module\Interfaces;

use App\Models\Base;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-20
 *
 * 接口模型类
 */
class Interfaces extends Base
{
  // 表名
  public $table = "module_interface";

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];

  // 批量添加
  public $fillable = ['id'];


  // 追加到模型数组表单的访问器
  public $appends = [];




  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 权限与菜单关联函数
   * ------------------------------------------
   *
   * 权限与菜单关联函数
   *
   * @return [关联对象]
   */
  public function permission()
  {
    return $this->hasOne('App\Models\Common\System\Role', 'role_id')->where(['status'=>1]);
  }
}
