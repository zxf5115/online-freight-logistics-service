<?php
namespace App\Http\Controllers\Platform\Module\Education\Paper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Enum\Module\Education\QuestionEnum;
use App\Http\Controllers\Platform\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-09
 *
 * 试题控制器类
 */
class QuestionController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Education\Paper\Relevance\Question';

  protected $_where = [];

  protected $_params = [
    'title',
    'paper_id'
  ];

  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  protected $_relevance = [];


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
      'paper_id.required' => '请您选择所属试卷',
      'title.required'   => '请您输入试题标题',
      'options.required' => '请您输入试题内容',
      'answer.required'  => '请您输入试题答案',
    ];

    $validator = Validator::make($request->all(), [
      'paper_id' => 'required',
      'title'   => 'required',
      'options' => 'required',
      'answer'  => 'required',
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
      $model->type            = $request->type;
      $model->paper_id        = $request->paper_id;
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
      'paper_id.required' => '请您选择所属试卷',
      'title.required'    => '请您输入试题标题',
      'options.required'  => '请您输入试题内容',
      'answer.required'   => '请您输入试题答案',
    ];

    $validator = Validator::make($request->all(), [
      'paper_id' => 'required',
      'title'    => 'required',
      'options'  => 'required',
      'answer'   => 'required',
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
      $model->type            = $request->type;
      $model->paper_id        = $request->paper_id;
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
      'paper_id.required' => '请您选择所属试卷',
      'title.required'   => '请您输入试题标题',
      'options.required' => '请您输入试题内容',
    ];

    $validator = Validator::make($request->all(), [
      'paper_id' => 'required',
      'title'    => 'required',
      'options'  => 'required',
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
      $model->paper_id        = $request->paper_id;
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
      'paper_id.required' => '请您选择所属试卷',
      'title.required'   => '请您输入试题标题',
      'options.required' => '请您输入试题内容',
    ];

    $validator = Validator::make($request->all(), [
      'paper_id' => 'required',
      'title'   => 'required',
      'options' => 'required',
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
      $model->type            = $request->type;
      $model->paper_id        = $request->paper_id;
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
      'paper_id.required' => '请您选择所属试卷',
      'title.required'  => '请您输入试题标题',
      'answer.required' => '请您输入试题答案',
    ];

    $validator = Validator::make($request->all(), [
      'paper_id' => 'required',
      'title'   => 'required',
      'answer'   => 'required',
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
      $model->type            = $request->type;
      $model->paper_id        = $request->paper_id;
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
      'paper_id.required' => '请您选择所属试卷',
      'title.required'   => '请您输入试题标题',
    ];

    $validator = Validator::make($request->all(), [
      'paper_id' => 'required',
      'title'   => 'required',
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
      $model->type            = $request->type;
      $model->paper_id        = $request->paper_id;
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
