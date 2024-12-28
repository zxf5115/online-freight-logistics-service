<?php
namespace App\Models\Api\Module\Education\Course;

use App\Models\Common\Module\Education\Course\Course as Common;
use App\Models\Api\Module\Member\Relevance\MemberCourseRelevance;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-23
 *
 * 课程模型类
 */
class Course extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'update_time'
  ];


  // 追加到模型数组表单的访问器
  protected $appends = [
    'member_total'
  ];

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-22
   * ------------------------------------------
   * 课程报名人数
   * ------------------------------------------
   *
   * 课程报名人数
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getMemberTotalAttribute($value)
  {
    $response = 0;

    try
    {
      $where = [
        'course_id' => $this->id
      ];

      $response = MemberCourseRelevance::getCount($where);

      return $response;
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return 0;
    }
  }




  // 关联函数 ------------------------------------------------------


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 课程与会员关联函数
   * ------------------------------------------
   *
   * 课程与会员关联函数
   *
   * @return [关联对象]
   */
  public function member()
  {
    return $this->belongsToMany(
      'App\Models\Api\Module\Member\Member',
      'module_member_course_relevance',
      'course_id',
      'member_id'
    )->wherePivot('status', 1);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-13
   * ------------------------------------------
   * 课程与课程资料关联函数
   * ------------------------------------------
   *
   * 课程与课程资料关联函数
   *
   * @return [关联对象]
   */
  public function resource()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Education\Course\Resource',
      'module_course_resource_relevance',
      'course_id',
      'resource_id'
    )->wherePivot('status', 1);
  }
}
