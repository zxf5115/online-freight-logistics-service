<?php
namespace App\Models\Api\Module\Organization\Squad;

use App\Models\Common\Module\Organization\Squad\Squad as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 班级模型类
 */
class Squad extends Common
{
  // 追加到模型数组表单的访问器
  public $appends = [
    'progress',
    'graduation_status'
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


    if(0== $total)
    {
      return 0;
    }

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
   * 班级是否结业封装
   * ------------------------------------------
   *
   * 班级是否结业封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getGraduationStatusAttribute($value)
  {
    $response = false;

    if(time() > strtotime($this->end_time))
    {
      $response = true;
    }

    return $response;
  }
}
