<?php
namespace App\Listeners\Api\Member;

use Illuminate\Support\Facades\Redis;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Http\Constant\Parameter;
use App\Events\Api\Member\OnlineEvent;
use App\Models\Api\Module\Member\Online;

class OnlineListeners
{
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
   * @param  OnlineEvent  $event
   * @return void
   */
  public function handle(OnlineEvent $event)
  {
    try
    {
      $type      = $event->type;
      $member_id = $event->member_id;

      $model = Online::firstOrNew(['member_id' => $member_id]);

      if(1 == $type)
      {
        $model->online_status = 1;
      }
      else
      {
        $model->online_status = 0;
      }

      $model->save();

      return true;
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }
}
