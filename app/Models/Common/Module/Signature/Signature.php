<?php
namespace App\Models\Common\Module\Signature;

use App\Models\Base;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 签到模型类
 */
class Signature extends Base
{
  // 表名
  public $table = "module_signature";

  // 可以批量修改的字段
  public $fillable = ['id'];

  // 隐藏的属性
  public $hidden = [];

  /**
   * 转换属性类型
   */
  protected $casts = [
    'status'      => 'array',
    'sign_time'   => 'datetime:Y-m-d H:i:s',
    'create_time' => 'datetime:Y-m-d H:i:s',
    'update_time' => 'datetime:Y-m-d H:i:s',
  ];

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-21
   * ------------------------------------------
   * 签到IP地址封装
   * ------------------------------------------
   *
   * 签到IP地址封装
   *
   * @param int $value 状态值
   * @return 状态信息
   */
  public function getSignIpAddressAttribute($value)
  {
    return long2ip($value);
  }



  // 关联函数 ------------------------------------------------------


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-21
   * ------------------------------------------
   * 签到与会员关联表
   * ------------------------------------------
   *
   * 签到与会员关联表
   *
   * @return [关联对象]
   */
  public function member()
  {
      return $this->belongsTo('App\Models\Common\Module\Member\Member', 'member_id', 'id')
                  ->where(['status'=>1]);
  }
}
