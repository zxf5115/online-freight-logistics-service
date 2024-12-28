<?php
namespace App\Crontab\Api\Member;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Models\Crontab\Module\Member\Relevance\MemberCourseRelevance;
use App\Models\Crontab\Module\Member\Study\Progress\Unit as StudyUnit;
use App\Models\Crontab\Module\Member\Study\Progress\Course as StudyCourse;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-02-03
 *
 * 在线学习定时任务
 */
class Study extends Controller
{
  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-08-26
   * ------------------------------------------
   * 行为日志定时清除（行为日志只保存1个月）
   * ------------------------------------------
   *
   * 按照配置时间统计每位司机的工资
   *
   * @return [type]
   */
  public function action()
  {
    DB::beginTransaction();

    try
    {
      $timestamp = time() - ((61 * 60));

      $where = [
        ['start_time', '<>', 0],
        ['end_time', '<', $timestamp]
      ];

      // 获取课程结束时间大于一个小时的内容
      $result = MemberCourseRelevance::getList($where);

      if(empty($result))
      {
        \Log::info('无结束学习信息');

        return false;
      }

      // 循环操作
      foreach($result as $item)
      {
        $organization_id = $item->organization_id;
        $squad_id        = $item->squad_id;
        $member_id       = $item->member_id;
        $course_id       = $item->course_id;

        // 结束课程进度数据
        StudyCourse::handleEndCourseProgressData($organization_id, $squad_id, $member_id, $course_id);

        // 结束课程单元进程数据
        StudyUnit::handleEndUnitProgressData($organization_id, $squad_id, $member_id, $course_id);

        // 结束学员课程数据
        MemberCourseRelevance::handleEndMemberCourseData($organization_id, $squad_id, $member_id, $course_id);

        DB::commit();

        \Log::info('结束学习完成');
      }
    }
    catch(\Exception $e)
    {
      DB::rollback();

      \Log::error($e);
    }
  }
}
