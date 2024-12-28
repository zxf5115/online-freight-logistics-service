<?php
namespace App\Crontab\Api\Member;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Models\Crontab\Module\Member\Online as OnlineModel;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-02-03
 *
 * 在线学习定时任务
 */
class Online extends Controller
{
  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-08-26
   * ------------------------------------------
   * 连续24小时未下线，强制下线
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
      $timestamp = time() - 86400;

      $where = [
        ['online_status', '=', 1],
        ['update_time', '<', $timestamp]
      ];

      // 获取课程结束时间大于一个小时的内容
      $result = OnlineModel::getList($where);

      if(empty($result))
      {
        \Log::info('无强制结束在线会员信息');

        return false;
      }

      // 循环操作
      foreach($result as $model)
      {
        $model->online_status = 0;
        $model->save();
      }

      DB::commit();

      \Log::info('结束在线会员完成');
    }
    catch(\Exception $e)
    {
      DB::rollback();

      \Log::error($e);
    }
  }
}
