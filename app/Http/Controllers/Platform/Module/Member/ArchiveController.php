<?php
namespace App\Http\Controllers\Platform\Module\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-24
 *
 * 会员档案控制器类
 */
class ArchiveController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Member\Archive';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'realname',
    'id_card_no',
  ];

  // 附加关联查询条件
  protected $_addition = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  // 关联数组
  protected $_relevance = [
    'member'
  ];


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
      'member_id.required'  => '请您选择学员昵称',
      'realname.required'   => '请您输入真实姓名',
      'id_card_no.required' => '请您输入身份证号码',
      'id_card_no.unique'   => '身份证号码已存在',
    ];

    $validator = Validator::make($request->all(), [
      'member_id'  => 'required',
      'realname'   => 'required',
      'id_card_no' => 'required',
      'id_card_no' => 'unique:module_member_archive,id_card_no,' . $request->id,
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
      $model->member_id       = $request->member_id;
      $model->realname        = $request->realname;
      $model->age             = $request->age;
      $model->sex             = $request->sex;
      $model->weixin          = $request->weixin;
      $model->id_card_no      = $request->id_card_no;
      $model->national        = $request->national ?: '';
      $model->education       = $request->education ?: '';
      $model->province_id     = $request->province_id;
      $model->city_id         = $request->city_id;
      $model->region_id       = $request->region_id;
      $model->address         = $request->address ?: '';
      $model->work_address    = $request->work_address ?: '';
      $model->remark          = $request->remark ?: '';

      try
      {
        $response = $model->save();

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }
}
