<?php
namespace App\Http\Controllers\Platform\Module\Education\Course\Intensify;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-28
 *
 * 考前强化试卷控制器类
 */
class PaperController extends BaseController
{
  protected $_model = 'App\Models\Common\Module\Education\Course\Intensify\Paper';

  protected $_where = [];

  protected $_params = [
    'intensify_id'
  ];

  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  protected $_relevance = [];

}
