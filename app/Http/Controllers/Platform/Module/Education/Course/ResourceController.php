<?php
namespace App\Http\Controllers\Platform\Module\Education\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-11
 *
 * 课程资源控制器类
 */
class ResourceController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Education\Course\Resource';

  protected $_where = [];

  protected $_params = [
    'title',
    'course_id',
    'category_id',
  ];

  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'category'
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
      'title.required' => '请您输入资料标题',
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

      $category_id = $request->category_id;

      if(is_array($category_id))
      {
        $category_id = array_pop($category_id) ?: 0;
      }

      $model->organization_id = self::getOrganizationId();
      $model->course_id       = $request->course_id;
      $model->category_id     = $category_id;
      $model->title           = $request->title;
      $model->content         = $request->content;
      $model->url             = $request->url;
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
}
