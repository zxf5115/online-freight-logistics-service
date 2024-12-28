<?php
namespace App\Http\Controllers\Platform\Module\Education\Course\Point;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-28
 *
 * 课程重点控制器类
 */
class EmphasisController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Education\Course\Point\Emphasis';

  protected $_where = [];

  protected $_params = [
    'title'
  ];

  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  protected $_relevance = [];

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-12
   * ------------------------------------------
   * 课程重点列表
   * ------------------------------------------
   *
   * 课程重点列表
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function list(Request $request)
  {
    $id = $request->id;

    $condition = self::getBaseWhereData();

    $where = ['point_id' => $id];

    $condition = array_merge($condition, $this->_where, $where);

    $response = $this->_model::getList($where);

    return  self::success($response);
  }
}
