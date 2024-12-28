<?php
namespace App\Models\Common\Module\Education\Graduation;

use App\Models\Base;
use App\Enum\Module\Education\GraduationEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-13
 *
 * 结业模型类
 */
class Graduation extends Base
{
  // 表名
  public $table = "module_graduation";

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [];

  // 批量添加
  public $fillable = ['member_id', 'graduation_status'];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-14
   * ------------------------------------------
   * 审核状态封装
   * ------------------------------------------
   *
   * 审核状态封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getAuditStatusAttribute($value)
  {
    return GraduationEnum::getAuditStatus($value);
  }


  // 关联函数 ------------------------------------------------------


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-13
   * ------------------------------------------
   * 结业与机构关联函数
   * ------------------------------------------
   *
   * 结业与机构关联函数
   *
   * @return [关联对象]
   */
  public function organization()
  {
    return $this->belongsTo('App\Models\Common\Module\Organization\Organization', 'organization_id', 'id')
                ->where(['status'=>1]);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-13
   * ------------------------------------------
   * 结业与班级关联函数
   * ------------------------------------------
   *
   * 结业与班级关联函数
   *
   * @return [关联对象]
   */
  public function squad()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Organization\Squad\Squad',
      'module_graduation_squad_relevance',
      'graduation_id',
      'squad_id'
    )->wherePivot('status', 1);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 班级与课程关联函数
   * ------------------------------------------
   *
   * 班级与课程关联函数
   *
   * @return [关联对象]
   */
  public function squadRelevance()
  {
    return $this->hasMany('App\Models\Common\Module\Education\Graduation\Relevance\Squad', 'graduation_id', 'id')
                ->where('status', 1);
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-14
   * ------------------------------------------
   * 结业与学员关联函数
   * ------------------------------------------
   *
   * 结业与学员关联函数
   *
   * @return [关联对象]
   */
  public function graduation()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Member\Member',
      'module_graduation_member_relevance',
      'graduation_id',
      'member_id'
    )->wherePivot('graduation_status', 1);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 班级与课程关联函数
   * ------------------------------------------
   *
   * 班级与课程关联函数
   *
   * @return [关联对象]
   */
  public function graduationRelevance()
  {
    return $this->hasMany('App\Models\Common\Module\Education\Graduation\Relevance\Member', 'graduation_id', 'id')
                ->where('graduation_status', 1);
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-17
   * ------------------------------------------
   * 未结业与学员关联函数
   * ------------------------------------------
   *
   * 未结业与学员关联函数
   *
   * @return [关联对象]
   */
  public function ungraduation()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Member\Member',
      'module_graduation_member_relevance',
      'graduation_id',
      'member_id'
    )->wherePivot('graduation_status', 2);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 班级与课程关联函数
   * ------------------------------------------
   *
   * 班级与课程关联函数
   *
   * @return [关联对象]
   */
  public function ungraduationRelevance()
  {
    return $this->hasMany('App\Models\Common\Module\Education\Graduation\Relevance\Member', 'graduation_id', 'id')
                ->where('graduation_status', 2);
  }
}
