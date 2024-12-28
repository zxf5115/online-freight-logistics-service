<?php
namespace App\Listeners\Api\Organization;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use GeoIp2\Database\Reader;
use Jenssegers\Agent\Agent;
use App\Models\Api\Module\Interfaces\Interfaces;
use App\Models\Api\System\Log\Operate;
use App\Events\Api\Organization\OperateLogEvent;

class OperateLogListeners
{
  private $_agent = null;

  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
    $this->_agent = new Agent();
  }

  /**
   * Handle the event.
   *
   * @param  OperateLogEvent  $event
   * @return void
   */
  public function handle(OperateLogEvent $event)
  {
    try
    {
      $user    = $event->user;
      $request = $event->request;

      $url = $request->path();

      $url = ltrim($url, 'api/');

      $response = Interfaces::where('url', 'like', '%' . $url . '%')->first();

      $action = $response->content ?? '';

      $this->record($user, $request, $action);
    }
    catch(\Exception $e)
    {
      \Log::error($e->getMessage());
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-23
   * ------------------------------------------
   * 记录操作行为
   * ------------------------------------------
   *
   * 记录操作行为
   *
   * @param [type] $user 会员信息
   * @param [type] $request 请求数据
   * @param [type] $action 操作行为
   * @return [type]
   */
  public function record($user, $request, $action)
  {
    try
    {
      $current_date = date('Y-m-d H:i:s');

      $log                  = new Operate();
      $log->organization_id = $user->organization_id;
      $log->user_id         = $user->id;
      $log->username        = $user->nickname;
      $log->operation       = '[' . $user->nickname . '] 在 ' . $current_date . ' ' . $action;
      $log->method          = $request->fullUrl();
      $log->params          = '';
      $log->browser         = $this->getBrowser();
      $log->system          = $this->getSystem();
      $log->ip_address      = ip2long($request->ip());
      $log->address         = $this->getAddress($request->ip());

      $log->save();
    }
    catch(\Exception $e)
    {
      \Log::error($e);
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-10
   * ------------------------------------------
   * 获取客户端浏览器
   * ------------------------------------------
   *
   * 获取客户端浏览器
   *
   * @return [type]
   */
  private function getBrowser()
  {
    $browser = $this->_agent->browser();
    $version = $this->_agent->version($browser);

    return $browser . ' ' . $version;
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-10
   * ------------------------------------------
   * 获取操作系统
   * ------------------------------------------
   *
   * 获取操作系统
   *
   * @return [type]
   */
  private function getSystem()
  {
    $platform = $this->_agent->platform();
    $version = $this->_agent->version($platform);

    return $platform . ' ' . $version;
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-10
   * ------------------------------------------
   * 获取物理地址信息
   * ------------------------------------------
   *
   * 获取物理地址信息
   *
   * @return [type]
   */
  private function getAddress($ip_address)
  {
    try
    {
      $key = env('BAIDU_MAP_KEY');

      $content = file_get_contents('http://api.map.baidu.com/location/ip?ip='.$ip_address.'&ak='.$key.'&coor=bd09ll');

      $data = mb_convert_encoding($content,'UTF-8','GBK');

      $data = json_decode($data, true);

      if(!empty($data))
      {
        if($data['status'] === 0)
        {
          $detail = !empty($data['content']['address']) ? $data['content']['address'] : '国外';
        }
        else
        {
          $detail = '未知';
        }
      }

      return $detail;
    }
    catch(\Exception $e)
    {
      \Log::error($e);
    }
  }
}
