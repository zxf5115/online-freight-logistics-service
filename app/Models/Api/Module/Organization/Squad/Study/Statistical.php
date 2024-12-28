<?php
namespace App\Models\Api\Module\Organization\Squad\Study;

use App\Enum\Common\TimeEnum;
use App\Enum\Common\ScoreEnum;
use App\Models\Api\Module\Organization\Squad\Relevance\Member as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 班级学习中心模型类
 */
class Statistical extends Common
{
  // 隐藏的属性
  public $hidden = [
    'update_time',
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [
    'course_time_length',
    'start_time',
    'end_time',
    'cumulative_study_time',
    'question_total',
    'question_accuracy',
    'reality_practice_total',
    'reality_practice_correct',
    'theory_practice_total',
    'theory_practice_correct',
    'simulation_exam_total',
    'simulation_exam_high',
    'simulation_exam_low',
    'simulation_exam_average',
  ];



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 课程总时长封装
   * ------------------------------------------
   *
   * 课程总时长封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getCourseTimeLengthAttribute($value)
  {
    $response = 0;

    if(empty($this->course))
    {
      return $response;
    }

    $response = $this->course->time_length;

    return $response;
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 开始时间封装
   * ------------------------------------------
   *
   * 开始时间封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getStartTimeAttribute($value)
  {
    $response = '暂无';

    if(empty($this->squadMemberCourse))
    {
      return $response;
    }

    if(!empty($this->squadMemberCourse->start_time))
    {
      $response = date('Y-m-d H:i:s', $this->squadMemberCourse->start_time);
    }

    return $response;
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 结束时间封装
   * ------------------------------------------
   *
   * 结束时间封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getEndTimeAttribute($value)
  {
    $response = '暂无';

    if(empty($this->squadMemberCourse))
    {
      return $response;
    }

    if(!empty($this->squadMemberCourse->start_time))
    {
      $response = date('Y-m-d H:i:s', $this->squadMemberCourse->end_time);
    }

    return $response;
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 平均学习时长封装
   * ------------------------------------------
   *
   * 平均学习时长封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getCumulativeStudyTimeAttribute($value)
  {
    $response = 0;

    if(empty($this->squadMemberCourse))
    {
      return $response;
    }

    $response = TimeEnum::getTimeLength($this->squadMemberCourse->cumulative_study_time);

    return $response;
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 练习题总数封装
   * ------------------------------------------
   *
   * 练习题总数封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getQuestionTotalAttribute($value)
  {
    $response = 0;

    if(empty($this->squadMemberCourse))
    {
      return $response;
    }

    $response = $this->squadMemberCourse->question_total;

    return $response;
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 练习题平均分封装
   * ------------------------------------------
   *
   * 练习题平均分封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getQuestionAccuracyAttribute($value)
  {
    $response = 0;

    if(empty($this->squadMemberCourse))
    {
      return $response;
    }

    $response = $this->squadMemberCourse->question_accuracy;

    return $response;
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 实操练习题总数封装
   * ------------------------------------------
   *
   * 实操练习题总数封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getRealityPracticeTotalAttribute($value)
  {
    $response = 0;

    if(empty($this->squadMemberCourse))
    {
      return $response;
    }

    $response = $this->squadMemberCourse->reality_practice_total;

    return $response;
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 实操练习题正确率封装
   * ------------------------------------------
   *
   * 实操练习题正确率封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getRealityPracticeCorrectAttribute($value)
  {
    $response = 0;

    if(empty($this->squadMemberCourse))
    {
      return $response;
    }

    $response = $this->squadMemberCourse->reality_practice_correct;

    return $response;
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 理论练习题总数封装
   * ------------------------------------------
   *
   * 理论练习题总数封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getTheoryPracticeTotalAttribute($value)
  {
    $response = 0;

    if(empty($this->squadMemberCourse))
    {
      return $response;
    }

    $response = $this->squadMemberCourse->theory_practice_total;

    return $response;
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 理论练习题正确率封装
   * ------------------------------------------
   *
   * 理论练习题正确率封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getTheoryPracticeCorrectAttribute($value)
  {
    $response = 0;

    if(empty($this->squadMemberCourse))
    {
      return $response;
    }

    $response = $this->squadMemberCourse->theory_practice_correct;

    return $response;
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 模拟测试总数封装
   * ------------------------------------------
   *
   * 模拟测试总数封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getSimulationExamTotalAttribute($value)
  {
    $response = 0;

    if(empty($this->squadMemberCourse))
    {
      return $response;
    }

    $response = $this->squadMemberCourse->simulation_exam_total;

    return $response;
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 模拟测试最高分封装
   * ------------------------------------------
   *
   * 模拟测试最高分封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getSimulationExamHighAttribute($value)
  {
    $response = 0;

    if(empty($this->squadMemberCourse))
    {
      return $response;
    }

    $response = $this->squadMemberCourse->simulation_exam_high;

    return $response;
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 模拟测试最低分封装
   * ------------------------------------------
   *
   * 模拟测试最低分封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getSimulationExamLowAttribute($value)
  {
    $response = 0;

    if(empty($this->squadMemberCourse))
    {
      return $response;
    }

    $response = $this->squadMemberCourse->simulation_exam_low;

    return $response;
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 模拟测试平均分数封装
   * ------------------------------------------
   *
   * 模拟测试平均分数封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getSimulationExamAverageAttribute($value)
  {
    $response = 0;

    if(empty($this->squadMemberCourse))
    {
      return $response;
    }

    $response = $this->squadMemberCourse->simulation_exam_average;


    return $response;
  }

}
