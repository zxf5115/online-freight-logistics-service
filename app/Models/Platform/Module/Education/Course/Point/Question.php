<?php
namespace App\Models\Platform\Module\Education\Course\Point;

use App\Models\Common\Module\Education\Course\Unit;
use App\Models\Common\Module\Education\Course\Point\Question as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-09
 *
 * 练习题模型类
 */
class Question extends Common
{
  // 追加到模型数组表单的访问器
  protected $appends = [
    'content'
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 练习题内容类型封装
   * ------------------------------------------
   *
   * 练习题内容类型封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getContentAttribute($value)
  {
    $type = $this->type ? $this->type['text'] : '';
    $id   = $this->id;

    return '{练习题}:' . $type . ':' . $id . ';';
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-08-29
   * ------------------------------------------
   * 获取根节点
   * ------------------------------------------
   *
   * 获取根节点
   *
   * @param [type] $id [description]
   * @return [type]
   */
  public static function getRootId($id)
  {
    $response = Unit::getRow(['id' => $id]);

    if(empty($response))
    {
      return false;
    }

    if(0 == $response->parent_id)
    {
      return $response->id;
    }

    self::getRootId($response->id);
  }
}
