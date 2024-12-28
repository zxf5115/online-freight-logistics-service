<?php
namespace App\Http\Controllers\Platform\Module\Education\Homework;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Enum\Module\Education\QuestionEnum;
use App\Http\Controllers\Platform\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-14
 *
 * 作业控制器类
 */
class HomeworkController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Education\Homework\Homework';

  protected $_where = [];

  protected $_params = [
    'title',
    'create_time'
  ];

  protected $_addition = [
    'course' => [
      'title'
    ],
    'squad' => [
      'title'
    ],
  ];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'list' => [
      'course',
      'squad'
    ],
    'select' => false,
    'view' => [
      'resource',
      'course',
      'squad',
      'answer',
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
      'title.required' => '请您输入练习题标题'
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

      $model->organization_id = self::getOrganizationId();
      $model->type        = $request->type;
      $model->title       = $request->title;
      $model->content     = $request->content;
      $model->answer      = $request->answer;
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
