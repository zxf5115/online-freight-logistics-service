<?php
namespace App\Http\Controllers\Platform\System;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Platform\BaseController;

use App\Enum\Common\TimeEnum;
use App\Models\Platform\Module\Member\Member;
use App\Models\Platform\Module\Keyword\Keyword;
use App\Models\Platform\Module\Signature\Signature;
use App\Models\Platform\Module\Organization\Organization;

use App\Models\Platform\Module\Education\Course\Course;
use App\Models\Platform\Module\Education\Course\Point;
use App\Models\Platform\Module\Education\Course\Point\Question;
use App\Models\Platform\Module\Education\Paper\Paper;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-20
 *
 * 首页控制器
 */
class IndexController extends BaseController
{
  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-23
   * ------------------------------------------
   * 合计统计
   * ------------------------------------------
   *
   * 合计统计
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function total(Request $request)
  {
    $response = [];

    try
    {
      $response['member_total'] = Member::getCount(['status' => 1]);
      $response['course_total'] = Course::getCount(['status' => 1]);
      $response['point_total']  = Point::getCount(['status' => 1]);

      $time_length_total = Course::getPluck('time_length', ['status' => 1], false, false, true);
      $time_length_total = array_sum($time_length_total);
      $time_length_total = TimeEnum::getTimeLength($time_length_total);

      $response['time_length_total'] = $time_length_total;

      return self::success($response);
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return self::success($response);
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-23
   * ------------------------------------------
   * 课程统计
   * ------------------------------------------
   *
   * 课程统计
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function data(Request $request)
  {
    try
    {
      $response = Course::getList(['status' => 1]);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return self::success($response);
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-23
   * ------------------------------------------
   * 用户统计
   * ------------------------------------------
   *
   * 用户统计
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function user(Request $request)
  {
    $response = [];

    try
    {
      $member       = Member::getList(['status' => 1]);
      $organization = Organization::getList(['status' => 1]);

      $memberDate = [];
      $organizationDate = [];

      foreach($member as $item)
      {
        $memberDate[] = date('Y-m-d', strtotime($item->create_time));
      }

      $memberDate = array_count_values($memberDate);

      foreach($organization as $item)
      {
        $organizationDate[] = date('Y-m-d', strtotime($item->create_time));
      }

      $organizationDate = array_count_values($organizationDate);

      foreach($memberDate as $key => $item)
      {
        $response[] = [
          'title' => $key,
          '会员数' => $item,
        ];
      }

      $date = array_keys($memberDate);

      foreach($organizationDate as $k => $v)
      {
        foreach($response as $key => $item)
        {
          if($k == $item['title'])
          {
            $response[$key] = array_merge($response[$key], ['title' => $k , '机构数' => $v]);
          }
          else if(!in_array($k, $date))
          {
            $response[] = ['title' => $k, '机构数' => $v];

            break;
          }
        }
      }

      $sort = array_column($response, 'title');

      array_multisort($response, SORT_ASC, $sort);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return self::success($response);
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-23
   * ------------------------------------------
   * 学习设备统计
   * ------------------------------------------
   *
   * 学习设备统计
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function keyword(Request $request)
  {
    $response = [];

    try
    {
      $result = Keyword::getList(['status' => 1]);

      if(empty($result))
      {
        return self::success($response);
      }

      foreach($result as $item)
      {
        $response[] = [
          'title' => $item->title,
          'value' => $item->total,
        ];
      }

      return self::success($response);
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return self::success($response);
    }
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-23
   * ------------------------------------------
   * 学习设备统计
   * ------------------------------------------
   *
   * 学习设备统计
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function equipment(Request $request)
  {
    $response = [];

    try
    {
      $pc = Signature::getCount(['type' => 1, 'status' => 1]);
      $mobile = Signature::getCount(['type' => 2, 'status' => 1]);

      $response = [
        [
          'title' => '移动端',
          'value' => $mobile
        ],
        [
          'title' => 'PC端',
          'value' => $pc
        ],
      ];

      return self::success($response);
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return self::success($response);
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-23
   * ------------------------------------------
   * 课程统计
   * ------------------------------------------
   *
   * 课程统计
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function course(Request $request)
  {
    $response = [];

    try
    {
      $where = [['status', '>', -1]];

      $point = Point::getCount($where);


      // 讲授课程统计
      $teachWhere = array_merge($where, ['type' => 1]);
      $teach = Course::getCount($teachWhere);

      // 操作课程统计
      $operationWhere = array_merge($where, ['type' => 2]);
      $operation = Course::getCount($operationWhere);

      // 练习课程统计
      $practiceWhere = array_merge($where, ['type' => 3]);
      $practice = Course::getCount($practiceWhere);

      $response = [
        ['title'=> '讲授课程', 'value' => $teach],
        ['title'=> '操作课程', 'value' => $operation],
        ['title'=> '练习课程', 'value' => $practice],
        ['title'=> '技能知识点', 'value' => $point],
      ];

      return self::success($response);
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return self::success($response);
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-23
   * ------------------------------------------
   * 试题统计
   * ------------------------------------------
   *
   * 试题统计
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function question(Request $request)
  {
    $response = [];

    try
    {
      $where = [['status', '>', -1]];

      // 模拟试卷统计
      $paper = Paper::getCount($where);

      // 全部交互练习题题统计
      $question = Question::getCount($where);

      // 实践练习题统计
      $practiceWhere = array_merge($where, ['type' => 8]);
      $practice = Question::getCount($practiceWhere);


      $theory = bcsub($question, $practice);

      $response = [
        ['title'=> '课后练习', 'value' => $question],
        ['title'=> '模拟考试', 'value' => $paper],
        ['title'=> '实操练习题', 'value' => $practice],
        ['title'=> '理论练习题', 'value' => $theory],
      ];

      return self::success($response);
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return self::success($response);
    }
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-23
   * ------------------------------------------
   * 学习时长统计
   * ------------------------------------------
   *
   * 学习时长统计
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function study(Request $request)
  {
    $response = [];

    try
    {
      $date = [];

      $result = Signature::getList(['status' => 1]);

      if(empty($result))
      {
        return self::success($response);
      }

      foreach($result as $item)
      {
        $date[] = date('H:00', strtotime($item->sign_time));
      }

      $date = array_count_values($date);

      foreach($date as $key => $item)
      {
        $response[] = [
          'title' => $key,
          '学习人数' => $item,
        ];
      }

      $column = array_column($response, 'title');

      array_multisort($response, SORT_ASC, $column);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return self::success($response);
    }
  }
}
