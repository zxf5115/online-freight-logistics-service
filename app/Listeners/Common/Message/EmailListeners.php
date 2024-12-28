<?php
namespace App\Listeners\Common\Message;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Mail;
use App\Mail\Reset;
use App\Http\Constant\RedisKey;
use App\Events\Common\Message\EmailEvent;

class EmailListeners
{
  // 验证码
  private $_code = null;

  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {

  }

  /**
   * Handle the event.
   *
   * @param  EmailEvent  $event
   * @return void
   */
  public function handle(EmailEvent $event)
  {
    $member = $event->member;

    $this->generate($member->username);

    Mail::to($member->email)->send(new Reset($member, $this->_code));
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-04-21
   * ------------------------------------------
   * 生成验证码
   * ------------------------------------------
   *
   * 生成验证码并保存到redis（10分钟自动失效）
   *
   * @param [type] $username 待发送手机号码
   * @param [type] $type 验证码类型
   * @return [type]
   */
  protected function generate($username)
  {
    try
    {
      $key = RedisKey::EMAIL_CODE . '_' . $username;

      // 生成6位验证码，不足左侧补0
      $this->_code = str_pad(rand(1, 999999), 6, 0, STR_PAD_LEFT);

      // 记录验证码
      Redis::set($key, $this->_code);

      // 设置验证码时间为10分钟
      Redis::expire($key, 600);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      \Log::error($e);

      return false;
    }
  }
}
