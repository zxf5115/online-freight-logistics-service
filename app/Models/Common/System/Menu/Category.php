<?php
namespace App\Models\Common\System\Menu;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-08
 *
 * 菜单分类模型类
 */
class Category extends Base
{
  // 表名
  public $table = "system_menu_category";

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];

  // 批量添加
  public $fillable = ['id'];




  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-07-08
   * ------------------------------------------
   * 系统配置分类与系统配置关联函数
   * ------------------------------------------
   *
   * 系统配置分类与系统配置关联函数
   *
   * @return [关联对象]
   */
  public function config()
  {
    return $this->hasMany('App\Models\Common\System\Menu', 'category_id', 'id')          ->where(['status'=>1]);
  }
}
