<?php
namespace App\Models\Common\Module\Education\Homework\Relevance;

use App\Models\Base;
use App\Enum\Module\Education\GraduationEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-14
 *
 * 作业与作业答案关联模型类
 */
class Answer extends Base
{
  // 表名
  public $table = "module_homework_answer";

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];

  // 批量添加
  public $fillable = [
    'organization_id',
    'url'
  ];

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-14
   * ------------------------------------------
   * 结业状态封装
   * ------------------------------------------
   *
   * 结业状态封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getGraduationStatusAttribute($value)
  {
    return GraduationEnum::getGraduationStatus($value);
  }


  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-15
   * ------------------------------------------
   * 作业答案与学员关联函数
   * ------------------------------------------
   *
   * 作业答案与学员关联函数
   *
   * @return [关联对象]
   */
  public function member()
  {
    return $this->belongsTo('App\Models\Common\Module\Member\Member', 'member_id', 'id')
                ->where(['status'=>1]);
  }
}
