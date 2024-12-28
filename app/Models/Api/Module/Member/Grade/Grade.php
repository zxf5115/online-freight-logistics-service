<?php
namespace App\Models\Api\Module\Member\Grade;

use App\Enum\Common\ScoreEnum;
use App\Models\Common\Module\Member\Relevance\MemberCourseRelevance as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 会员学习中心模型类
 */
class Grade extends Common
{
  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];


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

    $data = [];

    $level = ScoreEnum::getCodeScore($value);

    $response = [
      'score' => $value,
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

    $level = ScoreEnum::getCodeScore($value);

    $response = [
      'score' => $value,
      'level' => $level
    ];

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

    $level = ScoreEnum::getCodeScore($value);

    $response = [
      'score' => $value,
      'level' => $level
    ];

    return $response;
  }
}
