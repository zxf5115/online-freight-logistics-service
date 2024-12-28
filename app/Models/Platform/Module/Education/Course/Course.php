<?php
namespace App\Models\Platform\Module\Education\Course;

use App\Models\Common\Module\Education\Course\Course as Common;

use App\Models\Common\Module\Member\Relevance\MemberCourseRelevance;
use App\Models\Common\Module\Education\Course\Point\Relevance\Question;
use App\Models\Common\Module\Organization\Relevance\Course as OrganizationCourse;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-27
 *
 * 课程模型类
 */
class Course extends Common
{

  // 追加到模型数组表单的访问器
  protected $appends = [
    'member_total',
    'organization_total',
    'point_total',
    'question_total',
    // 'unit_directory'
  ];

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-22
   * ------------------------------------------
   * 课程练习题总题数时间
   * ------------------------------------------
   *
   * 课程练习题总题数时间
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getMemberTotalAttribute($value)
  {
    $response = 0;

    $where = ['course_id' => $this->id];

    try
    {
      $result = MemberCourseRelevance::getPluck('member_id', $where, false, false, true);

      if(!empty($result))
      {
        $response = count(array_unique($result));
      }

      return $response;
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return 0;
    }
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-22
   * ------------------------------------------
   * 订购课程机构数
   * ------------------------------------------
   *
   * 订购课程机构数
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getOrganizationTotalAttribute($value)
  {
    $response = 0;

    $where = ['course_id' => $this->id];

    try
    {
      $result = OrganizationCourse::getPluck('organization_id', $where);

      if(!empty($result))
      {
        $response = count(array_unique($result));
      }

      return $response;
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return 0;
    }
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-22
   * ------------------------------------------
   * 知识点总数时间
   * ------------------------------------------
   *
   * 知识点总数时间
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getPointTotalAttribute($value)
  {
    try
    {
      $response = 0;

      $where = ['course_id' => $this->id, 'status' => 1];

      $response = Point::getCount($where);

      return $response;
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return 0;
    }
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-22
   * ------------------------------------------
   * 课程练习题总题数时间
   * ------------------------------------------
   *
   * 课程练习题总题数时间
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getQuestionTotalAttribute($value)
  {
    $response = 0;

    $where = ['course_id' => $this->id];

    try
    {
      $result = Point::getPluck('id', $where);

      $response = Question::whereIn('point_id', $result)->count();

      return $response;
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return 0;
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-22
   * ------------------------------------------
   * 课程单元目录封装
   * ------------------------------------------
   *
   * 课程单元目录封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getUnitDirectoryAttribute($value)
  {
    $response = [];

    $where = ['course_id' => $this->id];

    try
    {
      $result = Unit::getPluck('title', $where, 'children', false, true);

      $response = implode(' - ', $result);

      return $response;
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return 0;
    }
  }

}
