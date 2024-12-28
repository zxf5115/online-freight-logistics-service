<?php
namespace App\Http\Controllers\Platform\System\Menu;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-08
 *
 * 系统配置分类控制器类
 */
class CategoryController extends BaseController
{
  protected $_model = 'App\Models\Platform\System\Menu\Category';

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
      'title.required' => '请您输入分类标题'
    ];

    $validator = Validator::make($request->all(), [
      'title' => 'required'
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
      try
      {
        $model = $this->_model::firstOrNew(['id' => $request->id]);

        $model->organization_id = self::getOrganizationId();
        $model->title           = $request->title;
        $model->icon            = $request->icon;
        $model->sort            = $request->sort ?? 0;

        $model->save();

        return self::success(Code::message(Code::HANDLE_SUCCESS));
      }
      catch(\Exception $e)
      {
        self::record($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-22
   * ------------------------------------------
   * 获取分类分级数据
   * ------------------------------------------
   *
   * 获取分类分级数据
   *
   * @return [type]
   */
  public function level()
  {
    $condition = self::getBaseWhereData();

    $where = ['parent_id' => 0];

    $condition = array_merge($condition, $where);

    $tree = $this->_model::getList($condition, 'children', $this->_order, true);

    return self::success($tree);
  }
}
