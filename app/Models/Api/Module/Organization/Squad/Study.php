<?php
namespace App\Models\Api\Module\Organization\Squad;

use App\Enum\Common\ScoreEnum;
use App\Models\Common\Module\Organization\Squad\Squad as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 班级学习中心模型类
 */
class Study extends Common
{
  // 隐藏的属性
  public $hidden = [
    'update_time',
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [
    'progress',
    'course_time_length',
    'cumulative_study_time',
    'class_after_question_accuracy',
    'comprehensive_question_accuracy',
    'simulation_exam_average',
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-21
   * ------------------------------------------
   * 班级进度封装
   * ------------------------------------------
   *
   * 班级进度封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getProgressAttribute($value)
  {
    $timestamp  = time();
    $start_time = strtotime($this->start_time);
    $end_time   = strtotime($this->end_time);

    $progress = bcsub($timestamp, $start_time);
    $total    = bcsub($end_time, $start_time);
    $response = bcdiv($progress, $total, 2);

    if(1 < $response)
    {
      $response = 1;
    }

    return $response;
  }

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

    foreach($this->course as $item)
    {
      $response = bcadd($response, $item->time_length);

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

    if(empty($this->memberCourse))
    {
      return $response;
    }

    $data = [];

    foreach($this->memberCourse as $key => $item)
    {
      $data[$key] = $item->already_study_time;
    }

    if(empty($data))
    {
      return $response;
    }

    $study_time_total = array_sum($data);
    $student_number = count($data);

    $average = intval(round(bcdiv($study_time_total, $student_number), 0));

    return $average;
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 课后练习题平均分数封装
   * ------------------------------------------
   *
   * 课后练习题平均分数封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getClassAfterQuestionAccuracyAttribute($value)
  {
    $response = 0;

    if(empty($this->memberCourse))
    {
      return $response;
    }

    $data = [];

    foreach($this->memberCourse as $key => $item)
    {
      $data[$key] = $item->class_after_question_accuracy;
    }

    $question_score_total = array_sum($data);
    $student_number       = count($data);

    $average = 0;

    if($student_number)
    {
      $average = intval(round(bcdiv($question_score_total, $student_number), 0));
    }

    $level = ScoreEnum::getCodeScore($average);

    $response = [
      'score' => $average,
      'level' => $level
    ];

    return $response;
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 综合练习题平均分数封装
   * ------------------------------------------
   *
   * 综合练习题平均分数封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getComprehensiveQuestionAccuracyAttribute($value)
  {
    $response = 0;

    if(empty($this->memberCourse))
    {
      return $response;
    }

    $data = [];

    foreach($this->memberCourse as $key => $item)
    {
      if(0 < $item->comprehensive_question_accuracy)
      {
        $data[$key] = $item->comprehensive_question_accuracy;
      }
    }

    $question_score_total = array_sum($data);
    $student_number       = count($data);

    $average = 0;

    if($student_number)
    {
      $average = intval(round(bcdiv($question_score_total, $student_number), 0));
    }

    $level = ScoreEnum::getCodeScore($average);

    $response = [
      'score' => $average,
      'level' => $level
    ];

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

    if(empty($this->memberCourse))
    {
      return $response;
    }

    $data = [];

    foreach($this->memberCourse as $key => $item)
    {
      if(0 < $item->simulation_exam_average)
      {
        $data[$key] = $item->simulation_exam_average;
      }
    }

    $exam_score_total = array_sum($data);
    $student_number   = count($data);

    $average = 0;

    if($student_number)
    {
      $average = intval(round(bcdiv($exam_score_total, $student_number), 0));
    }

    $level = ScoreEnum::getCodeScore($average);

    $response = [
      'score' => $average,
      'level' => $level
    ];

    return $response;
  }

}
