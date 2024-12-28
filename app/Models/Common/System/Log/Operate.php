<?php
namespace App\Models\Common\System\Log;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-08
 *
 * 操作日志模型类
 */
class Operate extends Base
{
  // 表名
  public $table = "system_operate_log";

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];

  // 批量添加
  public $fillable = ['id'];



  // 关联函数 ------------------------------------------------------


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 机构课程与机构关联函数
   * ------------------------------------------
   *
   * 机构课程与机构关联函数
   *
   * @return [关联对象]
   */
  public function organization()
  {
    return $this->belongsTo('App\Models\Common\Module\Organization\Organization', 'organization_id', 'id')
                ->where(['status'=>1]);
  }
}
