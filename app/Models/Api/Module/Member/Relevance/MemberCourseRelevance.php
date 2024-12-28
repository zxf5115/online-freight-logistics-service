<?php
namespace App\Models\Api\Module\Member\Relevance;

use App\Http\Constant\Code;
use App\Models\Api\Module\Education\Course\Point;
use App\Models\Api\Module\Education\Paper\Paper;
use App\Models\Common\Module\Member\Paper\Paper as MemberPaper;
use App\Models\Common\Module\Organization\Squad\Relevance\Member;
use App\Models\Common\Module\Member\Relevance\MemberCourseRelevance as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-24
 *
 * 会员课程模型类
 */
class MemberCourseRelevance extends Common
{
  use \Awobaz\Compoships\Compoships;

  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'create_time',
    'update_time'
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-11-30
   * ------------------------------------------
   * 操作练习题数据
   * ------------------------------------------
   *
   * 保存练习题数据
   *
   * @param [type] $request 前台请求数据
   * @param [type] $organization_id 机构编号
   * @param [type] $squad_id 班级编号
   * @param [type] $member_id 学员编号
   * @return [type]
   */
  public static function handleQuestionData($request, $organization_id, $squad_id, $member_id, $point_id = 0)
  {
    try
    {
      $flag = false;

      $where = [
        'organization_id' => $organization_id,
        'squad_id'        => $squad_id,
        'member_id'       => $member_id,
        'course_id'       => $request->course_id,
      ];

      if(!empty($point_id))
      {
        $point = Point::getRow(['id' => $point_id]);
        if(!empty($point))
        {
          $title = $point->title;

          if(false !== strpos($title, '巩固练习'))
          {
            $flag = true;
          }
        }
      }

      $model = self::firstOrCreate($where);

      $model->increment('question_total');

      // 课后练习题
      if($flag)
      {
        $model->increment('class_after_question_total');
      }

      $model->increment('comprehensive_question_total');

      $model->interaction_time_length = bcmul($model->question_total, 72);

      if($request->result == 1)
      {
        $model->increment('question_correct_total');
        $model->increment('comprehensive_question_correct_total');

        $model->question_accuracy = bcmul(bcdiv($model->question_correct_total, $model->question_total), 100);

        $model->comprehensive_question_accuracy= bcmul(bcdiv($model->comprehensive_question_correct_total, $model->comprehensive_question_total, 2), 100);

        // 课后练习题
        if($flag)
        {
          $model->increment('class_after_question_correct_total');
          $model->class_after_question_accuracy= bcmul(bcdiv($model->class_after_question_correct_total, $model->class_after_question_total, 2), 100);
        }
      }
      else
      {
        $model->increment('question_error_total');
        $model->increment('comprehensive_question_error_total');

        $model->question_accuracy = bcmul(bcdiv($model->question_correct_total, $model->question_total, 2), 100);

        $model->comprehensive_question_accuracy= bcmul(bcdiv($model->comprehensive_question_correct_total, $model->comprehensive_question_total, 2), 100);

        // 课后练习题
        if($flag)
        {
          $model->increment('class_after_question_error_total');
          $model->class_after_question_accuracy= bcmul(bcdiv($model->class_after_question_correct_total, $model->class_after_question_total, 2), 100);
        }
      }

      if($request->type == 1)
      {
        $model->increment('theory_practice_total');

        if($request->result == 1)
        {
          $model->increment('theory_practice_correct_total');
          $model->theory_practice_correct= bcmul(bcdiv($model->theory_practice_correct_total, $model->theory_practice_total, 2), 100);
        }
        else
        {
          $model->increment('theory_practice_error_total');
          $model->theory_practice_correct= bcmul(bcdiv($model->theory_practice_correct_total, $model->theory_practice_total, 2), 100);
        }

      }
      else
      {
        $model->increment('reality_practice_total');

        if($request->result == 1)
        {
          $model->increment('reality_practice_correct_total');
          $model->reality_practice_correct= bcmul(bcdiv($model->reality_practice_correct_total, $model->reality_practice_total, 2), 100);
        }
        else
        {
          $model->increment('reality_practice_error_total');
          $model->reality_practice_correct= bcmul(bcdiv($model->reality_practice_correct_total, $model->reality_practice_total, 2), 100);
        }
      }

      $model->save();

    }
    catch(\Exception $e)
    {
      throw new \Exception($e);
    }
  }




  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-11-30
   * ------------------------------------------
   * 操作模拟试卷数据
   * ------------------------------------------
   *
   * 保存模拟试卷数据
   *
   * @param [type] $request 前台请求数据
   * @param [type] $organization_id 机构编号
   * @param [type] $squad_id 班级编号
   * @param [type] $member_id 学员编号 $request, $organization_id, $member_id
   * @return [type]
   */
  public static function handleSimulationExamData($request, $organization_id, $squad_id, $member_id)
  {
    try
    {
      $result = MemberPaper::getList(['member_id' => $member_id, 'course_id' => $request->course_id], 'paper', false, true);

      $average = 0;
      $time_length = 0;

      if(!empty($result))
      {
        $score = array_column($result, 'score');

        $total  = array_sum($score);
        $number = count($score);

        $average = bcdiv($total, $number);

        foreach($result as $item)
        {
          if(empty($item['paper']))
          {
            continue;
          }

          $time_length = bcadd($time_length, $item['paper']['test_time']);
        }
      }

      $where = [
        'organization_id' => $organization_id,
        'squad_id'        => $squad_id,
        'member_id'       => $member_id,
        'course_id'       => $request->course_id,
      ];

      $model = self::firstOrCreate($where);

      $model->increment('simulation_exam_total');



      $model->simulation_exam_low = $model->simulation_exam_high > $request->score ? $request->score : $model->simulation_exam_high;

      $model->simulation_exam_high = $model->simulation_exam_high > $request->score ? $model->simulation_exam_high : $request->score;


      $model->simulation_exam_average = $average;
      $model->simulation_exam_time_length = $time_length;

      $model->save();
    }
    catch(\Exception $e)
    {
      throw new \Exception($e);
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-11-30
   * ------------------------------------------
   * 操作会员课程学习
   * ------------------------------------------
   *
   * 保存会员课程学习数据
   *
   * @param [type] $request 前台请求数据
   * @param [type] $organization_id 机构编号
   * @param [type] $member_id 学员编号
   * @return [type]
   */
  public static function handleStartMemberCourseData($request, $organization_id, $squad_id, $member_id)
  {
    try
    {
      $where = [
        'organization_id' => $organization_id,
        'squad_id'        => $squad_id,
        'member_id'       => $member_id,
        'course_id'       => $request->course_id,
      ];

      $model = self::getRow($where);

      if(0 == $model->start_time)
      {
        $model->start_time = time();
        $model->end_time = time();

        $where = [
          'course_id' => $request->course_id
        ];

        $total = Point::getCount($where);

        $model->wait_study_total = $total;
        $model->is_end = 0;
        $model->save();
      }
      else
      {
        $model->is_end = 0;
        $model->end_time = time();
        $model->save();
      }
    }
    catch(\Exception $e)
    {
      throw new \Exception($e);
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-11-30
   * ------------------------------------------
   * 操作会员课程结束学习进度
   * ------------------------------------------
   *
   * 保存会员课程结束学习进度数据
   *
   * @param [type] $request 前台请求数据
   * @param [type] $organization_id 机构编号
   * @param [type] $member_id 学员编号
   * @return [type]
   */
  public static function handleEndMemberCourseData($request, $organization_id, $squad_id, $member_id)
  {
    try
    {
      $where = [
        'organization_id' => $organization_id,
        'squad_id'        => $squad_id,
        'member_id'       => $member_id,
        'course_id'       => $request->course_id,
      ];

      $model = self::getRow($where);

      if(!empty($model) && (1 == $model->is_end))
      {
        return false;
      }

      if(0 == $model->start_time)
      {
        \Log::info('开始学习时间为空');

        return false;
      }

      $end_time = $model->end_time == 0 ? $model->start_time : $model->end_time;

      $cumulative_study_time = bcsub(time(), $end_time);

      $model->end_time              = time();
      $model->increment('cumulative_study_time', $cumulative_study_time);
      $model->increment('pc_study_time', $cumulative_study_time);
      $model->increment('browse_time_length', $cumulative_study_time);
      $model->is_end = 1;
      $model->save();
    }
    catch(\Exception $e)
    {
      throw new \Exception($e);
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-11-30
   * ------------------------------------------
   * 操作会员课程结束学习进度
   * ------------------------------------------
   *
   * 保存会员课程结束学习进度数据
   *
   * @param [type] $request 前台请求数据
   * @param [type] $organization_id 机构编号
   * @param [type] $member_id 学员编号
   * @return [type]
   */
  public static function handleMemberCourseData($request, $organization_id, $squad_id, $member_id)
  {
    try
    {
      $where = [
        'organization_id' => $organization_id,
        'squad_id'        => $squad_id,
        'member_id'       => $member_id,
        'course_id'       => $request->course_id,
      ];

      $model = self::firstOrCreate($where);

      $model->increment('already_study_total');
      $model->decrement('wait_study_total');

      $model->save();
    }
    catch(\Exception $e)
    {
      throw new \Exception($e);
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-27
   * ------------------------------------------
   * 获取班级编号
   * ------------------------------------------
   *
   * 具体描述一些细节
   *
   * @param [type] $where 查询条件
   * @return [type]
   */
  public static function getSquadId($where)
  {
    try
    {
      $response = 0;

      $model = self::getRow($where);

      if(!empty($model))
      {
        $response = $model->squad_id;
      }

      return $response;
    }
    catch(\Exception $e)
    {
      return false;
    }
  }
}
