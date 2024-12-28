<?php
namespace App\Http\Controllers\Api\Module\Education\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Events\Api\KeywordEvent;
use App\Http\Controllers\Api\BaseController;
use App\Models\Common\Module\Education\Course\Relevance\Label;
use App\Models\Common\Module\Member\Relevance\MemberCourseRelevance;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-22
 *
 * 知识点知识点控制器类
 */
class PointController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Education\Course\Point';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'title',
    'course_id',
    'unit_id',
    'is_skill'
  ];

  // 附加关联查询条件
  protected $_addition = [];

  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  // 关联数组
  protected $_relevance = [
    'emphasis.attachment'
  ];


  /**
   * @api {get} /api/education/course/point/list?page={page} 获取知识点列表(分页)
   * @apiDescription 获取知识点列表(分页)
   * @apiGroup 知识点模块
   * @apiParam {string} title 课程标题(可以为空)
   * @apiParam {int} course_id 课程编号(可以为空)
   * @apiParam {int} unit_id 单元编号(可以为空)
   * @apiParam {int} page 当前页数
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    $condition = [
      ['status', '>', Status::DELETE]
    ];

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    if(!empty($request->title))
    {
      // 保存热搜关键字
      event(new KeywordEvent($request->title));
    }

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order, false, 12);

    return self::success($response);
  }


  /**
   * @api {get} /api/education/course/point/select 获取知识点列表(不分页)
   * @apiDescription 获取知识点列表(不分页)
   * @apiGroup 知识点模块
   * @apiParam {string} title 课程标题(可以为空)
   * @apiParam {int} course_id 课程编号(可以为空)
   * @apiParam {int} unit_id 单元编号(可以为空)
   * @apiSampleRequest /api/education/course/point/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    $condition = [
      ['status', '>', Status::DELETE]
    ];

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getList($condition, $this->_relevance, $this->_order, true);

    return self::success($response);
  }


  /**
   * @api {get} /api/education/course/point/view/{id} 获取知识点详情
   * @apiDescription 获取知识点详情
   * @apiGroup 知识点模块
   * @apiSampleRequest /api/education/course/point/view/{id}
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


    $member_id = self::getCurrentId();

    $role_id = self::getCurrentRoleId();

    if(!empty($member_id) && 3 == $role_id)
    {
      $point = MemberCourseRelevance::getRow([
        'member_id' => $member_id,
        'course_id' => $response->course_id
      ]);

      if(empty($point->id))
      {
        return self::message('您未购买当前技能');
      }
    }

    return self::success($response);
  }


  /**
   * @api {get} /api/education/course/point/detail/{unit_id} 获取知识点详情(通过课程单元编号)
   * @apiDescription 获取知识点详情(通过课程单元编号)
   * @apiGroup 知识点模块
   * @apiSampleRequest /api/education/course/point/detail/{unit_id}
   * @apiVersion 1.0.0
   */
  public function detail(Request $request, $unit_id)
  {
    $condition = [
      ['status', '>', Status::DELETE]
    ];

    $where = [
      'unit_id' => $unit_id
    ];

    $condition = array_merge($condition, $where);

    $response = $this->_model::getList($condition, $this->_relevance);

    return self::success($response);
  }



  /**
   * @api {get} /api/education/course/point/recommend 获取推荐知识点列表(不分页)
   * @apiDescription 获取推荐知识点列表(不分页)
   * @apiGroup 知识点模块
   * @apiSampleRequest /api/education/course/point/recommend
   * @apiVersion 1.0.0
   */
  public function recommend(Request $request)
  {
    $condition = [
      ['status', '>', Status::DELETE]
    ];

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $where = ['is_recommend' => 1];

    $condition = array_merge($condition, $this->_where, $filter, $where);

    $response = $this->_model::getList($condition, $this->_relevance, $this->_order, true, 8);

    return self::success($response);
  }


  /**
   * @api {post} /api/education/course/point/similarity 获取相似知识点列表(不分页)
   * @apiDescription 获取相似知识点列表(不分页)
   * @apiGroup 知识点模块
   * @apiParam {string} token JWTtoken
   * @apiParam {array} label_id 标签数组（不能为空）
   * @apiParam {json} example {"label_id": ["66", "67"]}
   * @apiSampleRequest /api/education/course/point/similarity
   * @apiVersion 1.0.0
   */
  public function similarity(Request $request)
  {
    // if(empty($request->label_id))
    // {
    //   return self::error(Code::LABEL_EMPTY);
    // }

    // $label_id = $request->label_id;

    $condition = [
      ['status', '>', Status::DELETE],
      'is_skill' => 1
    ];

    // $course_id = Label::where($condition)->whereIn('label_id', $label_id)->pluck('course_id');

    $response = $this->_model::where($condition)
                            // ->whereIn('course_id', $course_id)
                            ->orderBy('create_time', 'desc')
                            ->limit(8)
                            ->get();

    return self::success($response);
  }
}
