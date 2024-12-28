<?php
namespace App\Models\Common\Module\Education\Graduation\Relevance;

use App\Models\Base;
use App\Enum\Module\Education\GraduationEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-14
 *
 * 结业与学员关联模型类
 */
class Member extends Base
{
  // 表名
  public $table = "module_graduation_member_relevance";

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];

  // 批量添加
  public $fillable = [
    'organization_id',
    'graduation_squad_id',
    'squad_id',
    'member_id',
    'graduation_status'
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
}
