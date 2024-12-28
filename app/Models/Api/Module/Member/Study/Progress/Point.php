<?php
namespace App\Models\Api\Module\Member\Study\Progress;

use App\Http\Constant\Code;
use App\Models\Common\Module\Organization\Squad\Relevance\Member;
use App\Models\Common\Module\Member\Study\Progress\Point as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-24
 *
 * 会员学习课程进度模型类
 */
class Point extends Common
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
   * 操作课程知识点学习进度
   * ------------------------------------------
   *
   * 保存课程知识点学习进度
   *
   * @param [type] $request 前台请求数据
   * @param [type] $organization_id 机构编号
   * @param [type] $member_id 学员编号
   * @return [type]
   */
  public static function handlePointProgressData($request, $organization_id, $squad_id, $member_id)
  {
    try
    {
      $where = [
        'organization_id' => $organization_id,
        'squad_id'        => $squad_id,
        'member_id'       => $member_id,
        'course_id'       => $request->course_id,
        'unit_id'         => $request->unit_id,
        'point_id'        => $request->point_id,
      ];

      $model = self::firstOrCreate($where);

      if(0 == $model->start_time)
      {
        $model->start_time = $request->start_time;
      }

      $end_time = $model->end_time == 0 ? $model->start_time : $model->end_time;

      $cumulative_study_time = bcsub($request->end_time, $end_time);

      $model->end_time = $request->end_time;
      $model->increment('cumulative_study_time', $cumulative_study_time);

      $model->save();
    }
    catch(\Exception $e)
    {
      throw new \Exception($e);
    }
  }
}
