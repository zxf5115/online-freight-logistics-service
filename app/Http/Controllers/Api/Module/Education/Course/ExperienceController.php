<?php
namespace App\Http\Controllers\Api\Module\Education\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 课程体验控制器类
 */
class ExperienceController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Education\Course\Experience';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'course_id'
  ];

  // 附加关联查询条件
  protected $_addition = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  // 关联数组
  protected $_relevance = [];


  /**
   * @api {get} /api/education/course/experience/view/{id} 01. 课程体验信息
   * @apiDescription 根据课程编号获取课程体验信息
   * @apiGroup 22. 课程体验模块
   *
   * @apiParam {int} id 课程编号
   *
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {String} content 体验内容
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/education/course/experience/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    try
    {
      $condition = self::getSimpleWhereData($id, 'course_id');

      $response = $this->_model::getRow($condition);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      self::record($e);

      return self::error(Code::HANDLE_FAILURE);
    }
  }
}
