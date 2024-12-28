<?php
namespace App\Http\Controllers\Api\Module\Member\Study\Progress;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Parameter;
use App\Http\Controllers\Api\BaseController;
use App\Models\Common\Module\Education\Course\Unit;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 会议学习课程单元进度控制器类
 */
class UnitController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Member\Study\Progress\Unit';

  protected $_where = [

  ];

  protected $_params = [
    'squad_id',
    'course_id',
    'parent_id'
  ];

  protected $_order = [
    ['key' => 'id', 'value' => 'asc'],
  ];

  protected $_relevance = [
    'unit'
  ];


  /**
   * @api {get} /api/member/study/progress/course/unit/list 获取会员学习课程单元进度信息
   * @apiDescription 获取会员学习课程单元进度信息
   * @apiGroup 会员学习进度模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} squad_id 班级编号
   * @apiParam {int} course_id 课程编号
   * @apiParam {int} parent_id 上级单元编号（顶级单元，传0）
   * @apiSampleRequest /api/member/study/progress/course/unit/list
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    $where = [];

    if(0 == $request->parent_id)
    {
      $condition = ['is_column' => 1, 'status' => 1, 'parent_id' => 0, 'course_id' => $request->course_id];

      $parent_id = Unit::getPluck('id', $condition, false, false, true);

      if(!empty($parent_id))
      {
        $where = [
          'status' => 1,
          ['parent_id', $parent_id]
        ];

        $unit_id = Unit::getPluck('id', $where, false, false, true);

        $where = [
          ['unit_id', $unit_id]
        ];

        $request['parent_id'] = '';
      }

    }


    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = self::getCurrentWhereData();

    $condition = array_merge($condition, $this->_where, $filter, $where);

    $response = $this->_model::getList($condition, $this->_relevance);

    return self::success($response);
  }
}
