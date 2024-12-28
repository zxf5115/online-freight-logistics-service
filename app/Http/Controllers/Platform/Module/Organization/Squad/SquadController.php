<?php
namespace App\Http\Controllers\Platform\Module\Organization\Squad;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Exports\SquadExport;
use App\Enum\Common\TimeEnum;
use App\Models\Platform\System\Config;
use App\Models\Platform\Module\Member\Member;
use App\Http\Controllers\Platform\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-07
 *
 * 班级控制器类
 */
class SquadController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Organization\Squad\Squad';

  protected $_where = [];

  protected $_params = [
    'title',
    'teacher_name',
    'organization_id'
  ];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'list' => false,
    'select' => false,
    'view' => [
      'organization',
      'course',
      'audit',
    ]
  ];



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

    $relevance = self::getRelevanceData($this->_relevance, 'view');

    $response = $this->_model::getRow($condition, $relevance);

    $response['roster'] = $this->_model::getRosterData($response->id);

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
      'title.required' => '请您输入班级名称'
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
      $model = $this->_model::firstOrNew(['id' => $request->id]);

      if(!empty($request->teacher_id))
      {
        $condition = self::getSimpleWhereData($request->teacher_id);

        $member = Member::getRow($condition);

        $model->teacher_id     = $request->teacher_id;
        $model->teacher_name   = $member->nickname ?? '';
        $model->teacher_mobile = $member->username ?? '';
      }

      $model->title          = $request->title;
      $model->description    = $request->description;
      $model->start_time     = strtotime($request->valid_time[0]);
      $model->end_time       = strtotime($request->valid_time[1]);
      $model->number         = $request->number;
      $model->sort           = $request->sort;

      $response = $model->save();

      if($response)
      {
        return self::success(Code::message(Code::HANDLE_SUCCESS));
      }
      else
      {
        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 班级审核
   * ------------------------------------------
   *
   * 班级审核
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function audit(Request $request)
  {
    $messages = [
      'id.required'           => '请您输入班级编号',
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
      $model = $this->_model::getRow(['id' => $request->id]);

      $model->audit_status = $request->audit_status;

      DB::beginTransaction();

      try
      {
        $response = $model->save();

        if(!empty($request->content))
        {
          $model->audit()->delete();

          $data = [
            'organization_id' => $model->organization_id,
            'content'         => $request->content
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
   * 班级状态
   * ------------------------------------------
   *
   * 班级状态
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function status(Request $request)
  {
    $messages = [
      'id.required'     => '请您输入班级编号',
      'status.required' => '请您选择班级状态',
    ];

    $validator = Validator::make($request->all(), [
      'id'     => 'required',
      'status' => 'required',
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
        $model = $this->_model::getRow(['id' => $request->id]);
        $model->open_status = $request->status == 2 ? 1 : 2;
        $model->save();

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

    $response['roster'] = $this->_model::getRosterData($request->id);

    $dir = 'public';
    $filename = '/excel/'. '班级档案_'.time().'.xlsx';

    Excel::store(new SquadExport($response), $dir.$filename);

    $url = Config::getConfigValue('web_url');

    $url = $url . '/storage/' . $filename;

    return self::success($url);
  }
}
