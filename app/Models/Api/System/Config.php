<?php
namespace App\Models\Api\System;

use App\Http\Constant\Status;
use App\Models\Common\System\Config as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-26
 *
 * 配置模型类
 */
class Config extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'category_id',
    'type',
    'content',
    'status',
    'create_time',
    'update_time'
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-26
   * ------------------------------------------
   * 获取系统配置数据
   * ------------------------------------------
   *
   * 获取系统配置数据
   *
   * @return [type]
   */
  public static function getSystemData()
  {
    try
    {
      $where = [
        'category_id' => 2,
        'status'      => Status::ENABLE
      ];

      return self::where($where)->pluck('value', 'title');
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }

}
