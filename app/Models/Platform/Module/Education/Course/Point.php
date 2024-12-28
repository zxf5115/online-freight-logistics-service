<?php
namespace App\Models\Platform\Module\Education\Course;

use App\Models\Common\Module\Education\Course\Point as Common;
use App\TraitClass\ToolTrait;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-27
 *
 * 课程知识点模型类
 */
class Point extends Common
{
  use ToolTrait;

  // 追加到模型数组表单的访问器
  public $appends = [
    // 'complete_name',
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-22
   * ------------------------------------------
   * 单元完整名字封装封装
   * ------------------------------------------
   *
   * 单元完整名字封装封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  // public function getCompleteNameAttribute($value)
  // {
  //   $response = [];

  //   $unit_id = $this->unit_id;

  //   if(!empty($unit_id))
  //   {
  //     ToolTrait::upWardRecursive($unit_id, $response);

  //     sort($response);

  //     return implode(' - ', $response);
  //   }

  //   return $response;
  // }
}
