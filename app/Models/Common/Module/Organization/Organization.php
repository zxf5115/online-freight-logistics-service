<?php
namespace App\Models\Common\Module\Organization;

use App\Models\Base;
use App\Enum\Module\Organization\OrganizationEnum;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-26
 *
 * 机构模型类
 */
class Organization extends Base
{
  // 表名
  public $table = "module_organization";

  // 可以批量修改的字段
  public $fillable = ['id'];

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];




  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 认证状态封装
   * ------------------------------------------
   *
   * 认证状态封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getCertificationStatusAttribute($value)
  {
    return OrganizationEnum::getCertificationStatus($value);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
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
    return OrganizationEnum::getAuditStatus($value);
  }


  // 关联函数 ------------------------------------------------------


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 机构与课程关联函数
   * ------------------------------------------
   *
   * 机构与课程关联函数
   *
   * @return [关联对象]
   */
  public function course()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Education\Course\Course',
      'module_organization_course_relevance',
      'organization_id',
      'course_id'
    )->wherePivot('status', 1);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 机构与结业班级关联函数
   * ------------------------------------------
   *
   * 机构与结业班级关联函数
   *
   * @return [关联对象]
   */
  public function squad()
  {
    return $this->hasMany('App\Models\Common\Module\Organization\Squad\Squad', 'organization_id', 'id')
                ->where(['status'=>1]);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 机构与结业班级关联函数
   * ------------------------------------------
   *
   * 机构与结业班级关联函数
   *
   * @return [关联对象]
   */
  public function member()
  {
    return $this->hasMany('App\Models\Common\Module\Member\Member', 'organization_id', 'id')
                ->where(['status'=>1]);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 机构与结业班级关联函数
   * ------------------------------------------
   *
   * 机构与结业班级关联函数
   *
   * @return [关联对象]
   */
  public function graduationSquad()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Organization\Squad\Squad',
      'module_graduation_squad_relevance',
      'organization_id',
      'squad_id'
    )->where('graduation_status', 1);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 机构与结业班级关联函数
   * ------------------------------------------
   *
   * 机构与结业班级关联函数
   *
   * @return [关联对象]
   */
  public function graduation()
  {
    return $this->hasMany(
      'App\Models\Common\Module\Education\Graduation\Relevance\Squad', 'organization_id', 'id'
    )->where(['graduation_status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 机构与未结业班级关联函数
   * ------------------------------------------
   *
   * 机构与未结业班级关联函数
   *
   * @return [关联对象]
   */
  public function ungraduation()
  {
    return $this->hasMany(
      'App\Models\Common\Module\Education\Graduation\Relevance\Squad', 'organization_id', 'id'
    )->where(['graduation_status'=>2]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 机构与审核关联函数
   * ------------------------------------------
   *
   * 机构与审核关联函数
   *
   * @return [关联对象]
   */
  public function audit()
  {
    return $this->hasOne('App\Models\Common\Module\Organization\Relevance\Audit', 'organization_id', 'id')
                ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 机构与认证关联函数
   * ------------------------------------------
   *
   * 机构与认证关联函数
   *
   * @return [关联对象]
   */
  public function certification()
  {
    return $this->hasOne('App\Models\Common\Module\Organization\Relevance\Certification', 'organization_id', 'id')
                ->where(['status'=>1]);
  }
}
