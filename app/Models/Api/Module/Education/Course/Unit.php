<?php
namespace App\Models\Api\Module\Education\Course;

use App\Models\Common\Module\Education\Course\Unit as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-27
 *
 * 课程单元模型类
 */
class Unit extends Common
{
  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-25
   * ------------------------------------------
   * 课程单元本类关联函数
   * ------------------------------------------
   *
   * 课程单元无限单元下，使用本类进行关联查询
   *
   * @return [type]
   */
  public function children()
  {
    return $this->hasMany(__CLASS__, 'parent_id')
                ->with('children')
                ->where(['status'=>1])
                ->with('point')
                ->orderBy('sort', 'desc');
  }
}
