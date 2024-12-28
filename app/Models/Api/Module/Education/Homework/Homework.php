<?php
namespace App\Models\Api\Module\Education\Homework;

use App\Models\Common\Module\Education\Homework\Homework as Common;
use App\Models\Api\Module\Member\Homework\Homework as MemberHomework;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-14
 *
 * 作业模型类
 */
class Homework extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'create_time',
    'update_time'
  ];


  // 追加到模型数组表单的访问器
  public $appends = [
    'is_finish',
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-04-29
   * ------------------------------------------
   * 当前学员是否完成课程
   * ------------------------------------------
   *
   * 当前学员是否完成课程
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getIsFinishAttribute($value)
  {
    $response = false;

    $where = [
      'member_id'   => auth('api')->user()->id,
      'homework_id' => $this->id,
    ];

    $result = MemberHomework::getRow($where);

    if(!empty($result->id))
    {
      $response = true;
    }

    return $response;
  }
}
