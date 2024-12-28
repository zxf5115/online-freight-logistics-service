<?php
namespace App\Models\Api\Module\Member;

use App\Enum\Common\SecurityEnum;
use App\Models\Common\Module\Member\Member as Common;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 会员模型类
 */
class Member extends Common
{
  // 隐藏的属性
  public $hidden = [
    'password',
    'password_salt',
    'remember_token',
    'sms_code',
    'last_login_time',
    'last_login_ip',
    'try_number',
    'status',
    'update_time'
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-07-15
   * ------------------------------------------
   * 登录操作
   * ------------------------------------------
   *
   * 登录操作，更新最后时间，更新失败登录次数
   *
   * @param [type] $request [description]
   * @return [type]
   */
  public static function login($request)
  {
    try
    {
      $request->last_login_time = time();
      $request->try_number = 0;
      $request->sms_code = 0;
      $request->save();

      return true;
    }
    catch(\Exception $e)
    {
      self::log($e);

      return false;
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-07-16
   * ------------------------------------------
   * 获取角色编号
   * ------------------------------------------
   *
   * 获取角色编号
   *
   * @param array $request 请求数据
   * @param array $organization_id 机构编号
   * @return 角色数据
   */
  public static function getRoleId($request, $organization_id)
  {
    $response = [];

    foreach($request as $key => $item)
    {
      $response[$key]['role_id']     = $item;
      $response[$key]['organization_id'] = $organization_id;
    }

    return $response;
  }






  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 学员与课程关联函数
   * ------------------------------------------
   *
   * 学员与课程关联函数
   *
   * @return [关联对象]
   */
  public function course2()
  {
    return $this->belongsToMany(
                  'App\Models\Api\Module\Education\Course\Course',
                  'module_member_course_relevance',
                  'member_id',
                  'course_id'
                )
                ->withPivot('type', 'start_time', 'end_time', 'cumulative_study_time', 'already_study_time', 'wait_study_time', 'mobile_study_time', 'pc_study_time', 'already_study_total', 'wait_study_total', 'question_correct_total', 'test_total', 'test_high', 'test_low', 'test_average', 'reality_practice_total', 'reality_practice_correct', 'theory_practice_total', 'simulation_exam_average', 'theory_practice_correct', 'simulation_exam_total', 'simulation_exam_high', 'simulation_exam_low')
                ->wherePivot('status', 1);
  }
}
