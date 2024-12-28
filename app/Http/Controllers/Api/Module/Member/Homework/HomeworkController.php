<?php
namespace App\Http\Controllers\Api\Module\Member\Homework;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-24
 *
 * 会员作业控制器类
 */
class HomeworkController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Member\Homework\Homework';

  protected $_where = [];

  protected $_params = [
    'squad_id',
    'member_id',
    'course_id',
    'point_id',
  ];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'attachment',
    'homework.resource'
  ];


  /**
   * @api {get} /api/member/homework/list?page={page} 获取当前用户作业列表(分页)
   * @apiDescription 获取当前用户作业列表(分页)
   * @apiGroup 会员作业模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} page 当前页数
   * @apiParam {int} squad_id 班级编号（可以为空）
   * @apiParam {int} member_id 会员编号（可以为空）
   * @apiParam {int} course_id 课程编号（可以为空）
   * @apiParam {int} point_id 知识点编号（可以为空）
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    $condition = self::getCurrentWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order);

    return self::success($response);
  }


  /**
   * @api {get} /api/member/homework/select 获取当前用户作业列表(不分页)
   * @apiDescription 获取当前用户作业列表(不分页)
   * @apiGroup 会员作业模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/member/homework/select
   * @apiParam {int} member_id 会员编号（可以为空）
   * @apiParam {int} course_id 课程编号（可以为空）
   * @apiParam {int} point_id 知识点编号（可以为空）
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    $condition = self::getCurrentWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getList($condition, $this->_relevance, $this->_order, true);

    return self::success($response);
  }


  /**
   * @api {get} /api/member/homework/view/{id} 获取当前用户作业详情
   * @apiDescription 获取当前用户作业详情
   * @apiGroup 会员作业模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/member/homework/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    $condition = self::getCurrentWhereData();

    $where = ['id' => $id];

    $condition = array_merge($condition, $where);

    $response = $this->_model::getRow($condition, $this->_relevance);

    return self::success($response);
  }


  /**
   * @api {post} /api/member/homework/handle 写作业
   * @apiDescription 写作业
   * @apiGroup 会员作业模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} squad_id 班级编号（不能为空）
   * @apiParam {int} homework_id 作业编号（不能为空）
   * @apiParam {string} answer 作业答案（不能为空）
   * @apiParam {array} attachment 附件地址数组（可以为空）
   * @apiParam {json} example {"homework_id":"5","answer":"31231313212312312313","attachment":[{"title":"111","url":"www.qiansha"},{"title":"222","url":"www.xiechengfuwu.com"},{"title":"333","url":"www.baidu.com"}]}
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'homework_id.required' => '请您输入作业编号',
      'answer.required'      => '请您输入作业答案'
    ];

    $validator = Validator::make($request->all(), [
      'homework_id' => 'required',
      'answer'      => 'required',
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
        $organization_id = self::getOrganizationId();
        $member_id       = self::getCurrentId();

        $model = $this->_model::firstOrNew([
          'organization_id' => $organization_id,
          'member_id'       => $member_id,
          'squad_id'        => $request->squad_id,
          'homework_id'     => $request->homework_id,
        ]);

        $model->organization_id = $organization_id;
        $model->member_id       = $member_id;
        $model->squad_id        = $request->squad_id;
        $model->homework_id     = $request->homework_id;
        $model->answer          = $request->answer;

        $response = $model->save();

        if(!empty($request->attachment))
        {
          $data = json_decode($request->attachment, true);

          foreach($data as &$item)
          {
            $item['organization_id'] = $organization_id;
          }

          $model->attachment()->delete();
          $model->attachment()->createMany($data);
        }

        DB::commit();

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        DB::rollback();

        self::record($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }


  /**
   * @api {post} /api/member/homework/correct 批改作业
   * @apiDescription 批改作业
   * @apiGroup 会员作业模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} homework_id 作业编号（不能为空）
   * @apiParam {int} result 作业是否正确 1 正确 2 错误（不能为空）
   * @apiParam {string} remark 作业批注（可以为空）
   * @apiParam {json} example {"homework_id":"5","result":1,"remark":"回到的很不错"}
   * @apiVersion 1.0.0
   */
  public function correct(Request $request)
  {
    $messages = [
      'organization_id.required' => '请您输入机构编号',
      'member_id.required'       => '请您输入学员编号',
      'homework_id.required'     => '请您输入作业编号',
      'result.required'          => '请您输入作业结果'
    ];

    $validator = Validator::make($request->all(), [
      'organization_id' => 'required',
      'member_id'       => 'required',
      'homework_id'     => 'required',
      'result'          => 'required',
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
        $model = $this->_model::where([
          'organization_id' => $request->organization_id,
          'member_id'       => $request->member_id,
          'homework_id'     => $request->homework_id,
        ])->first();

        if(empty($model))
        {
          return self::error(Code::HOMEWORK_EMPTY);
        }

        $model->result = $request->result;
        $model->remark = $request->remark ?? '';
        $response = $model->save();

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }
}
