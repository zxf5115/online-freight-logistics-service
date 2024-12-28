<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Constant\Code;
use App\Http\Controllers\BaseController as Common;
use App\Models\Common\Module\Member\Relevance\MemberRoleRelevance;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-28
 *
 * 基础接口控制器类
 */
class BaseController extends Common
{
  /**
   * 当前用户
   */
  protected $user = null;

  /**
   * 搜索条件
   */
  protected $_params = [
    'title',
    'username',
    'realname',
  ];

  /**
   * 可查询字段与查理类型
   */
  protected $_filter = [
    // 模糊查询
    'like' => [
      'title',
      'nickname',
      'content',
      'username',
      'realname',
    ],
    // 时间查询
    'time' => [
      'create_time',
      'valid_time',
      'add_time',
    ],
    // 小于查询
    'less' => [],
    // 大于查询
    'greater' => []
  ];


  // 判断是否拥有权限
  public function __construct()
  {
  	// 这里额外注意了：官方文档样例中只除外了『login』
    // 这样的结果是，token 只能在有效期以内进行刷新，过期无法刷新
    // 如果把 refresh 也放进去，token 即使过期但仍在刷新期以内也可刷新
    // 不过刷新一次作废
    // 另外关于上面的中间件，官方文档写的是『auth:api』
    // 但是我推荐用 『jwt.auth』，效果是一样的，但是有更加丰富的报错信息返回
    // $this->middleware();

    $this->user = auth('api')->user();
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-12
   * ------------------------------------------
   * 获取列表信息
   * ------------------------------------------
   *
   * 获取列表信息
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function list(Request $request)
  {
    try
    {
      $condition = self::getBaseWhereData();

      $page = $request->limit ?? 10;

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      $relevance = self::getRelevanceData($this->_relevance, 'list');

      $response = $this->_model::getPaging($condition, $relevance, $this->_order, false, $page);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-12
   * ------------------------------------------
   * 获取列表信息
   * ------------------------------------------
   *
   * 获取列表信息
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function select(Request $request)
  {
    try
    {
      $condition = self::getBaseWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      $relevance = self::getRelevanceData($this->_relevance, 'select');

      $response = $this->_model::getList($condition, $relevance, $this->_order);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-07-19
   * ------------------------------------------
   * 获取数据详情
   * ------------------------------------------
   *
   * 获取数据详情
   *
   * @param Request $request 请求参数
   * @param [type] $id 数据编号
   * @return [type]
   */
  public function view(Request $request, $id)
  {
    try
    {
      $condition = self::getBaseWhereData();

      $where = ['id' => $id];

      $condition = array_merge($condition, $where);

      $relevance = self::getRelevanceData($this->_relevance, 'view');

      $response = $this->_model::getRow($condition, $relevance);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-12
   * ------------------------------------------
   * 删除信息
   * ------------------------------------------
   *
   * 删除信息
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function delete(Request $request)
  {
    try
    {
      $id = json_decode($request->id) ?? [0];

      $response = $this->_model::remove($id);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-03-07
   * ------------------------------------------
   * 获取当前登录用户的机构编号
   * ------------------------------------------
   *
   * 获取当前登录用户的机构编号
   *
   * @return 机构编号
   */
  public static function getOrganizationId()
  {
    try
    {
      return auth('api')->user()->organization_id ?? 0;
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return 0;
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-03-07
   * ------------------------------------------
   * 获取当前用户编号
   * ------------------------------------------
   *
   * 获取当前用户的用户编号
   *
   * @return 用户编号
   */
  public static function getCurrentId()
  {
    try
    {
      return auth('api')->user()->id ?? 0;
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return 0;
    }
  }


    /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-03-07
   * ------------------------------------------
   * 获取当前用户角色编号
   * ------------------------------------------
   *
   * 获取当前用户角色编号
   *
   * @return 用户编号
   */
  public static function getCurrentRoleId()
  {
    try
    {
      $response = 0;

      $member_id = auth('api')->user()->id;

      $role = MemberRoleRelevance::getRow(['user_id' => $member_id]);

      if(!empty($role))
      {
        $response = $role->role_id;
      }

      return $response;
    }
    catch(\Exception $e)
    {

      return 0;
    }
  }


    /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-29
   * ------------------------------------------
   * 组装关联数据
   * ------------------------------------------
   *
   * 组装结业数据
   *
   * @param array $request 关联数据数组
   * @param int $status 结业类型 1 通过 2 不通过
   * @return [type]
   */
  public static function packGraduationData($request, $status = 1)
  {
    $response = [];

    if(empty($request))
    {
      return $response;
    }

    foreach($request as $key => $item)
    {
      $response[$key]['member_id']         = $item;
      $response[$key]['graduation_status'] = $status;
      $response[$key]['organization_id']   = self::getOrganizationId();
    }

    return $response;
  }
}
