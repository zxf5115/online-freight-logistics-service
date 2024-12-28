<?php
namespace App\Models\Platform\Module\Organization\Squad;

use Illuminate\Support\Facades\DB;

use App\Models\Common\Module\Organization\Squad\Squad as Common;
use App\Models\Common\Module\Organization\Squad\Relevance\Member;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-07
 *
 * 班级模型类
 */
class Squad extends Common
{

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 获取当前班级学员花名册数据
   * ------------------------------------------
   *
   * 获取当前班级学员花名册数据
   *
   * @return [关联对象]
   */
  public static function getRosterData($squad_id)
  {
    $response = Member::leftJoin('module_squad', 'module_squad_member_relevance.squad_id', 'module_squad.id')
                     ->leftJoin('module_member', 'module_member.id', 'module_squad_member_relevance.member_id')
                     ->leftJoin('module_member_archive', 'module_member_archive.member_id', 'module_member.id')
                     ->leftJoin('module_member_course_relevance', function ($join) {
                        $join->on('module_member_course_relevance.member_id', '=', 'module_squad_member_relevance.member_id')
                        ->on('module_member_course_relevance.squad_id', '=', 'module_squad_member_relevance.squad_id');
                     })
                     ->select(
                      'module_member.id as id',
                      'module_member.member_no as member_no',
                      'module_member_archive.realname as realname',
                      'module_member_course_relevance.course_time as course_time',
                      'module_member_course_relevance.start_time as start_time',
                      'module_member_course_relevance.end_time as end_time',
                      'module_member_course_relevance.cumulative_study_time as cumulative_study_time',
                      'module_member_course_relevance.already_study_time as already_study_time',
                      'module_member_course_relevance.wait_study_time as wait_study_time',
                      'module_member_course_relevance.question_total as question_total',
                      'module_member_course_relevance.question_accuracy as question_accuracy',
                      'module_member_course_relevance.reality_practice_total as reality_practice_total',
                      'module_member_course_relevance.reality_practice_correct as reality_practice_correct',
                      'module_member_course_relevance.theory_practice_total as theory_practice_total',
                      'module_member_course_relevance.theory_practice_correct as theory_practice_correct',
                      'module_member_course_relevance.simulation_exam_total as simulation_exam_total',
                      'module_member_course_relevance.simulation_exam_high as simulation_exam_high',
                      'module_member_course_relevance.simulation_exam_low as simulation_exam_low',
                      'module_member_course_relevance.simulation_exam_average as simulation_exam_average'
                     )
                     ->where(['module_squad_member_relevance.squad_id' => $squad_id])
                     ->get();

    return $response;
  }


}
