<?php
namespace App\Models\Crontab\Module\Member\Relevance;

use App\Http\Constant\Code;
use App\Models\Common\Module\Member\Relevance\MemberCourseRelevance as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-24
 *
 * 会员课程模型类
 */
class MemberCourseRelevance extends Common
{
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
   * 操作会员课程结束学习进度
   * ------------------------------------------
   *
   * 保存会员课程结束学习进度数据
   *
   * @param [type] $organization_id 机构编号
   * @param [type] $squad_id 班级编号
   * @param [type] $member_id 学员编号
   * @param [type] $course_id 课程编号
   * @return [type]
   */
  public static function handleEndMemberCourseData($organization_id, $squad_id, $member_id, $course_id)
  {
    try
    {
      $where = [
        'organization_id' => $organization_id,
        'squad_id'        => $squad_id,
        'member_id'       => $member_id,
        'course_id'       => $course_id,
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
}
