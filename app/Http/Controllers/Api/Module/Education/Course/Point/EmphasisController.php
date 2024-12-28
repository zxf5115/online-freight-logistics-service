<?php
namespace App\Http\Controllers\Api\Module\Education\Course\Point;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Http\Controllers\Api\BaseController;
use App\Events\Api\Organization\OperateLogEvent;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-28
 *
 * 课程重点控制器类
 */
class EmphasisController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Education\Course\Point\Emphasis';

  protected $_where = [];

  protected $_params = [
    'title',
    'course_id',
    'point_id',
  ];

  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  protected $_relevance = [];


  /**
   * @api {get} /api/education/course/point/emphasis/list?page={page} 获取课程重点列表(分页)
   * @apiDescription 获取课程重点列表(分页)
   * @apiGroup 课程重点模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} course_id 课程编号
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

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order);

    return self::success($response);
  }


  /**
   * @api {get} /api/education/course/point/emphasis/select 获取课程重点列表(不分页)
   * @apiDescription 获取课程重点列表(不分页)
   * @apiGroup 课程重点模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} course_id 课程编号
   * @apiSampleRequest /api/education/course/point/emphasis/select
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
   * @api {get} /api/education/course/point/emphasis/view/{id} 获取课程重点详情
   * @apiDescription 获取课程重点详情
   * @apiGroup 课程重点模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/education/course/point/emphasis/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    $condition = [
      ['status', '>', Status::DELETE]
    ];

    $where = ['id' => $id];

    $condition = array_merge($condition, $where);

    $response = $this->_model::getRow($condition, $this->_relevance);

    return self::success($response);
  }



  /**
   * @api {post} /api/education/course/point/emphasis/handle 创建课程重点信息
   * @apiDescription 创建课程重点信息
   * @apiGroup 课程重点模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} id 课程重点编号（为空：新增，不为空：编辑）
   * @apiParam {int} course_id 课程编号（不能为空）
   * @apiParam {int} point_id 课程知识点编号（不能为空）
   * @apiParam {int} squad_id 班级编号（不能为空）
   * @apiParam {string} content 重点内容（不能为空）
   * @apiParam {array} attachment 附件地址数组（可以为空）
   * @apiParam {json} example {"id":"65","course_id":"11","point_id":"6","squad_id":["7","8"],"title":"2222222222","content":"31231313212312312313","attachment":[{"title":"111","url":"www.qiansha"},{"title":"222","url":"www.xiechengfuwu.com"},{"title":"333","url":"www.baidu.com"}]}
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'course_id.required' => '请您输入课程编号',
      'point_id.required'  => '请您输入课程知识点编号',
      'squad_id.required'  => '请您输入班级编号',
      'title.required'     => '请您输入重点标题',
      'content.required'   => '请您输入重点内容',
    ];

    $validator = Validator::make($request->all(), [
      'course_id' => 'required',
      'point_id' => 'required',
      'title'    => 'required',
      'content'  => 'required'
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
      DB::beginTransaction();

      try
      {
        $model = $this->_model::firstOrNew(['id' => $request->id]);

        $organization_id = self::getOrganizationId();

        $model->organization_id = $organization_id;
        $model->course_id       = $request->course_id;
        $model->point_id        = $request->point_id;
        $model->title           = $request->title;
        $model->content         = $request->content;

        $response = $model->save();

        $data = json_decode($request->attachment, true);

        if(!empty($data))
        {
          foreach($data as &$item)
          {
            $item['organization_id'] = $organization_id;
          }

          $model->attachment()->delete();
          $model->attachment()->createMany($data);
        }

        $request->squad_id = explode(',', $request->squad_id);

        $data = self::packRelevanceData($request, 'squad_id');

        if(!empty($data))
        {
          $model->squadRelevance()->delete();
          $model->squadRelevance()->createMany($data);
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
}
