<?php
namespace App\Models\Platform\Module\Education\Course;

use App\Models\Common\Module\Education\Course\Unit as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-27
 *
 * 课程单元模型类
 */
class Unit extends Common
{
  // 追加到模型数组表单的访问器
  public $appends = [
    'hasChildren'
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-22
   * ------------------------------------------
   * 课程单元是否包含子单元封装
   * ------------------------------------------
   *
   * 课程单元是否包含子单元封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getHasChildrenAttribute($value)
  {
    $response = true;

    try
    {
      if(empty($this->child) || count($this->child) == 0)
      {
        $response = false;
      }

      unset($this->child);

      return $response;
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }
}
