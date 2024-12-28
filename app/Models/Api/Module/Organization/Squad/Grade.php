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
class Grade extends Common
{
  // 隐藏的属性
  public $hidden = [
    'update_time',
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [
    'class_after_question_total',
    'class_after_question_correct_total',
    'class_after_question_error_total',
    'class_after_question_accuracy',
    'comprehensive_question_total',
    'comprehensive_question_correct_total',
    'comprehensive_question_error_total',
    'comprehensive_question_accuracy',
    'simulation_exam_total',
    'simulation_exam_high',
    'simulation_exam_low',
    'simulation_exam_average',
  ];



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 课后练习题总数封装
   * ------------------------------------------
   *
   * 课后练习题总数封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getClassAfterQuestionTotalAttribute($value)
  {
    $response = 0;

    if(empty($this->memberCourse))
    {
      return $response;
    }

    foreach($this->memberCourse as $item)
    {
      $response = bcadd($response, $item->class_after_question_total);
    }

    return $response;
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 课后练习题正确数封装
   * ------------------------------------------
   *
   * 课后练习题正确数封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getClassAfterQuestionCorrectTotalAttribute($value)
  {
    $response = 0;

    if(empty($this->memberCourse))
    {
      return $response;
    }

    foreach($this->memberCourse as $item)
    {
      $response = bcadd($response, $item->class_after_question_correct_total);
    }

    return $response;
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 课后练习题错误数封装
   * ------------------------------------------
   *
   * 课后练习题错误数封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getClassAfterQuestionErrorTotalAttribute($value)
  {
    $response = 0;

    if(empty($this->memberCourse))
    {
      return $response;
    }

    foreach($this->memberCourse as $item)
    {
      $response = bcadd($response, $item->class_after_question_error_total);
    }

    return $response;
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

    $total = array_sum($data);
    $number       = count($data);

    $average = 0;

    if($number)
    {
      $average = intval(round(bcdiv($total, $number), 0));
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
   * 综合练习题总数封装
   * ------------------------------------------
   *
   * 综合练习题总数封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getComprehensiveQuestionTotalAttribute($value)
  {
    $response = 0;

    if(empty($this->memberCourse))
    {
      return $response;
    }

    foreach($this->memberCourse as $item)
    {
      $response = bcadd($response, $item->comprehensive_question_total);
    }

    return $response;
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 综合练习题正确数封装
   * ------------------------------------------
   *
   * 综合练习题正确数封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getComprehensiveQuestionCorrectTotalAttribute($value)
  {
    $response = 0;

    if(empty($this->memberCourse))
    {
      return $response;
    }

    foreach($this->memberCourse as $item)
    {
      $response = bcadd($response, $item->comprehensive_question_correct_total);
    }

    return $response;
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 综合练习题错误数封装
   * ------------------------------------------
   *
   * 综合练习题错误数封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getComprehensiveQuestionErrorTotalAttribute($value)
  {
    $response = 0;

    if(empty($this->memberCourse))
    {
      return $response;
    }

    foreach($this->memberCourse as $item)
    {
      $response = bcadd($response, $item->comprehensive_question_error_total);
    }

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

    $total = array_sum($data);
    $number       = count($data);

    $average = 0;

    if($number)
    {
      $average = intval(round(bcdiv($total, $number), 0));
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
   * 模拟考试总数封装
   * ------------------------------------------
   *
   * 模拟考试总数封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getSimulationExamTotalAttribute($value)
  {
    $response = 0;

    if(empty($this->memberCourse))
    {
      return $response;
    }

    foreach($this->memberCourse as $item)
    {
      if(0 < $item->simulation_exam_total)
      {
        $response = bcadd($response, $item->simulation_exam_total);
      }
    }

    return $response;
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 模拟考试最高分封装
   * ------------------------------------------
   *
   * 模拟考试最高分封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getSimulationExamHighAttribute($value)
  {
    $response = 0;

    if(empty($this->memberCourse))
    {
      return $response;
    }

    $data = [];

    foreach($this->memberCourse as $key => $item)
    {
      if(0 < $item->simulation_exam_high)
      {
        $data[$key] = $item->simulation_exam_high;
      }
    }

    if(empty($data))
    {
      return $response;
    }

    $total = array_sum($data);
    $number       = count($data);

    $response = intval(round(bcdiv($total, $number), 0));

    return $response;
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 模拟考试最低分封装
   * ------------------------------------------
   *
   * 模拟考试最低分封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getSimulationExamLowAttribute($value)
  {
    $response = 0;

    if(empty($this->memberCourse))
    {
      return $response;
    }

    $data = [];

    foreach($this->memberCourse as $key => $item)
    {
      if(0 < $item->simulation_exam_low)
      {
        $data[$key] = $item->simulation_exam_low;
      }
    }

    if(empty($data))
    {
      return $response;
    }

    $total = array_sum($data);
    $number       = count($data);

    $response = intval(round(bcdiv($total, $number), 0));

    return $response;
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 模拟考试平均分数封装
   * ------------------------------------------
   *
   * 模拟考试平均分数封装
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

    $total = array_sum($data);
    $number       = count($data);

    $average = 0;

    if($number)
    {
      $average = intval(round(bcdiv($total, $number), 0));
    }

    $level = ScoreEnum::getCodeScore($average);

    $response = [
      'score' => $average,
      'level' => $level
    ];

    return $response;
  }
}
