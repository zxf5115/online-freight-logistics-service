<?php
namespace App\Http\Controllers\Platform\Module\Organization;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Parameter;
use App\Exports\OrganizationExport;
use App\Models\Platform\System\Config;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-26
 *
 * 平台机构控制器类
 */
class OrganizationController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Organization\Organization';

  protected $_where = [];

  protected $_params = [
    'title',
    'head',
    'certification_status',
    'audit_status',
  ];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'list' => false,
    'select' => false,
    'view' => [
      'squad',
      'course',
      'graduationSquad',
    ],
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
      'title.required' => '请您输入机构名称',
      'title.unique'   => '机构名称重复',
      'logo.required'  => '请您上传机构LOGO',
    ];

    $validator = Validator::make($request->all(), [
      'title' => 'required',
      'title' => 'unique:module_organization,title,' . $request->id,
      'logo'  => 'required',
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

      $model->logo           = $request->logo;
      $model->head_mobile    = $request->head_mobile;
      $model->contact        = $request->contact;
      $model->contact_mobile = $request->contact_mobile;
      $model->email          = $request->email;
      $model->weixin         = $request->weixin;
      $model->qq             = $request->qq;
      $model->address        = $request->address;
      $model->status         = intval($request->status);

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


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 机构审核
   * ------------------------------------------
   *
   * 机构审核
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function audit(Request $request)
  {
    $messages = [
      'id.required'           => '请您输入机构编号',
      'audit_status.required' => '请您选择审核状态',
    ];

    $validator = Validator::make($request->all(), [
      'id'           => 'required',
      'audit_status' => 'required',
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

      $model->audit_status = $request->audit_status;

      DB::beginTransaction();

      try
      {
        $response = $model->save();

        if(!empty($request->content))
        {
          $model->audit()->delete();

          $data = [
            'content' => $request->content
          ];

          $model->audit()->create($data);
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
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 机构认证
   * ------------------------------------------
   *
   * 机构认证
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function certification(Request $request)
  {
    $messages = [
      'id.required'           => '请您输入机构编号',
      'certification_status.required' => '请您选择审核状态',
    ];

    $validator = Validator::make($request->all(), [
      'id'                   => 'required',
      'certification_status' => 'required',
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
      DB::beginTransaction();

      try
      {
        $model = $this->_model::firstOrNew(['id' => $request->id]);

        $model->certification_status = $request->certification_status;
        $model->save();

        if(!empty($request->content))
        {
          $data = [
            'content' => $request->content
          ];

          $model->certification()->delete();
          $model->certification()->create($data);
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
   * @dateTime 2020-12-14
   * ------------------------------------------
   * 导出机构信息
   * ------------------------------------------
   *
   * 导出机构信息
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
    $filename = '/excel/'. '机构档案_'.time().'.xlsx';

    Excel::store(new OrganizationExport($response), $dir.$filename);

    $url = Config::getConfigValue('web_url');

    $url = $url . '/storage/' . $filename;

    return self::success($url);
  }
}
