<?php
namespace App\Http\Controllers\Api\Module\Organization\Squad\Study;

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
 * 机构班级学习中心控制器类
 */
class StatisticalController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Organization\Squad\Study\Statistical';

  protected $_where = [];

  protected $_params = [
    'squad_id',
  ];

  protected $_addition = [
    'member' => [
      'status'
    ]
  ];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'list' => [
      'squad',
      'member',
    ]
  ];


  /**
   * @api {get} /api/organization/squad/study/statistical/list/{squad_id} 获取机构学习统计数据
   * @apiDescription 获取机构学习统计数据
   * @apiGroup 机构学习中心模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} squad_id 班级编号
   * @apiSampleRequest /api/organization/squad/study/list/{squad_id}
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    $request['member_status'] = 1;

    $condition = self::getBaseWhereData();

    $where = ['squad_id' => $request->squad_id];

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter, $where);

    $relevance = self::getRelevanceData($this->_relevance, 'list');

    $response = $this->_model::getPaging($condition, $relevance);

    return self::success($response);
  }
}
