<?php
namespace App\Models\Api\Module\Education\Course;

use App\Models\Common\Module\Education\Course\Point as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-24
 *
 * 课程知识点模型类
 */
class Point extends Common
{
  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 课程知识点与会员笔记关联表
   * ------------------------------------------
   *
   * 会员笔记与课程知识点关联表
   *
   * @return [关联对象]
   */
  public function note()
  {
    return $this->hasMany('App\Models\Api\Module\Member\Note\Note', 'point_id', 'id')
                ->where(['status'=>1]);
  }
}
