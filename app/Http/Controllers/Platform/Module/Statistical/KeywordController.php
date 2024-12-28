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
 * 热门关键字控制器类
 */
class KeywordController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Keyword\Keyword';

  // 默认查询条件
  protected $_where = [
    'status' => 1
  ];

  // 查询条件
  protected $_params = [
    'title'
  ];

  protected $_order = [
    ['key' => 'total', 'value' => 'desc'],
  ];
}
