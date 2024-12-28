<?php
namespace App\Models\Common\Module\Order;

use App\Models\Base;
use App\Enum\Module\Member\MemberEnum;
use App\Http\Constant\Parameter;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-16
 *
 * 机构模型类
 */
class Order extends Base
{
  // 表名
  public $table = "module_order";

  // 可以批量修改的字段
  public $fillable = [];

  // 隐藏的属性
  public $hidden = [];


  // 关联函数 ------------------------------------------------------


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-16
   * ------------------------------------------
   * 订单与会员关联表
   * ------------------------------------------
   *
   * 订单与会员关联表
   *
   * @return [关联对象]
   */
  public function member()
  {
      return $this->hasOne('App\Models\Common\Module\Member\Member', 'id', 'member_id')
                  ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-16
   * ------------------------------------------
   * 订单与机构关联表
   * ------------------------------------------
   *
   * 订单与机构关联表
   *
   * @return [关联对象]
   */
  public function organization()
  {
      return $this->hasOne('App\Models\Common\Module\Organization\Organization', 'id', 'organization_id')
                  ->where(['status'=>1]);
  }
}
