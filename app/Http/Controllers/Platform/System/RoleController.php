<?php
namespace App\Http\Controllers\Platform\System;

use App\Http\Constant\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-15
 *
 * 平台角色控制器类
 */
class RoleController extends BaseController
{
	protected $_model = 'App\Models\Platform\System\Role';

  protected $_where = [];

  protected $_params = [
    'title'
  ];

  protected $_order = [
    ['key' => 'id', 'value' => 'asc'],
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
      'title.required'  => '请您输入角色名称',
    ];

    $validator = Validator::make($request->all(), [
      'title' => 'required',
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

      $organization_id = self::getOrganizationId();

			$model->organization_id = $organization_id;
			$model->title       = $request->title;
			$model->content     = $request->content;

      $data = $this->_model::getMenuId($request->menu_id, $organization_id);

      DB::beginTransaction();

      try
      {
        $response = $model->save();

        $model->permission()->delete();

        if(!empty($data))
        {
        	$model->permission()->createMany($data);
        }

        DB::commit();

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        DB::rollback();

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-03-08
   * ------------------------------------------
   * 获取当前角色已选择的菜单权限
   * ------------------------------------------
   *
   * 获取当前角色已选择的菜单权限
   *
   * @param Request $request 请求信息
   * @return 当前角色已选择的角色
   */
  public function permission(Request $request)
  {
    $role_id = $request->id;

    $role = $this->_model::find($role_id);

    $permission = $role->permission()->get(['menu_id'])->toArray();

    $result['title'] = $role->title;

    $result['permission'] = array_column($permission, 'menu_id');

    return self::success($result);
  }
}
