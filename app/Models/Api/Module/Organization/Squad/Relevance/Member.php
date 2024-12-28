<?php
namespace App\Models\Api\Module\Organization\Squad\Relevance;

use App\Models\Common\Module\Organization\Squad\Relevance\Member as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 班级学员模型类
 */
class Member extends Common
{
  use \Awobaz\Compoships\Compoships;

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
  public function squadMemberCourse()
  {
    return $this->hasOne('App\Models\Api\Module\Member\Relevance\MemberCourseRelevance', ['member_id', 'squad_id'], ['member_id', 'squad_id'])
                ->where('status', 1);
  }
}
