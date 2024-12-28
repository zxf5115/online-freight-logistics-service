<?php
namespace App\Http\Controllers\Api\Module\Education\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Events\Api\KeywordEvent;
use App\Http\Controllers\Api\BaseController;
use App\Models\Common\Module\Education\Course\Relevance\Question;
use App\Models\Common\Module\Education\Course\Relevance\Label;
use App\Models\Platform\Module\Education\Course\Unit;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 课程控制器类
 */
class CourseController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Education\Course\Course';

  // 默认查询条件
  protected $_where = [
    'is_hidden' => 2
  ];

  // 查询条件
  protected $_params = [
    'title'
  ];

  // 附加关联查询条件
  protected $_addition = [];

  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  // 关联数组
  protected $_relevance = [
    'label',
    'resource'
  ];


  /**
   * @api {get} /api/education/course/list?page={page} 获取课程列表(分页)
   * @apiDescription 获取课程列表(分页)
   * @apiGroup 课程模块
   * @apiParam {string} title 课程标题(可以为空)
   * @apiParam {int} page 当前页数
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    $condition = [
      ['status', '>', Status::DELETE]
    ];

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    if(!empty($request->title))
    {
      // 保存热搜关键字
      event(new KeywordEvent($request->title));
    }

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order, false, 12);

    return self::success($response);
  }


  /**
   * @api {get} /api/education/course/select 获取课程列表(不分页)
   * @apiDescription 获取课程列表(不分页)
   * @apiGroup 课程模块
   * @apiParam {string} title 课程标题(可以为空)
   * @apiSampleRequest /api/education/course/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    $condition = [
      ['status', '>', Status::DELETE]
    ];

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getList($condition, $this->_relevance, $this->_order, true);

    return self::success($response);
  }


  /**
   * @api {get} /api/education/course/view/{id} 获取课程详情
   * @apiDescription 获取课程详情
   * @apiGroup 课程模块
   * @apiSampleRequest /api/education/course/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    $condition = [
      ['status', '>', Status::DELETE]
    ];

    $where = [
      'id' => $id
    ];

    $condition = array_merge($condition, $where);

    $relevance = [
      'label',
    ];

    $response = $this->_model::getRow($condition, $relevance);

    return self::success($response);
  }




  /**
   * @api {get} /api/education/course/recommend 获取推荐课程列表(不分页)
   * @apiDescription 获取推荐课程列表(不分页)
   * @apiGroup 课程模块
   * @apiSampleRequest /api/education/course/recommend
   * @apiVersion 1.0.0
   */
  public function recommend(Request $request)
  {
    $condition = [
      ['status', '>', Status::DELETE]
    ];

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $where = ['is_recommend' => 1];

    $condition = array_merge($condition, $this->_where, $filter, $where);

    $response = $this->_model::getList($condition, $this->_relevance, $this->_order, true, 12);

    return self::success($response);
  }


  /**
   * @api {post} /api/education/course/similarity 获取相似课程列表(不分页)
   * @apiDescription 获取相似课程列表(不分页)
   * @apiGroup 课程模块
   * @apiParam {array} label_id 标签数组（不能为空）
   * @apiParam {json} example {"label_id": ["66", "67"]}
   * @apiSampleRequest /api/education/course/similarity
   * @apiVersion 1.0.0
   */
  public function similarity(Request $request)
  {
    if(empty($request->label_id))
    {
      return self::error(Code::LABEL_EMPTY);
    }

    $label_id = $request->label_id;

    $condition = [
      ['status', '>', Status::DELETE]
    ];

    $course_id = Label::where($condition)->whereIn('label_id', $label_id)->pluck('course_id');

    $response = $this->_model::where($condition)
                            ->whereIn('id', $course_id)
                            ->orderBy('create_time', 'desc')
                            ->limit(8)
                            ->get();

    return self::success($response);
  }


  /**
   * @api {post} /api/education/course/column 课程是否有栏目
   * @apiDescription 获取指定课程是否有栏目
   * @apiGroup 课程模块
   * @apiParam {array} course_id 课程编号（不能为空）
   * @apiSampleRequest /api/education/course/column
   * @apiVersion 1.0.0
   */
  public function column(Request $request)
  {
    $messages = [
      'course_id.required' => '请您输入课程编号',
    ];

    $validator = Validator::make($request->all(), [
      'course_id' => 'required',
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
      try
      {
        $response = false;

        $condition = [
          ['status', '>', Status::DELETE]
        ];

        $where = [
          'is_column' => '1',
          'parent_id' => '0',
          'course_id' => $request->course_id
        ];

        $where = array_merge($condition, $where);

        $result = Unit::getList($where);

        if(count($result) > 0)
        {
          $response = $result;
        }

        return self::success($response);
      }
      catch(\Exception $e)
      {
        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }
}
