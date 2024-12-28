<?php
namespace App\Http\Controllers\Api\Module\Education\Homework;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;
use App\Events\Api\Organization\OperateLogEvent;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-25
 *
 * 作业控制器类
 */
class HomeworkController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Education\Homework\Homework';

  protected $_where = [];

  protected $_params = [
    'course_id'
  ];

  protected $_addition = [
    'squadRelevance' => [
      'squad_id'
    ]
  ];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'resource',
    'squadRelevance',
    'squad'
  ];


  /**
   * @api {get} /api/education/homework/list?page={page} 获取作业列表(分页)
   * @apiDescription 获取作业列表(分页)
   * @apiGroup 作业模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} page 当前页数
   * @apiParam {int} course_id 课程编号（可以为空）
   * @apiParam {int} squad_id 班级编号（可以为空）
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    $condition = self::getBaseWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order);

    return self::success($response);
  }


  /**
   * @api {get} /api/education/homework/select 获取作业列表(不分页)
   * @apiDescription 获取作业列表(不分页)
   * @apiGroup 作业模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} course_id 课程编号（可以为空）
   * @apiParam {int} squad_id 班级编号（可以为空）
   * @apiSampleRequest /api/education/homework/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    $condition = self::getBaseWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getList($condition, $this->_relevance, $this->_order, true);

    return self::success($response);
  }


  /**
   * @api {get} /api/education/homework/view/{id} 获取作业详情
   * @apiDescription 获取作业详情
   * @apiGroup 作业模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/education/homework/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    $condition = self::getBaseWhereData();

    $where = ['id' => $id];

    $condition = array_merge($condition, $where);

    $relevance = ['resource', 'answer'];

    $response = $this->_model::getRow($condition, $relevance);

    return self::success($response);
  }


  /**
   * @api {post} /api/education/homework/handle 创建作业
   * @apiDescription 创建作业
   * @apiGroup 作业模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} id 作业编号（为空：新增，不为空：编辑）
   * @apiParam {int} course_id 课程编号（不能为空）
   * @apiParam {int} point_id 课程知识点编号（不能为空）
   * @apiParam {string} squad_id 班级编号（不能为空）
   * @apiParam {string} title 作业标题（不能为空）
   * @apiParam {string} content 作业内容（不能为空）
   * @apiParam {array} squad_id 作业班级数组（不能为空）
   * @apiParam {array} resource 作业资源地址数组（可以为空）
   * @apiParam {json} example {"id":"65","course_id":"5","point_id":"5","squad_id":"1,2,3","title":"22222222222","content":"31231313212312312313","resource":[{"title":"11111","url":"www.11111.com"},{"title":"22222","url":"www.22222.com"}]}
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'course_id.required' => '请您输入择课程编号',
      'point_id.required'  => '请您输入课程知识点编号',
      'squad_id.required'  => '请您输入班级编号',
      'title.required'     => '请您输入作业标题',
      'content.required'   => '请您输入作业内容',
    ];

    $validator = Validator::make($request->all(), [
      'course_id' => 'required',
      'point_id'  => 'required',
      'squad_id'  => 'required',
      'title'     => 'required',
      'content'   => 'required',
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
      $organization_id = self::getOrganizationId();

      $model = $this->_model::firstOrNew(['id' => $request->id]);

      $model->organization_id = $organization_id;
      $model->course_id       = $request->course_id;
      $model->point_id        = $request->point_id;
      $model->title           = $request->title;
      $model->content         = $request->content;
      $model->sort            = $request->sort ?? 0;

      DB::beginTransaction();

      try
      {
        $response = $model->save();

        $data = json_decode($request->resource, true);

        foreach($data as &$item)
        {
          $item['organization_id'] = $organization_id;
        }

        if(!empty($data))
        {
          $model->resource()->delete();

          $model->resource()->createMany($data);
        }

        $request->squad_id = explode(',', $request->squad_id);

        $data = self::packRelevanceData($request, 'squad_id');

        if(!empty($data))
        {
          $model->squad()->detach();
          $model->squad()->attach($data);
        }

        // 记录操作行为日志
        event(new OperateLogEvent($this->user, $request));

        DB::commit();

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        DB::rollback();

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }


  /**
   * @api {post} /api/education/homework/delete 删除作业信息
   * @apiDescription 删除作业信息
   * @apiGroup 作业模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/education/homework/delete
   * @apiVersion 1.0.0
   */
  public function delete(Request $request)
  {
    try
    {
      $condition = self::getBaseWhereData();

      $id = json_decode($request->id) ?? [0];

      $response = $this->_model::remove($id);

      // 记录操作行为日志
      event(new OperateLogEvent($this->user, $request));

      return self::success($response);
    }
    catch(\Exception $e)
    {
      return self::error(Code::ERROR);
    }
  }
}
