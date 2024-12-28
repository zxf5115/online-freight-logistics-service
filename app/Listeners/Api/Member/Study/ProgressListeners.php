<?php
namespace App\Listeners\Api\Member\Study;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Jobs\Api\Member\Study\ProgressQueue;
use App\Events\Api\Member\Study\ProgressEvent;
use App\Models\Api\Module\Organization\Squad\Squad;
use App\Models\Api\Module\Member\Study\Progress\Course;
use App\Models\Api\Module\Member\Study\Progress\Unit;
use App\Models\Api\Module\Member\Study\Progress\Point;

class ProgressListeners
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
   * @param  ProgressEvent  $event
   * @return void
   */
  public function handle(ProgressEvent $event)
  {
    try
    {
      $squad_id  = $event->squad_id;
      $course_id = $event->course_id;

      $relevance = [
        'member',
        'course'
      ];

      $condition = ['id' => $squad_id];

      $model = Squad::getRow($condition, $relevance);

      if(empty($model->course))
      {
        throw \Exception('课程信息错误');
      }

      if(empty($model->member))
      {
        throw \Exception('学员信息错误');
      }

      // 如果当前学员已经选择课程，不可再次添加课程信息
      foreach($model->member as $k => $member)
      {
        if(count($member->course) > 0)
        {
          $course = $member->course->toArray();

          $contrast = array_column($course, 'course_id');

          if(in_array($course_id, $contrast))
          {
            unset($model->member[$k]);
          }
        }
      }

      $data = [
        'courseData' => [],
        'memberCourseData' => [],
        'pointData' => [],
        'unitData' => [],
      ];

      // ------------------------------------------------
      // 课程学习进度初始化

      foreach($model->course as $course)
      {
        foreach($model->member as $key => $item)
        {
          $data['courseData'][$key]['organization_id'] = $item->organization_id;
          $data['courseData'][$key]['member_id']       = $item->id;
          $data['courseData'][$key]['squad_id']        = $squad_id;
          $data['courseData'][$key]['course_id']       = $course->id;
          $data['courseData'][$key]['courseware_time'] = $course->time_length;

          $data['memberCourseData'][$key]['organization_id'] = $item->organization_id;
          $data['memberCourseData'][$key]['member_id']       = $item->id;
          $data['memberCourseData'][$key]['squad_id']        = $squad_id;
          $data['memberCourseData'][$key]['course_id']       = $course->id;
          $data['memberCourseData'][$key]['course_time']     = $course->time_length;
        }

        // ------------------------------------------------
        // 课程知识点学习进度初始化

        if(count($course->point) == 0)
        {
          continue;
        }

        foreach($course->point as $k => $point)
        {
          foreach($model->member as $key => $item)
          {
            $data['pointData'][$k][$key]['organization_id'] = $item->organization_id;
            $data['pointData'][$k][$key]['squad_id']        = $squad_id;
            $data['pointData'][$k][$key]['member_id']       = $item->id;
            $data['pointData'][$k][$key]['course_id']       = $course->id;
            $data['pointData'][$k][$key]['unit_id']         = $point->unit_id;
            $data['pointData'][$k][$key]['point_id']        = $point->id;
            $data['pointData'][$k][$key]['courseware_time'] = $point->time_length;
          }
        }

        // ------------------------------------------------
        // 课程单元学习进度初始化

        if(count($course->unit) == 0)
        {
          continue;
        }

        foreach($course->unit as $k => $unit)
        {
          foreach($model->member as $key => $item)
          {
            $data['unitData'][$k][$key]['organization_id'] = $item->organization_id;
            $data['unitData'][$k][$key]['squad_id']        = $squad_id;
            $data['unitData'][$k][$key]['member_id']       = $item->id;
            $data['unitData'][$k][$key]['course_id']       = $course->id;
            $data['unitData'][$k][$key]['parent_id']       = $unit->parent_id;
            $data['unitData'][$k][$key]['unit_id']         = $unit->id;
            $data['unitData'][$k][$key]['courseware_time'] = $unit->time_length;
          }
        }
      }

      ProgressQueue::dispatch($model, $data);

    }
    catch(\Exception $e)
    {
      \Log::error($e->getMessage());
    }
  }
}
