<?php
namespace App\Http\Controllers\Api\Module\Organization\Squad\Relevance;

use Illuminate\Http\Request;
use App\Exports\StudyRecordExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 班级控制器类
 */
class MemberController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Organization\Squad\Relevance\Member';

  protected $_where = [];

  protected $_params = [
    'squad_id'
  ];

  protected $_addition = [
    'member.role' => [
      'role_id'
    ]
  ];

  protected $_order = [
    ['key' => 'id', 'value' => 'asc'],
  ];

  protected $_relevance = [
    'member.role',
    'member.archive',
    'signature'
  ];


  /**
   * @api {get} /api/organization/squad/member/student?page={page} 获取班级学生列表(分页)
   * @apiDescription 获取班级学生列表(分页)
   * @apiGroup 班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} squad_id 班级编号
   * @apiParam {int} page 当前页数
   * @apiVersion 1.0.0
   */
  public function student(Request $request)
  {
    $request['role_id'] = 3;

    $condition = self::getBaseWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order);

    return self::success($response);
  }


  /**
   * @api {get} /api/organization/squad/member/teacher?page={page} 获取班级老师列表(分页)
   * @apiDescription 获取班级老师列表(分页)
   * @apiGroup 班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} squad_id 班级编号
   * @apiParam {int} page 当前页数
   * @apiVersion 1.0.0
   */
  public function teacher(Request $request)
  {
    $request['role_id'] = 2;

    $condition = self::getBaseWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order);

    return self::success($response);
  }


  /**
   * @api {post} /api/organization/squad/member/graduation 获取当前可结业用户列表(不分页)
   * @apiDescription 获取当前可结业用户列表(不分页)
   * @apiGroup 班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {array} squad_id 班级编号（可以为空）
   * @apiVersion 1.0.0
   */
  public function graduation(Request $request)
  {
    $where = ['is_graduation' => 1];

    $condition = self::getBaseWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter, $where);

    $squad_id = [];

    if(!empty($request->squad_id))
    {
      $squad_id = explode(',', $request->squad_id);
    }

    $response = $this->_model::where($condition)
                              ->whereIn('squad_id', $squad_id)
                              ->with(['member' => function($query){
                                $query->with('archive');
                              }])
                              ->get();

    return self::success($response);
  }


  /**
   * @api {post} /api/organization/squad/member/ungraduation 获取当前不可结业用户列表(不分页)
   * @apiDescription 获取当前不可结业用户列表(不分页)
   * @apiGroup 班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {array} squad_id 班级编号（可以为空）
   * @apiVersion 1.0.0
   */
  public function ungraduation(Request $request)
  {
    $where = ['is_graduation' => 2];

    $condition = self::getBaseWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter, $where);

    $squad_id = [];

    if(!empty($request->squad_id))
    {
      $squad_id = explode(',', $request->squad_id);
    }

    $response = $this->_model::where($condition)
                              ->whereIn('squad_id', $squad_id)
                              ->with(['member' => function($query){
                                $query->with('archive');
                              }])
                              ->get();

    return self::success($response);
  }


  /**
   * @api {get} /api/organization/squad/member/roster?page={page} 获取班级花名册列表(分页)
   * @apiDescription 获取班级花名册列表(分页)
   * @apiGroup 班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} squad_id 班级编号
   * @apiParam {int} page 当前页数
   * @apiVersion 1.0.0
   */
  public function roster(Request $request)
  {
    $condition = self::getBaseWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $relevance = [
      'member.course',
    ];

    $squad_id = $request->squad_id ?? 0;

    $response = $this->_model::where($condition)->with(['member' => function($query) use ($squad_id) {
                  $query->with(['course' => function($query) use ($squad_id) {
                    $query->where(['squad_id' => $squad_id])->groupBy('member_id');
                  }]);
                }])->paginate(10);

    return self::success($response);
  }


  /**
   * @api {get} /api/organization/squad/member/export 导出学习记录档案
   * @apiDescription 导出学习记录档案
   * @apiGroup 班级模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} squad_id 班级编号(不能为空)
   * @apiVersion 1.0.0
   */
  public function export(Request $request)
  {
    if(empty($request->squad_id))
    {
      return self::error(Code::SQUAD_ID_EMPTY);
    }

    $squad_id = $request->squad_id;

    return Excel::download(new StudyRecordExport($squad_id), '学习记录档案.xlsx');
  }
}
