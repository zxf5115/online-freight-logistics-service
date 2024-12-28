<?php
namespace App\Http\Controllers\Api\Module\Education\Course\Point;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Enum\Module\Education\QuestionEnum;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-09
 *
 * 练习题控制器类
 */
class QuestionController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Education\Course\Point\Question';

  protected $_where = [];

  protected $_params = [
    'title'
  ];

  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  protected $_relevance = [];


  /**
   * @api {get} /api/education/course/point/question/view/{id} 获取练习题详情
   * @apiDescription 获取练习题详情
   * @apiGroup 练习题模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/education/course/point/question/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    $condition = [
      ['status', '>', Status::DELETE]
    ];

    $where = [
      'id' => $id
    ];

    $condition = array_merge($condition, $where);

    $response = $this->_model::getRow($condition, $this->_relevance);

    return self::success($response);
  }
}
