<?php
namespace App\Http\Controllers\Platform\Module\Organization\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;
use App\Models\Platform\Module\Education\Course\Course;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-04
 *
 * 班级控制器类
 */
class CourseController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Organization\Relevance\Course';

  protected $_where = [];

  protected $_params = [
    'organization_id'
  ];

  protected $_addition = [
    'course' => [
      'title'
    ]
  ];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'list' => [
      'organization',
      'course',
    ],
    'select' => [
      'organization',
      'course',
    ],
    'view' => [
      'organization',
      'course',
    ]
  ];



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-07-19
   * ------------------------------------------
   * 获取数据详情
   * ------------------------------------------
   *
   * 获取数据详情
   *
   * @param Request $request 请求参数
   * @param [type] $id 数据编号
   * @return [type]
   */
  public function view(Request $request, $id)
  {
    $condition = self::getBaseWhereData();

    $where = ['id' => $id];

    $condition = array_merge($condition, $where);

    $relevance = self::getRelevanceData($this->_relevance, 'view');

    $response = $this->_model::getRow($condition, $relevance);

    return self::success($response);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-04
   * ------------------------------------------
   * 获取当前机构还可以购买的课程
   * ------------------------------------------
   *
   * 获取当前机构还可以购买的课程
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function course(Request $request)
  {
    try
    {
      $condition = [];

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $where = array_merge($condition, $this->_where, $filter);

      // 获取当前已选择的课程
      $response = $this->_model::getList($where, false, false, true);

      // 获取课程编号
      $course_id = array_column($response, 'course_id');

      // 获取未选过的课程
      $response = Course::where($condition)->whereNotIn('id', $course_id)->get();

      return self::success($response);
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return self::error(Code::ERROR);
    }
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-12
   * ------------------------------------------
   * 操作信息
   * ------------------------------------------
   *
   * 操作信息
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function handle(Request $request)
  {
    $messages = [
      'organization_id.required' => '请您输入所属机构',
      'course_id.required'       => '请您选择课程'
    ];

    $validator = Validator::make($request->all(), [
      'organization_id' => 'required',
      'course_id'       => 'required',
    ], $messages);


    if($validator->fails())
    {
      $error = $validator->getMessageBag()->toArray();
      $error = array_values($error);
      $message = $error[0][0] ?? Code::$message[Code::ERROR];

      return self::message($message);
    }
    else
    {
      $model = $this->_model::firstOrNew(['id' => $request->id]);

      $model->organization_id = $request->organization_id;
      $model->course_id       = $request->course_id;

      $response = $model->save();

      if($response)
      {
        return self::success(Code::message(Code::HANDLE_SUCCESS));
      }
      else
      {
        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }
}
