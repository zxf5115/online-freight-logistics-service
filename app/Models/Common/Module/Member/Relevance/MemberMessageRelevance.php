<?php
namespace App\Models\Common\Module\Member\Relevance;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-15
 *
 * 会员消息模型类
 */
class MemberMessageRelevance extends Base
{
  // 表名
  public $table = 'module_member_message_relevance';

  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];

  /**
   * 可以被批量赋值的属性
   */
  public $fillable = [
    'organization_id',
    'member_id',
    'squad_id',
  ];


  // 关联函数 ------------------------------------------------------


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
    return $this->belongsTo('App\Models\Common\Module\Member\Member', 'member_id', 'id')
                ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-03-07
   * ------------------------------------------
   * 反向关联消息
   * ------------------------------------------
   *
   * 反向关联消息
   *
   * @return [type]
   */
  public function message()
  {
    return $this->belongsTo('App\Models\Common\Module\Message\Message', 'message_id', 'id')
                ->where(['status'=>1]);
  }
}
