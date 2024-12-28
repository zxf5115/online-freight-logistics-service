<?php
namespace App\Http\Controllers\Api\Module\Organization\Squad;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Parameter;
use App\Http\Controllers\Api\BaseController;
use App\Models\Common\Module\Member\Relevance\MemberCourseRelevance;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 机构班级成绩控制器类
 */
class GradeController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Organization\Squad\Grade';

  protected $_where = [];

  protected $_params = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'course',
    'memberCourse'
  ];


  /**
   * @api {get} /api/organization/squad/grade/center/{squad_id} 获取机构成绩中心信息
   * @apiDescription 获取机构成绩中心信息
   * @apiGroup 机构成绩中心模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} squad_id 班级编号
   * @apiSampleRequest /api/organization/squad/grade/center/{squad_id}
   * @apiVersion 1.0.0
   */
  public function center(Request $request, $squad_id)
  {
    $condition = self::getBaseWhereData();

    $where = ['id' => $squad_id];

    $condition = array_merge($condition, $where);

    $response = $this->_model::getRow($condition, $this->_relevance);

    return self::success($response);
  }
}
