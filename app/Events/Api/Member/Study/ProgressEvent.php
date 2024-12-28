<?php
namespace App\Events\Api\Member\Study;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProgressEvent
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $squad_id  = null;
  public $course_id = null;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct($squad_id, $course_id)
  {
    $this->squad_id  = $squad_id;
    $this->course_id = $course_id;
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
