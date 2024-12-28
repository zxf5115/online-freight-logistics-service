<?php
namespace App\Http\Controllers\Platform\Module\Education\Course\Resource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-28
 *
 * 课程资料分类控制器类
 */
class CategoryController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Education\Course\Resource\Category';

  protected $_where = [
    'parent_id' => 0
  ];

  protected $_params = [
    'course_id',
    'parent_id',
    'title'
  ];

  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'course',
    'children'
  ];


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
    $condition = self::getBaseWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $where = [];

    if(!empty($request->course_id))
    {
      $this->course_id = $request->course_id;

      $where = [
        'course_id' => $this->course_id
      ];
    }

    $condition = array_merge($condition, $this->_where, $filter, $where);

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order);

    return self::success($response);
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
    $condition = self::getBaseWhereData();

    $where = ['id' => $id];

    $condition = array_merge($condition, $where);

    $response = $this->_model::getRow($condition, $this->_relevance);

    return self::success($response);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-12
   * ------------------------------------------
   * 操作信息
   * ------------------------------------------
   *
   * 操作信息
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function handle(Request $request)
  {
    $messages = [
      'title.required'     => '请您输入分类标题',
    ];

    $validator = Validator::make($request->all(), [
      'title'     => 'required',
    ], $messages);


    if($validator->fails())
    {
      $error = $validator->getMessageBag()->toArray();
      $error = array_values($error);
      $message = $error[0][0] ?? Code::$message[Code::ERROR];

      return self::message($message);
    }
    else
    {
      $model = $this->_model::firstOrNew(['id' => $request->id]);

      $parent_id = $request->parent_id;

      if(is_array($parent_id))
      {
        $parent_id = array_pop($parent_id) ?: 0;
      }

      $model->organization_id = self::getOrganizationId();
      $model->title       = $request->title;
      $model->parent_id   = $parent_id;
      $model->course_id   = $request->course_id;
      $model->picture     = $request->picture ?? '';
      $model->description = $request->description;
      $model->depth       = $request->depth;
      $model->sort        = $request->sort;

      $response = $model->save();

      if($response)
      {
        return self::success(Code::message(Code::HANDLE_SUCCESS));
      }
      else
      {
        return self::error(Code::message(Code::HANDLE_FAILURE));
      }
    }
  }
}
