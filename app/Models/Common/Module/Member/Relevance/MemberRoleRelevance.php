<?php
namespace App\Models\Common\Module\Member\Relevance;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-15
 *
 * 系统角色模型类
 */
class MemberRoleRelevance extends Base
{
  // 表名
  public $table = 'module_member_role_relevance';

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];

  /**
   * 可以被批量赋值的属性
   */
  public $fillable = [
    'organization_id',
    'role_id'
  ];


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
  public function role()
  {
      return $this->hasOne('App\Models\Common\Module\Member\Role', 'id', 'role_id')
                  ->where(['status'=>1]);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-03-07
   * ------------------------------------------
   * 反向关联用户
   * ------------------------------------------
   *
   * 反向关联用户
   *
   * @return [type]
   */
  public function member()
  {
    return $this->hasOne('App\Models\Common\Module\Member', 'id', 'user_id')
                ->where(['status'=>1]);
  }
}
