<?php
namespace App\Http\Controllers\Platform\Module\Education\Paper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;
use App\Models\Common\Module\Member\Paper\Paper as MemberPaper;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-29
 *
 * 试卷控制器类
 */
class PaperController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Education\Paper\Paper';

  protected $_where = [];

  protected $_params = [
    'title',
    'course_id'
  ];

  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'list' => ['course'],
    'select' => false,
    'statistical' => false,
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
      'title.required'     => '请您输入试卷标题',
      'test_time.required' => '请您输入考试时间',
    ];

    $validator = Validator::make($request->all(), [
      'title'     => 'required',
      'test_time' => 'required',
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

      $model->organization_id = self::getOrganizationId();
      $model->course_id       = $request->course_id ?? 0;
      $model->title           = $request->title;
      $model->description     = $request->description;
      $model->test_time       = $request->test_time;
      $model->sort            = $request->sort;

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
  public function statistical(Request $request, $id)
  {
    try
    {
      $condition = self::getBaseWhereData();

      $where = ['paper_id' => $id];

      $condition = array_merge($condition, $where);

      $response['user_total'] = 0;
      $response['organization_total'] = 0;

      $result = MemberPaper::getPluck('member_id', $condition, false, false, true);

      if(!empty($result))
      {
        $response['user_total'] = count(array_unique($result));
      }

      $result = MemberPaper::getPluck('organization_id', $condition, false, false, true);

      if(!empty($result))
      {
        $response['organization_total'] = count(array_unique($result));
      }

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }
}
