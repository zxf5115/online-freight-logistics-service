<?php
namespace App\Models\Api\Module\Organization;

use App\Models\Common\Module\Organization\Organization as Common;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 机构模型类
 */
class Organization extends Common
{
  // 追加到模型数组表单的访问器
  protected $appends = [
    'squad_total',
    'member_total',
    'course_total',
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 机构旗下班级数量封装
   * ------------------------------------------
   *
   * 机构旗下班级数量封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getSquadTotalAttribute($value)
  {
    $response = 0;

    if(!empty($this->squad))
    {
      $response = count($this->squad);
    };

    return $response;
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 机构旗下学员数量封装
   * ------------------------------------------
   *
   * 机构旗下学员数量封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getMemberTotalAttribute($value)
  {
    $response = 0;

    if(!empty($this->member))
    {
      $response = count($this->member);
    };

    return $response;
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 机构旗下课程数量封装
   * ------------------------------------------
   *
   * 机构旗下课程数量封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getCourseTotalAttribute($value)
  {
    $response = 0;

    if(!empty($this->course))
    {
      $response = count($this->course);
    };

    return $response;
  }
}
