<?php
namespace App\Models\Common\Module\Member;

use App\Models\Base;
use App\Http\Constant\Parameter;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-15
 *
 * 会员在线模型类
 */
class Online extends Base
{
  // 表名
  public $table = "module_member_online";

  // 可以批量修改的字段
  public $fillable = [
    'id',
    'member_id',
  ];

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];


  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-07-16
   * ------------------------------------------
   * 在线会员与会员关联函数
   * ------------------------------------------
   *
   * 在线会员与会员关联函数
   *
   * @return [关联对象]
   */
  public function member()
  {
      return $this->belongsTo('App\Models\Common\Module\Member\Member', 'member_id', 'id');
  }
}
