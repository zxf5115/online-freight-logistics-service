<?php
namespace App\Models\Common\Module\Member;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-15
 *
 * 会员评论模型类
 */
class Comment extends Base
{
  // 表名
  public $table = "module_member_comment";

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
   * 会员评论与会员关联函数
   * ------------------------------------------
   *
   * 会员评论与会员关联函数
   *
   * @return [关联对象]
   */
  public function appraiser()
  {
    return $this->belongsTo(
      'App\Models\Common\Module\Member\Member',
      'appraiser_id',
      'id'
    );
  }
}
