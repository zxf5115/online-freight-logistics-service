<?php
namespace App\Models\Common\Module\Organization\Squad\Relevance;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-19
 *
 * 班级与会员关联模型类
 */
class Member extends Base
{
  // 表名
  public $table = "module_squad_member_relevance";

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [];

  // 批量添加
  public $fillable = [
    'organization_id',
    'squad_id',
    'member_id'
  ];


  // 关联函数 ------------------------------------------------------


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 班级学员与会员关联函数
   * ------------------------------------------
   *
   * 班级学员与会员关联函数
   *
   * @return [关联对象]
   */
  public function squad()
  {
    return $this->belongsTo('App\Models\Common\Module\Organization\Squad\Squad', 'squad_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 班级学员与会员关联函数
   * ------------------------------------------
   *
   * 班级学员与会员关联函数
   *
   * @return [关联对象]
   */
  public function member()
  {
    return $this->belongsTo('App\Models\Common\Module\Member\Member', 'member_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 班级与学员课程学习情况关联函数
   * ------------------------------------------
   *
   * 班级与学员课程学习情况关联函数
   *
   * @return [关联对象]
   */
  public function memberCourse()
  {
    return $this->hasMany('App\Models\Common\Module\Member\Relevance\MemberCourseRelevance', 'member_id', 'member_id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 班级学员与签到关联函数
   * ------------------------------------------
   *
   * 班级学员与签到关联函数
   *
   * @return [关联对象]
   */
  public function signature()
  {
    return $this->hasOne('App\Models\Common\Module\Signature\Signature', 'member_id', 'member_id')
                ->orderBy('create_time', 'desc');
  }

}
