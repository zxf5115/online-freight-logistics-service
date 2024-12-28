<?php
namespace App\Http\Controllers\Platform\Module\Education\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-11
 *
 * 考前强化控制器类
 */
class IntensifyController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Education\Course\Intensify';

  protected $_where = [];

  protected $_params = [
    'course_id',
    'category_id',
    'title',
  ];

  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'course',
    'category',
    'paperRelevance',
    'questionRelevance'
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-29
   * ------------------------------------------
   * 获取考前强化试卷信息
   * ------------------------------------------
   *
   * 获取考前强化试卷信息
   *
   * @param Request $request 请求参数
   * @param string $id 课程编号
   * @return [type]
   */
  public function paper(Request $request, $id)
  {
    try
    {
      $response = [];

      $where = ['id' => $id];

      $condition = self::getBaseWhereData();

      $condition = array_merge($condition, $where);

      $result = $this->_model::getRow($condition, 'paperRelevance', true);

      if(!empty($result['paper_relevance']))
      {
        $response = array_column($result['paper_relevance'], 'paper_id');
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
   * @dateTime 2020-09-29
   * ------------------------------------------
   * 获取考前强化试题信息
   * ------------------------------------------
   *
   * 获取考前强化试题信息
   *
   * @param Request $request 请求参数
   * @param string $id 课程编号
   * @return [type]
   */
  public function question(Request $request, $id)
  {
    try
    {
      $response = [];

      $where = ['id' => $id];

      $condition = self::getBaseWhereData();

      $condition = array_merge($condition, $where);

      $result = $this->_model::getRow($condition, 'questionRelevance', true);

      if(!empty($result['question_relevance']))
      {
        $response = array_column($result['question_relevance'], 'question_id');
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
      $model->type            = $request->type;
      $model->title           = $request->title;
      $model->content         = $request->content ?? '';
      $model->sort            = $request->sort;

      if($request->type == 2)
      {
        $data = self::packRelevanceData($request, 'question_id');
      }
      else if($request->type == 3)
      {
        $data = self::packRelevanceData($request, 'paper_id');
      }

      DB::beginTransaction();

      try
      {
        $response = $model->save();

        if(!empty($data))
        {
          if($request->type == 2)
          {
            $model->questionRelevance()->delete();
            $model->questionRelevance()->createMany($data);
          }
          else if($request->type == 3)
          {
            $model->paperRelevance()->delete();
            $model->paperRelevance()->createMany($data);
          }
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
