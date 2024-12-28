<?php
namespace App\Http\Controllers\Api\Module\Organization\Squad;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\TraitClass\ToolTrait;
use App\Imports\RosterImport;
use App\Models\Platform\System\File;
use App\Models\Api\Module\Member\Member;
use App\Http\Controllers\Api\BaseController;
use App\Events\Api\Member\Study\ProgressEvent;
use App\Events\Api\Organization\OperateLogEvent;
use App\Models\Api\Module\Organization\Squad\Relevance\Member as SquadMember;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 班级控制器类
 */
class SquadController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Organization\Squad\Squad';

  protected $_where = [
    'audit_status' => 1,
    'open_status' => 1
  ];

  protected $_params = [
    'title',
    'organization_id',
  ];

  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'organization',
    'course'
  ];


  /**
   * @api {get} /api/organization/squad/list?page={page} 获取班级列表(分页)
   * @apiDescription 获取班级列表(分页)
   * @apiGroup 班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} page 当前页数
   * @apiParam {int} organization_id 机构编号
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    $condition = self::getBaseWhereData();

    $role_id = self::getCurrentRoleId();

    if(2 == $role_id)
    {
      $where = self::getCurrentWhereData();

      $result = SquadMember::getList($where, false, false, true);

      $squad_id = array_column($result, 'squad_id');

      $where = [
        ['id', $squad_id]
      ];

      $condition = array_merge($condition, $where);
    }

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order);

    return self::success($response);
  }


  /**
   * @api {get} /api/organization/squad/select 获取班级列表(不分页)
   * @apiDescription 获取班级列表(不分页)
   * @apiGroup 班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} organization_id 机构编号
   * @apiSampleRequest /api/organization/squad/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    $condition = self::getBaseWhereData();

    $role_id = self::getCurrentRoleId();

    if(2 == $role_id)
    {
      $where = self::getCurrentWhereData();

      $result = SquadMember::getList($where, false, false, true);

      $squad_id = array_column($result, 'squad_id');

      $where = [
        ['id', $squad_id]
      ];

      $condition = array_merge($condition, $where);
    }

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getList($condition, $this->_relevance, $this->_order, true);

    return self::success($response);
  }


  /**
   * @api {get} /api/organization/squad/view/{id} 获取班级详情
   * @apiDescription 获取班级详情
   * @apiGroup 班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/organization/squad/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    $condition = self::getBaseWhereData();

    $where = [
      'id' => $id
    ];

    $condition = array_merge($condition, $this->_where, $where);

    $response = $this->_model::getRow($condition, $this->_relevance);

    return self::success($response);
  }


  /**
   * @api {post} /api/organization/squad/course 添加班级课程
   * @apiDescription 添加班级课程
   * @apiGroup 班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} id 班级编号（不能为空）
   * @apiParam {string} course_id 课程信息（不能为空）
   * @apiParam {json} example {"id":"2","course_id":[课程编号1,课程编号2]}
   * @apiSampleRequest /api/organization/squad/course
   * @apiVersion 1.0.0
   */
  public function course(Request $request)
  {
    $messages = [
      'id.required'  => '请您输入班级编号',
      'course_id.required' => '请您选择课程信息',
    ];

    $validator = Validator::make($request->all(), [
      'id'  => 'required',
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
        $model = $this->_model::find($request->id);

        $data = [
          'organization_id' => self::getOrganizationId(),
          'course_id' => $request->course_id
        ];

        if(!empty($data))
        {
          // 删除当前班级课程的学员学习记录
          $model->memberCourse()->delete();
          $model->courseProgress()->delete();
          $model->unitProgress()->delete();
          $model->pointProgress()->delete();

          // 更新当前班级课程信息
          $model->courseRelevance()->delete();
          $model->courseRelevance()->create($data);
        }

        // 当前班级没有课程时，提示
        if(count($model->course) == 0)
        {
          return self::error(Code::SQUAD_COURSE_EMPTY);
        }

        $course = $model->course->toArray();

        $course_id = $course[0]['id'];

        // 保存课程
        event(new ProgressEvent($model->id, $request->course_id));

        // 记录操作行为日志
        event(new OperateLogEvent($this->user, $request));

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }

  /**
   * @api {post} /api/organization/squad/apply_first_step 申请班级第一步
   * @apiDescription 申请班级第一步
   * @apiGroup 班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} title 班级名称（不能为空）
   * @apiParam {string} number 班级人数（不能为空）
   * @apiParam {string} teacher_id 班主任id（不能为空）
   * @apiParam {json} example {"title":"班级名称","number":"班级人数","teacher_id":"班主任编号"}
   * @apiSampleRequest /api/organization/squad/apply_first_step
   * @apiVersion 1.0.0
   */
  public function apply_first_step(Request $request)
  {
    $messages = [
      'title.required'      => '请您输入班级名称',
      'title.unique'        => '班级名称重复',
      'number.required'     => '请您输入班级人数',
      'teacher_id.required' => '请您选选择主任编号',
    ];

    $validator = Validator::make($request->all(), [
      'title'      => 'required',
      'title'      => 'unique:module_squad,title,' . $request->id,
      'number'     => 'required',
      'teacher_id' => 'required',
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
        $model = $this->_model::firstOrNew(['id' => $request->id]);

        if(empty($request->id))
        {
          $model->squad_no = ToolTrait::generateOnlyNumber(2);
        }

        $organization_id = self::getOrganizationId();

        $member = Member::getRow(['id' => $request->teacher_id])->getattributes();

        $model->organization_id = $organization_id;
        $model->title           = $request->title;
        $model->number          = $request->number;
        $model->teacher_id      = $request->teacher_id;
        $model->teacher_name    = $member['nickname'];
        $model->teacher_mobile  = $member['username'];
        $model->step            = 1;

        $model->save();

        $where = ['id' => $model->id];

        $response = $this->_model::getRow($where);

        // 记录操作行为日志
        event(new OperateLogEvent($this->user, $request));

        return self::success($response);
      }
      catch(\Exception $e)
      {
        \Log::error($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }



  /**
   * @api {post} /api/organization/squad/apply_second_step 申请班级第二步
   * @apiDescription 申请班级第一步
   * @apiGroup 班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} id 班级编号（不能为空）
   * @apiParam {string} description 培训计划（不能为空）
   * @apiParam {string} start_time 开班时间（不能为空）
   * @apiParam {string} end_time 结业时间（不能为空）
   * @apiParam {json} example {"id":"2","description":"培训计划","start_time":"2020-12-12","end_time":"2021-12-12"}
   * @apiSampleRequest /api/organization/squad/apply_second_step
   * @apiVersion 1.0.0
   */
  public function apply_second_step(Request $request)
  {
    $messages = [
      'id.required'          => '请您输入班级编号',
      'description.required' => '请您输入培训计划',
      'start_time.required'  => '请您选择开班时间',
      'end_time.required'    => '请您选择结业时间',
    ];

    $validator = Validator::make($request->all(), [
      'id'          => 'required',
      'description' => 'required',
      'start_time'  => 'required',
      'end_time'    => 'required',
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
      $model = $this->_model::find($request->id);

      $model->description = $request->description;
      $model->start_time  = strtotime($request->start_time);
      $model->end_time    = strtotime($request->end_time);
      $model->step        = 2;

      try
      {
        $response = $model->save();

        $where = ['id' => $model->id];

        $response = $this->_model::getRow($where);

        // 记录操作行为日志
        event(new OperateLogEvent($this->user, $request));

        return self::success($response);
      }
      catch(\Exception $e)
      {
        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }


  /**
   * @api {post} /api/organization/squad/apply_third_step 申请班级第三步
   * @apiDescription 申请班级第三步
   * @apiGroup 班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} id 班级编号（不能为空）
   * @apiParam {string} file 花名册（不能为空）
   * @apiSampleRequest /api/organization/squad/apply_third_step
   * @apiVersion 1.0.0
   */
  public function apply_third_step(Request $request)
  {
    $messages = [
      'id.required'   => '请您输入班级编号',
      'file.required' => '请您上传花名册',
    ];

    $validator = Validator::make($request->all(), [
      'id'   => 'required',
      'file' => 'required',
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

        $model->step = 3;

        $url = File::file_base64($request->file, 'roster');
        $url = str_replace('storage', '/storage/app/public', $url);
        $url = base_path(trim($url, '/'));

        $mobile = $model->teacher_mobile;

        $member = Member::getRow(['username' => $mobile]);

        $data = [[
          'organization_id' => $model->organization_id,
          'member_id' => $member->id
        ]];

        $model->memberRelevance()->createMany($data);

        $response = $model->save();

        Excel::import(new RosterImport($request->id), $url);

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

        \Log::error($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }


  /**
   * @api {post} /api/organization/squad/apply_fourth_step 申请班级第四步
   * @apiDescription 申请班级第四步
   * @apiGroup 班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} id 班级编号（不能为空）
   * @apiParam {string} course_id 课程信息（不能为空）
   * @apiParam {json} example {"id":"2","course_id":[课程编号1,课程编号2]}
   * @apiSampleRequest /api/organization/squad/apply_fourth_step
   * @apiVersion 1.0.0
   */
  public function apply_fourth_step(Request $request)
  {
    $messages = [
      'id.required'        => '请您输入班级编号',
      'course_id.required' => '请您选择课程信息',
    ];

    $validator = Validator::make($request->all(), [
      'id'        => 'required',
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
      $model = $this->_model::find($request->id);

      $model->step = 4;

      DB::beginTransaction();

      try
      {
        $response = $model->save();

        $data = [
          'organization_id' => self::getOrganizationId(),
          'course_id'       => $request->course_id
        ];

        if(!empty($data))
        {
          $model->courseRelevance()->delete();
          $model->courseRelevance()->create($data);
        }

        // 保存课程
        event(new ProgressEvent($model->id, $request->course_id));

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



  /**
   * @api {post} /api/organization/squad/again_add_student 再次添加学员
   * @apiDescription 再次添加学员
   * @apiGroup 班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} id 班级编号（不能为空）
   * @apiParam {string} file 花名册（不能为空）
   * @apiSampleRequest /api/organization/squad/again_add_student
   * @apiVersion 1.0.0
   */
  public function again_add_student(Request $request)
  {
    $messages = [
      'id.required'   => '请您输入班级编号',
      'file.required' => '请您上传花名册',
    ];

    $validator = Validator::make($request->all(), [
      'id'   => 'required',
      'file' => 'required',
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
        $url = File::file_base64($request->file, 'roster');
        $url = str_replace('storage', '/storage/app/public', $url);
        $url = base_path(trim($url, '/'));

        Excel::import(new RosterImport($request->id), $url);

        $model = $this->_model::find($request->id);

        // 当前班级没有课程时，提示
        if(count($model->course) == 0)
        {
          return self::error(Code::SQUAD_COURSE_EMPTY);
        }

        $course = $model->course->toArray();

        $course_id = $course[0]['id'];

        $data = [
          'organization_id' => self::getOrganizationId(),
          'course_id'       => $course_id
        ];

        if(!empty($data))
        {
          $model->courseRelevance()->delete();
          $model->courseRelevance()->create($data);
        }

        // 保存课程
        event(new ProgressEvent($model->id, $course_id));

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





  /**
   * @api {post} /api/organization/squad/change_status 修改班级状态
   * @apiDescription 修改班级状态
   * @apiGroup 班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} squad_id 班级编号（不能为空）
   * @apiParam {string} status 班级状态 1 开课 2 停课（不能为空）
   * @apiSampleRequest /api/organization/squad/change_status
   * @apiVersion 1.0.0
   */
  public function change_status(Request $request)
  {
    $messages = [
      'squad_id.required' => '请您输入班级编号',
      'status.required'   => '请您输入班级状态',
    ];

    $validator = Validator::make($request->all(), [
      'squad_id' => 'required',
      'status'   => 'required',
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
      $model = $this->_model::getRow(['id' => $request->squad_id]);

      try
      {
        $model->open_status = $request->status;

        // 记录操作行为日志
        event(new OperateLogEvent($this->user, $request));

        $model->save();

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }


  /**
   * @api {post} /api/organization/squad/change_end_time 修改班级结业时间
   * @apiDescription 修改班级结业时间
   * @apiGroup 班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} squad_id 班级编号（不能为空）
   * @apiParam {string} end_time 结业时间（不能为空）
   * @apiSampleRequest /api/organization/squad/change_end_time
   * @apiVersion 1.0.0
   */
  public function change_end_time(Request $request)
  {
    $messages = [
      'squad_id.required' => '请您输入班级编号',
      'end_time.required' => '请您输入结业时间',
    ];

    $validator = Validator::make($request->all(), [
      'squad_id' => 'required',
      'end_time' => 'required',
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
      $model = $this->_model::getRow(['id' => $request->squad_id]);

      try
      {
        $model->end_time = strtotime($request->end_time);

        // 记录操作行为日志
        event(new OperateLogEvent($this->user, $request));

        $model->save();

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }


  /**
   * @api {post} /api/organization/squad/status 是否可以结业
   * @apiDescription 是否可以结业
   * @apiGroup 班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} squad_id 班级编号（不能为空）
   * @apiSampleRequest /api/organization/squad/status
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
        $response = false;

        $model = $this->_model::getRow(['id' => $request->squad_id], false, true);

        if(time() > strtotime($model['end_time']))
        {
          $response = true;
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
