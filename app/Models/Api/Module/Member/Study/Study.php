<?php
namespace App\Models\Api\Module\Member\Study;

use App\Enum\Common\ScoreEnum;
use App\Models\Common\Module\Education\Homework\Relevance\Squad;
use App\Models\Api\Module\Member\Relevance\MemberCourseRelevance as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 会员学习中心模型类
 */
class Study extends Common
{
  use \Awobaz\Compoships\Compoships;

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];


  // 追加到模型数组表单的访问器
  public $appends = [
    'wait_homework_total',
    'teacher_comment_total',
    'systematic_notification_total',
    'squad_notification_total',
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


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 需完成作业数量封装
   * ------------------------------------------
   *
   * 需完成作业数量封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getWaitHomeworkTotalAttribute($value)
  {
    $response     = 0;
    $finish_total = 0;

    if(!empty($this->homeworkRelevance))
    {
      $organization_id = $this->organization_id;
      $squad_id       = $this->squad_id;

      $where = [
        'status' => 1,
        'organization_id' => $organization_id,
        'squad_id' => $squad_id,
      ];

      $homework_total = Squad::getCount($where);

      foreach($this->homeworkRelevance as $item)
      {
        if(!empty($item->id))
        {
          $finish_total = bcadd($finish_total, 1);
        }
      }
    }

    $response = bcsub($homework_total, $finish_total);

    return $response;
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 老师评语数量封装
   * ------------------------------------------
   *
   * 老师评语数量封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getTeacherCommentTotalAttribute($value)
  {
    $response = 0;

    if(!empty($this->homeworkRelevance))
    {
      foreach($this->homeworkRelevance as $item)
      {
        if(0 != $item->result)
        {
          $response = bcadd($response, 1);
        }
      }
    }

    return $response;
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 系统通知数量封装
   * ------------------------------------------
   *
   * 系统通知数量封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getSystematicNotificationTotalAttribute($value)
  {
    $response = 0;

    if(empty($this->messageRelevance))
    {
      return $response;
    }

    foreach($this->messageRelevance as $item)
    {
      if(!empty($item->message) && 1 == $item->message->type['value'])
      {
        $response++;
      }
    }

    return $response;
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 班级通知数量封装
   * ------------------------------------------
   *
   * 班级通知数量封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getSquadNotificationTotalAttribute($value)
  {
    $response = 0;

    if(empty($this->messageRelevance))
    {
      return $response;
    }

    foreach($this->messageRelevance as $item)
    {
      if(!empty($item->message) && 2 == $item->message->type['value'])
      {
        $response++;
      }
    }

    return $response;
  }





  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 会员与作业关联表
   * ------------------------------------------
   *
   * 会员与作业关联表
   *
   * @return [关联对象]
   */
  public function homeworkRelevance()
  {
    return $this->hasMany('App\Models\Api\Module\Member\Homework\Homework', ['member_id', 'squad_id'], ['member_id', 'squad_id']);
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 会有与消息关联表
   * ------------------------------------------
   *
   * 会有与消息关联表
   *
   * @return [关联对象]
   */
  public function messageRelevance()
  {
    return $this->hasMany('App\Models\Api\Module\Member\Relevance\MemberMessageRelevance', ['member_id', 'squad_id'], ['member_id', 'squad_id']);
  }
}
