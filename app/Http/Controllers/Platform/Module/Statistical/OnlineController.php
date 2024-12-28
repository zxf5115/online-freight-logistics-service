<?php
namespace App\Http\Controllers\Platform\Module\Statistical;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-25
 *
 * 在线会员控制器类
 */
class OnlineController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Member\Online';

  // 默认查询条件
  protected $_where = [
    'status' => 1,
    'online_status' => 1
  ];

  // 查询条件
  protected $_params = [
    'title'
  ];

  // 附加参数
  protected $_addition = [
    'member' => [
      'username',
      'nickname'
    ]
  ];

  // 排序
  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  // 关联对象
  protected $_relevance = [
    'list' => [
      'member'
    ]
  ];
}
