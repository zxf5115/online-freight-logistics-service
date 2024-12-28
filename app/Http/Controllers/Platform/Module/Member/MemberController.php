<?php
namespace App\Http\Controllers\Platform\Module\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\TraitClass\SmsTrait;
use App\TraitClass\ToolTrait;
use App\Exports\MemberExport;
use App\Http\Constant\Parameter;
use App\Models\Platform\System\Config;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-14
 *
 * 用户控制器类
 */
class MemberController extends BaseController
{
  use SmsTrait;

  protected $_model = 'App\Models\Platform\Module\Member\Member';

  protected $_where = [];

  protected $_params = [
    'username',
    'nickname'
  ];

  protected $_addition = [
    'relevance' => [
      'role_id',
    ]
  ];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'list' => [
      'role',
      'relevance',
    ],
    'select' => false,
    'view' => [
      'organization',
      'role',
      'relevance',
      'archive',
      'squad',
      'course',
      'comment.appraiser',
    ],
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
  public function select(Request $request)
  {
    $condition = self::getBaseWhereData();

    $role_id = $request->role_id ?? 1;

    $condition = array_merge($condition, $this->_where);

    $response = $this->_model::where($condition)->with('relevance')->whereHasIn('relevance', function($query) use ($role_id) {
                  $query->where(['role_id' => $role_id]);
                 })->get();

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
      'username.required' => '请您输入登录账户',
      'username.regex'    => '登录账户不合法',
      'username.unique'   => '登录账户重复',
      'nickname.required' => '请您输入用户昵称',
    ];

    $validator = Validator::make($request->all(), [
      'username' => 'required',
      'username' => 'unique:module_member,username,' . $request->id,
      'nickname' => 'required',
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

      if(empty($request->id))
      {
        $model->password    = $this->_model::generate(Parameter::PASSWORD);
      }

      if(!preg_match('/^1[345789][0-9]{9}$/', $request->username))
      {
        return self::error(Code::MEMBER_FORMAT_ERROR);
      }

      if(empty($request->id))
      {
        $model->member_no = ToolTrait::generateOnlyNumber(3);
      }

      $model->username        = $request->username;
      $model->nickname        = $request->nickname;
      $model->avatar          = $request->avatar ?: '';
      $model->email           = $request->email ?: '';
      $model->mobile          = $request->mobile ?: '';
      $model->status          = intval($request->status);

      $data = $this->_model::getRoleId($request->role_id, $organization_id);

      if(empty($request->role_id))
      {
        return self::error(Code::MEMBER_ROLE_EMPTY);
      }

      DB::beginTransaction();

      try
      {
        $response = $model->save();

        if(!empty($data))
        {
          $model->relevance()->delete();

          $model->relevance()->createMany($data);
        }

        DB::commit();

        if(empty($request->id) && $request->sms_notification)
        {
          // SmsTrait::sendRegistereSms($model->username);
        }

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
   * @dateTime 2020-02-25
   * ------------------------------------------
   * 初始化密码
   * ------------------------------------------
   *
   * 初始化密码
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function password(Request $request)
  {
    try
    {
      $model = $this->_model::find($request->id);

      $password = $this->_model::generate(Parameter::PASSWORD);

      $model->password = $password;
      $model->is_new   = 2;

      $response = $model->save();

      if($response)
      {
        return self::success(Code::$message[Code::HANDLE_SUCCESS]);
      }
      else
      {
        return self::error(Code::$message[Code::HANDLE_FAILURE]);
      }
    }
    catch(\Exception $e)
    {
      return self::error(Code::$message[Code::HANDLE_FAILURE]);
    }
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-11
   * ------------------------------------------
   * 获取当前用户角色对应的菜单树
   * ------------------------------------------
   *
   * 获取当前用户角色对应的菜单树
   *
   * @param Request $request [请求参数]
   * @return [菜单树]
   */
  public function tree(Request $request)
  {
    $result = [];

    $user_id = self::getCurrentId();

    $role = User::find($user_id)->role[0] ?: [];

    $permission = $role->permission->toArray();

    $menu_ids = array_column($permission, 'menu_id');

    // 获取用户可访问菜单
    $result = Menu::getCurrentUserMenuData($menu_ids);

    $result = ['menu' => $menu, 'button' => $button];

    return self::success($result);

  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-14
   * ------------------------------------------
   * 导出学员信息
   * ------------------------------------------
   *
   * 导出学员信息
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function export(Request $request)
  {
    $condition = self::getBaseWhereData();

    $where = ['id' => $request->id];

    $condition = array_merge($condition, $where);

    $relevance = self::getRelevanceData($this->_relevance, 'view');

    $response = $this->_model::getRow($condition, $relevance);

    $dir = 'public';
    $filename = '/excel/'. '学员档案_'.time().'.xlsx';

    Excel::store(new MemberExport($response), $dir.$filename);

    $url = Config::getConfigValue('web_url');

    $url = $url . '/storage/' . $filename;

    return self::success($url);
  }





  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-25
   * ------------------------------------------
   * 改变状态
   * ------------------------------------------
   *
   * 改变状态
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function status(Request $request)
  {
    try
    {
      $model = $this->_model::find($request->id);

      $password = $this->_model::generate(Parameter::PASSWORD);

      $model->status   = 2;

      $response = $model->save();

      if($response)
      {
        return self::success(Code::$message[Code::HANDLE_SUCCESS]);
      }
      else
      {
        return self::error(Code::$message[Code::HANDLE_FAILURE]);
      }
    }
    catch(\Exception $e)
    {
      return self::error(Code::$message[Code::HANDLE_FAILURE]);
    }
  }
}
