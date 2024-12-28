<?php
namespace App\Http\Controllers\Platform\Module\Education\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;
use App\Models\Platform\Module\Education\Course\Unit;
use App\Models\Common\Module\Education\Course\Relevance\Question;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 课程控制器类
 */
class CourseController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Education\Course\Course';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'title',
    'category_id',
    'is_recommend',
    'is_hidden',
    'create_time',
  ];

  // 附加关联查询条件
  protected $_addition = [];

  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  // 关联数组
  protected $_relevance = [
    'label'
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-29
   * ------------------------------------------
   * 获取课程标签信息
   * ------------------------------------------
   *
   * 获取课程标签信息
   *
   * @param Request $request 请求参数
   * @param string $id 课程编号
   * @return [type]
   */
  public function label(Request $request, $id)
  {
    try
    {
      $response = [];

      $where = ['id' => $id];

      $condition = self::getBaseWhereData();

      $condition = array_merge($condition, $where);

      $result = $this->_model::getRow($condition, 'labelRelevance', true);

      if(!empty($result['label_relevance']))
      {
        $response = array_column($result['label_relevance'], 'label_id');
      }

      return self::success($response);
    }
    catch(\Exception $e)
    {
      return self::error(Code::HANDLE_FAILURE);
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-21
   * ------------------------------------------
   * 获取课程类型信息
   * ------------------------------------------
   *
   * 获取课程类型信息
   *
   * @param Request $request 请求参数
   * @param string $id 课程编号
   * @return [type]
   */
  public function type(Request $request)
  {
    try
    {
      $response = [
        ['id' => 1, 'title' => '讲授'],
        ['id' => 2, 'title' => '操作'],
        ['id' => 3, 'title' => '练习'],
      ];

      return self::success($response);
    }
    catch(\Exception $e)
    {
      return self::error(Code::HANDLE_FAILURE);
    }
  }





  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-29
   * ------------------------------------------
   * 获取课程结构
   * ------------------------------------------
   *
   * 获取课程结构
   *
   * @param Request $request 请求参数
   * @param string $id 课程编号
   * @return [type]
   */
  public function structure(Request $request, $id)
  {
    try
    {
      $response = [];

      $condition = self::getBaseWhereData();

      $where = ['id' => $id];

      $where = array_merge($condition, $where);

      $result = $this->_model::getRow($where);

      $response['rootId'] = $id;
      $response['nodes'][] = ['id' => strval($result->id), 'name' => $result->title];

      $where = ['course_id' => $id];

      $where = array_merge($condition, $where);

      $result = Unit::getList($where);

      $i = 1;

      foreach($result as $k => $item)
      {
        $from_id = $item->parent_id == 0 ? $id : $item->parent_id;

        $response['nodes'][$i] = ['id' => strval($item->id), 'text' => $item->title];
        $response['links'][] = ['from' => strval($from_id), 'to' => strval($item->id)];

        $i++;
      }

      return self::success($response);
    }
    catch(\Exception $e)
    {
      return self::error(Code::HANDLE_FAILURE);
    }
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
      'title.required'   => '请您输入课程标题',
      'picture.required' => '请您上传课程封面',
      'money.required'   => '请您输入课程费用',
    ];

    $validator = Validator::make($request->all(), [
      'title'   => 'required',
      'picture' => 'required',
      'money'   => 'required',
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

        $organization_id = self::getOrganizationId();

        $category_id = $request->category_id;

        if(is_array($category_id))
        {
          $category_id = array_pop($category_id) ?: 0;
        }

        $model->organization_id = $organization_id;
        $model->type            = $request->type ?? 1;
        $model->title           = $request->title;
        $model->picture         = $request->picture;
        $model->description     = $request->description ?? '';
        $model->time_length     = $request->time_length ?? 0;
        $model->money           = $request->money ?? 0.00;
        $model->sort            = $request->sort ?? 0;
        $model->is_recommend    = intval($request->is_recommend);
        $model->is_hidden       = intval($request->is_hidden);
        $model->status          = intval($request->status);
        $model->video_total       = $request->video_total ?? 0;
        $model->interaction_total = $request->interaction_total ?? 0;
        $model->teacher_name      = $request->teacher_name ?? '';
        $model->teacher_position  = $request->teacher_position ?? '';
        $model->teacher_specialty = $request->teacher_specialty ?? '';
        $model->teacher_record    = $request->teacher_record ?? '';
        $model->teacher_remark    = $request->teacher_remark ?? '';
        $model->outline           = $request->outline ?? '';
        $model->save();

        $data = self::packRelevanceData($request, 'label_id');

        if(!empty($data))
        {
          $model->labelRelevance()->delete();

          $model->labelRelevance()->createMany($data);
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
}
