<?php
namespace App\Http\Controllers\Api\Module\Education\Graduation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;
use App\Events\Api\Organization\OperateLogEvent;
use App\Models\Api\Module\Organization\Squad\Relevance\Member;
use App\Models\Common\Module\Education\Graduation\Relevance\Squad;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-25
 *
 * 结业控制器类
 */
class GraduationController extends BaseController
{
  protected $_model = 'App\Models\Common\Module\Education\Graduation\Relevance\Squad';

  protected $_where = [];

  protected $_params = [];

  protected $_addition = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [];



  /**
   * @api {get} /api/education/graduation/view/{id} 获取结业详情
   * @apiDescription 获取结业详情
   * @apiGroup 结业模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/education/graduation/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    $condition = self::getBaseWhereData();

    $where = ['id' => $id];

    $condition = array_merge($condition, $where);

    $response = $this->_model::getRow($condition, $this->_relevance);

    return self::success($response);
  }



  /**
   * @api {get} /api/education/graduation/status 获取班级结业状态
   * @apiDescription 获取班级结业状态
   * @apiGroup 结业模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} squad_id 班级编号（不能为空）
   * @apiSampleRequest /api/education/graduation/status
   * @apiVersion 1.0.0
   */
  public function status(Request $request)
  {
    $messages = [
      'squad_id.required' => '请您输入班级编号',
    ];

    $validator = Validator::make($request->all(), [
      'squad_id' => 'required',
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
        $where = [
          'squad_id' => $request->squad_id
        ];

        $response = $this->_model::getRow($where);

        return self::success($response);
      }
      catch(\Exception $e)
      {
        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }



  /**
   * @api {post} /api/education/graduation/apply_first_step 结业申请第一步
   * @apiDescription 结业申请第一步
   * @apiGroup 结业模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {array} squad_id （不能为空）
   * @apiParam {json} example {"squad_id":1}
   * @apiVersion 1.0.0
   */
  public function apply_first_step(Request $request)
  {
    $messages = [
      'squad_id.required' => '请您输入班级编号',
    ];

    $validator = Validator::make($request->all(), [
      'squad_id' => 'required',
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
        $organization_id     = self::getOrganizationId();

        $model = $this->_model::firstOrNew([
          'organization_id' => $organization_id,
          'squad_id' => $request->squad_id
        ]);

        $model->save();

        $where = ['id' => $model->id];

        $response = $this->_model::getRow($where);

        // 记录操作行为日志
        event(new OperateLogEvent($this->user, $request));

        return self::success($response);
      }
      catch(\Exception $e)
      {
        DB::rollback();

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }


  /**
   * @api {post} /api/education/graduation/apply_second_step 结业申请第二步
   * @apiDescription 结业申请第二步
   * @apiGroup 结业模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} id 结业编号（不能为空）
   * @apiParam {array} graduation 可以结业学员（不能为空）
   * @apiParam {array} ungraduation 以结业学员（不能为空）
   * @apiParam {json} example {"id":"65","graduation":["1","2"], "ungraduation":["3","4"]}
   * @apiVersion 1.0.0
   */
  public function apply_second_step(Request $request)
  {
    $messages = [
      'id.required'           => '请您输入结业编号',
    ];

    $validator = Validator::make($request->all(), [
      'id'           => 'required',
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
        $model = $this->_model::find($request->id);

        if(empty($model))
        {
          return self::error(Code::GRADUATION_EMPTY);
        }

        $graduation = [];
        $ungraduation = [];

        if(!empty($request->graduation))
        {
          $graduation   = explode(',', $request->graduation);
        }

        if(!empty($request->ungraduation))
        {
          $ungraduation = explode(',', $request->ungraduation);
        }

        $model->graduation_number   = count($graduation);
        $model->ungraduation_number = count($ungraduation);

        $response = $model->save();

        $data = self::packGraduationData($graduation, 1);

        if(!empty($data))
        {
          $model->graduationRelevance()->delete();
          $model->graduationRelevance()->createMany($data);
        }

        $data = self::packGraduationData($ungraduation, 2);

        if(!empty($data))
        {
          $model->ungraduationRelevance()->delete();
          $model->ungraduationRelevance()->createMany($data);
        }

        // 记录操作行为日志
        event(new OperateLogEvent($this->user, $request));

        DB::commit();

        $where = ['id' => $model->id];

        $response = $this->_model::getRow($where);

        return self::success($response);
      }
      catch(\Exception $e)
      {
        DB::rollback();

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }
}
