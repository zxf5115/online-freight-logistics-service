<?php
namespace App\Jobs\Api\Member\Study;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProgressQueue implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  /**
   * The number of times the job may be attempted.
   *
   * @var int
   */
  public $tries = 5;


  /**
   * The number of seconds the job can run before timing out.
   *
   * @var int
   */
  public $timeout = 120;


  public $model = null;

  public $data = null;


  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct($model, $data)
  {
    $this->model = $model;

    $this->data     = $data;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    try
    {
      $courseData       = $this->data['courseData'];
      $memberCourseData = $this->data['memberCourseData'];
      $pointData        = $this->data['pointData'];
      $unitData         = $this->data['unitData'];

      if(is_array($courseData))
      {
        $this->model->courseProgress()->createMany($courseData);
      }

      if(is_array($memberCourseData))
      {
        $this->model->memberCourse()->createMany($memberCourseData);
      }

      foreach($pointData as $item)
      {
        if(is_array($item))
        {
          $this->model->pointProgress()->createMany($item);
        }
      }

      foreach($unitData as $item)
      {
        if(is_array($item))
        {
          $this->model->unitProgress()->createMany($item);
        }
      }

      return true;
    }
    catch(\Exception $e)
    {
      \Log::error($e->getMessage());
    }
  }
}
