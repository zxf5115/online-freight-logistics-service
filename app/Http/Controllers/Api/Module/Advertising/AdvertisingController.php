<?php
namespace App\Http\Controllers\Api\Module\Advertising;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Http\Controllers\Api\BaseController;
use App\Models\Api\Module\Advertising\Position;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 广告控制器类
 */
class AdvertisingController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Advertising\Advertising';

  protected $_where = [];

  protected $_params = [
    'location_id',
  ];

  protected $_addition = [
    'position' => [
      'course_id'
    ]
  ];

  /**
   * 排序条件
   */
  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'position'
  ];


  /**
   * @api {get} /api/advertising/list?page={page} 1. 获取广告列表(分页)
   * @apiDescription 获取广告列表(分页)
   * @apiGroup 10. 广告模块
   *
   * @apiParam {int} page 当前页数
   * @apiParam {int} location_id 广告类型 1 首页轮播图 4 课程学习页广告 5 技能超市页广告
   *
   * @apiParam {int} course_id 课程编号
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    try
    {
      $condition = [
        ['status', '>', Status::DELETE]
      ];

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::success(false);
    }
  }


  /**
   * @api {get} /api/advertising/select 2. 获取广告列表(不分页)
   * @apiDescription 获取广告列表(不分页)
   * @apiGroup 10. 广告模块
   *
   * @apiParam {int} location_id 广告类型 1 首页轮播图 4 课程学习页广告 5 技能超市页广告
   * @apiParam {int} course_id 课程编号
   *
   * @apiSuccess (广告字段说明) {String} id 广告编号
   * @apiSuccess (广告字段说明) {String} title 广告名称
   * @apiSuccess (广告字段说明) {String} link 广告跳转链接
   * @apiSuccess (广告字段说明) {String} picture 广告图片
   * @apiSuccess (广告字段说明) {String} url 广告资源（音频、视频）
   *
   * @apiSuccess (广告位字段说明) {String} id 广告位编号
   * @apiSuccess (广告位字段说明) {String} course_id 课程编号
   * @apiSuccess (广告位字段说明) {String} title 广告位名称
   *
   * @apiSampleRequest /api/advertising/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    try
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
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::success(false);
    }
  }


  /**
   * @api {get} /api/advertising/view/{id} 3. 获取广告详情
   * @apiDescription 获取广告详情
   * @apiGroup 10. 广告模块
   *
   * @apiSuccess (广告字段说明) {String} id 广告编号
   * @apiSuccess (广告字段说明) {String} title 广告名称
   * @apiSuccess (广告字段说明) {String} link 广告跳转链接
   * @apiSuccess (广告字段说明) {String} picture 广告图片
   * @apiSuccess (广告字段说明) {String} url 广告资源（音频、视频）
   *
   * @apiSuccess (广告位字段说明) {String} id 广告位编号
   * @apiSuccess (广告位字段说明) {String} course_id 课程编号
   * @apiSuccess (广告位字段说明) {String} title 广告位名称
   *
   * @apiSampleRequest /api/advertising/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    try
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
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::success(false);
    }
  }



  /**
   * @api {get} /api/advertising/video 4. 获取视频广告
   * @apiDescription 获取视频广告
   * @apiGroup 10. 广告模块
   *
   * @apiSuccess (广告字段说明) {String} id 广告编号
   * @apiSuccess (广告字段说明) {String} title 广告名称
   * @apiSuccess (广告字段说明) {String} link 广告跳转链接
   * @apiSuccess (广告字段说明) {String} picture 广告图片
   * @apiSuccess (广告字段说明) {String} url 广告资源（音频、视频）
   *
   * @apiSuccess (广告位字段说明) {String} id 广告位编号
   * @apiSuccess (广告位字段说明) {String} course_id 课程编号
   * @apiSuccess (广告位字段说明) {String} title 广告位名称
   *
   * @apiSampleRequest /api/advertising/video
   * @apiVersion 1.0.0
   */
  public function video(Request $request)
  {
    try
    {
      $condition = [
        'location_id' => 2,
        ['status', '>', Status::DELETE]
      ];

      $order = [
        ['key' => 'sort', 'value' => 'desc']
      ];

      $response = $this->_model::getRow($condition, $this->_relevance, false, $order);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::success(false);
    }
  }


  /**
   * @api {get} /api/advertising/login 5. 获取登录页广告
   * @apiDescription 获取登录页广告
   * @apiGroup 10. 广告模块
   *
   * @apiSuccess (广告字段说明) {String} id 广告编号
   * @apiSuccess (广告字段说明) {String} title 广告名称
   * @apiSuccess (广告字段说明) {String} link 广告跳转链接
   * @apiSuccess (广告字段说明) {String} picture 广告图片
   * @apiSuccess (广告字段说明) {String} url 广告资源（音频、视频）
   *
   * @apiSuccess (广告位字段说明) {String} id 广告位编号
   * @apiSuccess (广告位字段说明) {String} course_id 课程编号
   * @apiSuccess (广告位字段说明) {String} title 广告位名称
   *
   * @apiSampleRequest /api/advertising/login
   * @apiVersion 1.0.0
   */
  public function login(Request $request)
  {
    try
    {
      $condition = [
        'location_id' => 3,
        ['status', '>', Status::DELETE]
      ];

      $order = [
        ['key' => 'sort', 'value' => 'desc']
      ];

      $response = $this->_model::getRow($condition, $this->_relevance, false, $order);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::success(false);
    }
  }

  /**
   * @api {get} /api/advertising/course 6. 获取课程广告列表
   * @apiDescription 获取课程广告列表(不分页)
   * @apiGroup 10. 广告模块
   *
   * @apiParam {int} course_id 课程编号
   *
   * @apiSuccess (广告字段说明) {String} id 广告编号
   * @apiSuccess (广告字段说明) {String} title 广告名称
   * @apiSuccess (广告字段说明) {String} link 广告跳转链接
   * @apiSuccess (广告字段说明) {String} picture 广告图片
   * @apiSuccess (广告字段说明) {String} url 广告资源（音频、视频）
   *
   * @apiSuccess (广告位字段说明) {String} id 广告位编号
   * @apiSuccess (广告位字段说明) {String} course_id 课程编号
   * @apiSuccess (广告位字段说明) {String} title 广告位名称
   *
   * @apiSampleRequest /api/advertising/course
   * @apiVersion 1.0.0
   */
  public function course(Request $request)
  {
    try
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
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::success(false);
    }
  }
}
