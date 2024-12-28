<?php
namespace App\Http\Controllers\Api\Module\Education\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Http\Constant\Parameter;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-28
 *
 * 课程单元控制器类
 */
class UnitController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Education\Course\Unit';

  protected $_where = [
    'parent_id' => 0
  ];

  protected $_params = [
    'course_id',
    'parent_id',
    'title'
  ];

  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'list'   => false,
    'select' => false,
    'view'   => ['children']
  ];

  protected $course_id = 0;


  /**
   * @api {get} /api/education/course/unit/list?page={page} 获取课程单元列表(分页)
   * @apiDescription 获取课程单元列表(分页)
   * @apiGroup 课程单元模块
   * @apiParam {int} course_id 课程编号（不能为空）
   * @apiParam {int} parent_id 课程编号（不能为空）
   * @apiParam {int} page 当前页数
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    try
    {
      $condition = self::getSimpleWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      $relevance = self::getRelevanceData($this->_relevance, 'list');

      if(!empty($request->title))
      {
        // 保存热搜关键字
        event(new KeywordEvent($request->title));
      }

      $response = $this->_model::getPaging($condition, $relevance, $this->_order);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @api {get} /api/education/course/unit/select 获取课程单元列表(不分页)
   * @apiDescription 获取课程单元列表(不分页)
   * @apiGroup 课程单元模块
   * @apiParam {int} course_id 课程编号
   * @apiParam {int} parent_id 课程编号（不能为空）
   * @apiSampleRequest /api/education/course/unit/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    try
    {
      $condition = self::getSimpleWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      $relevance = self::getRelevanceData($this->_relevance, 'select');

      $response = $this->_model::getList($condition, $relevance, $this->_order);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @api {get} /api/education/course/unit/view/{id} 获取课程单元详情
   * @apiDescription 获取课程单元详情
   * @apiGroup 课程单元模块
   * @apiSampleRequest /api/education/course/unit/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    try
    {
      // 课程单元知识点
      $key = Parameter::REDIS_COURSE_UNIT;

      if(Redis::hexists($key, $id))
      {
        $data = Redis::hget($key, $id);

        $response = unserialize($data);
      }
      else
      {
        $condition = self::getSimpleWhereData($id);

        $relevance = self::getRelevanceData($this->_relevance, 'view');

        $response = $this->_model::getRow($condition, $relevance);

        $data = serialize($response);

        Redis::hset($key, $id, $data);
      }

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @api {post} /api/education/course/unit/index 课程首页单元（栏目）
   * @apiDescription 课程首页单元（栏目）
   * @apiGroup 课程单元模块
   * @apiParam {int} course_id 课程编号
   * @apiSampleRequest /api/education/course/unit/index
   * @apiVersion 1.0.0
   */
  public function index(Request $request)
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

        $unit_id = $this->_model::getPluck('id', $where, false, false, true);

        $condition = self::getSimpleWhereData();

        if(empty($unit_id))
        {
          // 对用户请求进行过滤
          $filter = $this->filter($request->all());

          $condition = array_merge($condition, $this->_where, $filter);

          $relevance = self::getRelevanceData($this->_relevance, 'select');

          $response = $this->_model::getList($condition, $relevance, $this->_order);

          return self::success($response);
        }

        $where = [[
          'parent_id',
          $unit_id
        ]];

        $condition = array_merge($condition, $where);

        $relevance = self::getRelevanceData($this->_relevance, 'list');

        $response = $this->_model::getList($condition, $relevance, $this->_order);

        return self::success($response);
      }
      catch(\Exception $e)
      {
        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }
}
