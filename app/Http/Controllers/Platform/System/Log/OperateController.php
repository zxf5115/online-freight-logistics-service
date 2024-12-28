<?php
namespace App\Http\Controllers\Platform\System\Log;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-04
 *
 * 操作日志控制器类
 */
class OperateController extends BaseController
{
  protected $_model = 'App\Models\Platform\System\Log\Operate';

  protected $_where = [];

  protected $_params = [
    'username',
    'organization_id',
    'create_time'
  ];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'list' => [
      'organization'
    ]
  ];
}
