<?php
namespace App\Http\Controllers\Api\Module\Member\Note;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-24
 *
 * 会员笔记控制器类
 */
class NoteController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Member\Note\Note';

  protected $_where = [];

  protected $_params = [
    'course_id',
    'point_id',
  ];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'attachment'
  ];


  /**
   * @api {get} /api/member/note/list?page={page} 获取当前用户笔记列表(分页)
   * @apiDescription 获取当前用户笔记列表(分页)
   * @apiGroup 会员笔记模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {int} page 当前页数
   * @apiParam {int} course_id 课程编号（可以为空）
   * @apiParam {int} point_id 知识点编号（可以为空）
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    $condition = self::getCurrentWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getPaging($condition, $this->_relevance, $this->_order);

    return self::success($response);
  }


  /**
   * @api {get} /api/member/note/select 获取当前用户笔记列表(不分页)
   * @apiDescription 获取当前用户笔记列表(不分页)
   * @apiGroup 会员笔记模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/member/note/select
   * @apiParam {int} course_id 课程编号（可以为空）
   * @apiParam {int} point_id 知识点编号（可以为空）
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    $condition = self::getCurrentWhereData();

    // 对用户请求进行过滤
    $filter = $this->filter($request->all());

    $condition = array_merge($condition, $this->_where, $filter);

    $response = $this->_model::getList($condition, $this->_relevance, $this->_order, true);

    return self::success($response);
  }


  /**
   * @api {get} /api/member/note/view/{id} 获取当前用户笔记详情
   * @apiDescription 获取当前用户笔记详情
   * @apiGroup 会员笔记模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiSampleRequest /api/member/note/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    $condition = self::getCurrentWhereData();

    $where = ['id' => $id];

    $condition = array_merge($condition, $where);

    $response = $this->_model::getRow($condition, $this->_relevance);

    return self::success($response);
  }


  /**
   * @api {post} /api/member/note/handle 笔记操作
   * @apiDescription 会员登录进行笔记
   * @apiGroup 会员笔记模块
   * @apiPermission jwt
   * @apiParam {string} token JWTtoken
   * @apiParam {string} squad_id 班级编号
   * @apiParam {string} course_id 课程编号
   * @apiParam {string} point_id 课程知识点编号
   * @apiParam {string} content 笔记内容
   * @apiParam {array} attachment 附件地址数组（可以为空）
   * @apiParam {json} example {"squad_id":"1","course_id":"5", "point_id":"5", "content":"321","attachment":[{"title":"111","url":"www.qiansha"},{"title":"222","url":"www.xiechengfuwu.com"},{"title":"333","url":"www.baidu.com"}]}
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'squad_id.required'  => '请您输入班级编号',
      'course_id.required' => '请您输入课程编号',
      'point_id.required'  => '请您输入知识点编号',
      'content.required'   => '请您输入笔记内容'
    ];

    $validator = Validator::make($request->all(), [
      'squad_id' => 'required',
      'course_id' => 'required',
      'point_id'  => 'required',
      'content'   => 'required'
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

      $organization_id = self::getOrganizationId();

      $model->organization_id = $organization_id;
      $model->member_id       = self::getCurrentId();
      $model->squad_id        = $request->squad_id;
      $model->course_id       = $request->course_id;
      $model->point_id        = $request->point_id;
      $model->content         = $request->content;

      DB::beginTransaction();

      try
      {
        $response = $model->save();

        $data = json_decode($request->attachment, true);

        if(!empty($data))
        {
          foreach($data as &$item)
          {
            $item['organization_id'] = $organization_id;
          }

          $model->attachment()->delete();
          $model->attachment()->createMany($data);
        }

        DB::commit();

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        DB::rollback();
dd($e);
        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }
}
