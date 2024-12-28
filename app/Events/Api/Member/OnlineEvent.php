<?php
namespace App\Events\Api\Member;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OnlineEvent
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  // 1 在线 0 离线
  public $type = null;
  public $member_id = null;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct($type, $member_id)
  {
    $this->type      = $type;
    $this->member_id = $member_id;
  }

  /**
   * Get the channels the event should broadcast on.
   *
   * @return \Illuminate\Broadcasting\Channel|array
   */
  public function broadcastOn()
  {
      return new PrivateChannel('channel-name');
  }
}
