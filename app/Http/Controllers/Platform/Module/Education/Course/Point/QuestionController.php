<?php
namespace App\Http\Controllers\Platform\Module\Education\Course\Point;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Enum\Module\Education\QuestionEnum;
use App\Http\Controllers\Platform\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-09
 *
 * 练习题控制器类
 */
class QuestionController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Education\Course\Point\Question';

  protected $_where = [];

  protected $_params = [
    'title',
    'type',
    'course_id'
  ];

  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'course'
  ];

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-12
   * ------------------------------------------
   * 获取列表信息
   * ------------------------------------------
   *
   * 获取列表信息
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function select(Request $request)
  {
    try
    {
      $where = [];

      $condition = self::getBaseWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      if(!empty($request->unit_id))
      {
        $unit_id = $this->_model::getRootId($request->unit_id);

        $where = [
          'unit_id' => $unit_id
        ];
      }

      $condition = array_merge($condition, $this->_where, $filter, $where);

      $relevance = self::getRelevanceData($this->_relevance, 'select');

      $response = $this->_model::getList($condition, $relevance, $this->_order);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 练习题类型
   * ------------------------------------------
   *
   * 练习题类型
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function type(Request $request)
  {
    $type = QuestionEnum::$type;

    $value = array_column($type, 'value');
    $text = array_column($type, 'text');

    $response = array_combine($value, $text);

    return self::success($response);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-12
   * ------------------------------------------
   * 单选题操作信息
   * ------------------------------------------
   *
   * 单选题操作信息
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function choices(Request $request)
  {
    $messages = [
      'course_id.required' => '请您选择所属课程',
      'unit_id.required'   => '请您选择所属课程单元',
      'title.required'     => '请您输入练习题标题',
      'options.required'   => '请您输入练习题内容',
      'answer.required'    => '请您输入练习题答案',
    ];

    $validator = Validator::make($request->all(), [
      'course_id' => 'required',
      'unit_id'   => 'required',
      'title'     => 'required',
      'options'   => 'required',
      'answer'    => 'required',
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
      $model->course_id       = $request->course_id;
      $model->unit_id         = $request->unit_id;
      $model->type            = $request->type;
      $model->title           = $request->title;
      $model->url             = $request->url;
      $model->description     = $request->description;
      $model->level           = $request->level;
      $model->score           = $request->score;
      $model->options         = json_encode($request->options);
      $model->answer          = $request->answer;
      $model->analysis        = $request->analysis;

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
   * @dateTime 2020-02-12
   * ------------------------------------------
   * 多选题操作信息
   * ------------------------------------------
   *
   * 多选题操作信息
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function mchoices(Request $request)
  {
    $messages = [
      'course_id.required' => '请您选择所属课程',
      'unit_id.required'   => '请您选择所属课程单元',
      'title.required'     => '请您输入练习题标题',
      'options.required'   => '请您输入练习题内容',
      'answer.required'    => '请您输入练习题答案',
    ];

    $validator = Validator::make($request->all(), [
      'course_id' => 'required',
      'unit_id'   => 'required',
      'title'     => 'required',
      'options'   => 'required',
      'answer'    => 'required',
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
      $model->course_id       = $request->course_id;
      $model->unit_id         = $request->unit_id;
      $model->type            = $request->type;
      $model->title           = $request->title;
      $model->url             = $request->url;
      $model->description     = $request->description;
      $model->level           = $request->level;
      $model->score           = $request->score;
      $model->options         = json_encode($request->options);
      $model->answer          = json_encode($request->answer);
      $model->analysis        = $request->analysis;

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
   * @dateTime 2020-02-12
   * ------------------------------------------
   * 判断题操作信息
   * ------------------------------------------
   *
   * 判断题操作信息
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function judgement(Request $request)
  {
    $messages = [
      'course_id.required' => '请您选择所属课程',
      'unit_id.required'   => '请您选择所属课程单元',
      'title.required'     => '请您输入练习题标题',
      'options.required'   => '请您输入练习题内容',
    ];

    $validator = Validator::make($request->all(), [
      'course_id' => 'required',
      'unit_id'   => 'required',
      'title'     => 'required',
      'options'   => 'required',
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
      $model->course_id       = $request->course_id;
      $model->unit_id         = $request->unit_id;
      $model->type            = $request->type;
      $model->title           = $request->title;
      $model->description     = $request->description;
      $model->level           = $request->level;
      $model->score           = $request->score;
      $model->options         = json_encode($request->options);
      $model->analysis        = $request->analysis;

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
   * @dateTime 2020-02-12
   * ------------------------------------------
   * 连线题操作信息
   * ------------------------------------------
   *
   * 连线题操作信息
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function connection(Request $request)
  {
    $messages = [
      'course_id.required' => '请您选择所属课程',
      'unit_id.required'   => '请您选择所属课程单元',
      'title.required'     => '请您输入练习题标题',
      'options.required'   => '请您输入练习题内容',
    ];

    $validator = Validator::make($request->all(), [
      'course_id' => 'required',
      'unit_id'   => 'required',
      'title'     => 'required',
      'options'   => 'required',
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
      $model->course_id       = $request->course_id;
      $model->unit_id         = $request->unit_id;
      $model->type            = $request->type;
      $model->title           = $request->title;
      $model->description     = $request->description;
      $model->level           = $request->level;
      $model->score           = $request->score;
      $model->options         = json_encode($request->options);
      $model->analysis        = $request->analysis;

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
   * @dateTime 2020-02-12
   * ------------------------------------------
   * 计算题操作信息
   * ------------------------------------------
   *
   * 计算题操作信息
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function compute(Request $request)
  {
    $messages = [
      'course_id.required' => '请您选择所属课程',
      'unit_id.required'   => '请您选择所属课程单元',
      'title.required'     => '请您输入练习题标题',
      'answer.required'    => '请您输入练习题答案',
    ];

    $validator = Validator::make($request->all(), [
      'course_id' => 'required',
      'unit_id'   => 'required',
      'title'     => 'required',
      'answer'    => 'required',
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
      $model->course_id       = $request->course_id;
      $model->unit_id         = $request->unit_id;
      $model->type            = $request->type;
      $model->title           = $request->title;
      $model->level           = $request->level;
      $model->score           = $request->score;
      $model->answer          = $request->answer;
      $model->analysis        = $request->analysis;

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
   * @dateTime 2020-02-12
   * ------------------------------------------
   * 填空题|名词解析操作信息
   * ------------------------------------------
   *
   * 填空题|名词解析操作信息
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function explain(Request $request)
  {
    $messages = [
      'course_id.required' => '请您选择所属课程',
      'unit_id.required'   => '请您选择所属课程单元',
      'title.required'     => '请您输入练习题标题',
    ];

    $validator = Validator::make($request->all(), [
      'course_id' => 'required',
      'unit_id'   => 'required',
      'title'     => 'required',
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

        $model->organization_id = self::getOrganizationId();
        $model->course_id       = $request->course_id;
        $model->unit_id         = $request->unit_id;
        $model->type            = $request->type;
        $model->title           = $request->title;
        $model->answer          = $request->answer;
        $model->level           = $request->level;
        $model->score           = $request->score;
        $model->analysis        = $request->analysis;

        $response = $model->save();

        return self::success(Code::message(Code::HANDLE_SUCCESS));
      }
      catch(\Exception $e)
      {
        self::record($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }




  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-12
   * ------------------------------------------
   * 特殊题操作信息
   * ------------------------------------------
   *
   * 特殊题操作信息
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function special(Request $request)
  {
    $messages = [
      'course_id.required' => '请您选择所属课程',
      'unit_id.required'   => '请您选择所属课程单元',
      'title.required'     => '请您输入练习题标题',
    ];

    $validator = Validator::make($request->all(), [
      'course_id' => 'required',
      'unit_id'   => 'required',
      'title'     => 'required',
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
      $model->course_id       = $request->course_id;
      $model->unit_id         = $request->unit_id;
      $model->type            = $request->type;
      $model->title           = $request->title;
      $model->description     = $request->description;
      $model->level           = $request->level;
      $model->score           = $request->score;
      $model->analysis        = $request->analysis;

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
