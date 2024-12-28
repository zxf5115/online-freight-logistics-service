<?php
namespace App\Http\Controllers\Platform\Module\Education\Graduation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Enum\Module\Education\QuestionEnum;
use App\Http\Controllers\Platform\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-13
 *
 * 结业控制器类
 */
class GraduationController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Education\Graduation\Relevance\Squad';

  protected $_where = [];

  protected $_params = [
    'create_time'
  ];

  protected $_addition = [
    'organization' => [
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
      'organization',
      'squad',
    ],
    'select' => false,
    'view' => [
      'organization',
      'squad',
      'graduation.archive',
      'ungraduation.archive',
    ]
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-18
   * ------------------------------------------
   * 获取待结业审核列表
   * ------------------------------------------
   *
   * 获取待结业审核列表
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function audit(Request $request)
  {
    $condition = self::getBaseWhereData();

    $condition = array_merge($condition, $this->_where);

    if(empty($request->id))
    {
      return self::error(Code::GRADUATION_ID_EMPTY);
    }

    $id = explode('_', $request->id);

    $response = $this->_model::where($condition)
                     ->whereIn('id', $id)
                     ->with('organization')
                     ->with('squad')
                     ->get();

    return self::success($response);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-18
   * ------------------------------------------
   * 审核结业
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
      'id.required' => '请您输入结业编号'
    ];

    $validator = Validator::make($request->all(), [
      'id' => 'required'
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
        $data = explode('_', $request->id);

        $model = $this->_model::find($data);

        foreach($model as $item)
        {
          if($item->graduation_status['value'] == 1)
          {
            continue;
          }

          $item->graduation_status  = $request->graduation_status;
          $item->graduation_content = $request->graduation_content;

          $item->save();
        }

        return self::success(Code::message(Code::HANDLE_SUCCESS));

      }
      catch(\Exception $e)
      {
        return self::error(Code::message(Code::HANDLE_FAILURE));
      }
    }
  }
}
