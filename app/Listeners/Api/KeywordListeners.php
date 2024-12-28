<?php
namespace App\Listeners\Api;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\Api\KeywordEvent;
use App\Models\Api\Module\Keyword\Keyword;

class KeywordListeners
{
  public $_model = null;

  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
    $this->_model = new Keyword();
  }

    /**
   * Handle the event.
   *
   * @param  KeywordEvent  $event
   * @return void
   */
  public function handle(KeywordEvent $event)
  {
    try
    {
      $title  = $event->title;

      $model = $this->_model::firstOrNew(['title' => $title]);

      if(!empty($model->total))
      {
        $model->increment('total');
      }
      else
      {
        $model->title = $title;
        $model->total = 1;

        $model->save();
      }
    }
    catch(\Exception $e)
    {
      \Log::error($e->getMessage());
    }
  }
}
