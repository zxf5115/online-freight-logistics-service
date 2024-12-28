<?php
namespace App\Http\Controllers\Platform\Module\Education\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\TraitClass\ToolTrait;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-22
 *
 * 课程知识点控制器类
 */
class PointController extends BaseController
{
  use ToolTrait;

  protected $_model = 'App\Models\Platform\Module\Education\Course\Point';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'title',
    'course_id',
    'unit_id',
    'create_time',
  ];

  // 附加关联查询条件
  protected $_addition = [];

  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  // 关联数组
  protected $_relevance = [
    'list' => [
      'course'
    ],
    'select' => [],
    'view' => [
      'course',
      'unit'
    ],
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-22
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
      'title.required'       => '请您输入课程标题',
      'picture.required'     => '请您上传课程封面',
    ];

    $validator = Validator::make($request->all(), [
      'title'       => 'required',
      'picture'     => 'required',
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

        $organization_id = self::getOrganizationId();

        $unit_id = $request->unit_id;

        if(is_array($unit_id))
        {
          $unit_id = array_pop($unit_id) ?: 0;
        }

        $model->organization_id = $organization_id;
        $model->type            = $request->type ?? 1;
        $model->course_id       = $request->course_id;
        $model->unit_id         = $unit_id;
        $model->title           = $request->title;
        $model->picture         = $request->picture;
        $model->description     = $request->description ?? '';
        $model->content         = $request->content ?? '';
        $model->complete_name   = ToolTrait::getCompleteName($unit_id);
        $model->money           = $request->money ?? 0;
        $model->time_length     = $request->time_length ?? 0;
        $model->sort            = $request->sort ?? 0;
        $model->is_recommend    = intval($request->is_recommend);
        $model->is_skill        = intval($request->is_skill);
        $model->status          = intval($request->status);

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
