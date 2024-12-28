<?php
namespace App\Models\Api\Module\Member\Relevance;

use App\Http\Constant\Code;
use App\Models\Common\Module\Member\Relevance\MemberMessageRelevance as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-24
 *
 * 会员课程模型类
 */
class MemberMessageRelevance extends Common
{
  use \Awobaz\Compoships\Compoships;

  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'create_time',
    'update_time'
  ];
}
