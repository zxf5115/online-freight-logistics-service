<?php
namespace App\Models\Common\Module\Member;

use App\Models\Base;
use App\Enum\Common\SexEnum;
use App\Enum\Common\AreaEnum;
use App\Enum\Common\NationalEnum;
use App\Enum\Common\EducationEnum;
use App\Enum\Module\Member\ArchiveEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-24
 *
 * 会员档案模型类
 */
class Certificate extends Base
{
  // 表名
  public $table = "module_member_certificate";

  // 可以批量修改的字段
  public $fillable = [
    'id'
  ];

  // 隐藏的属性
  public $hidden = [];

  // 追加到模型数组表单的访问器
  protected $appends = [];

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 学历封装
   * ------------------------------------------
   *
   * 学历封装
   *
   * @param int $value 状态值
   * @return 状态信息
   */
  public function getEducationAttribute($value)
  {
    return EducationEnum::getDegree($value);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 民族封装
   * ------------------------------------------
   *
   * 民族封装
   *
   * @param int $value 状态值
   * @return 状态信息
   */
  public function getNationalAttribute($value)
  {
    return NationalEnum::getNational($value);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-21
   * ------------------------------------------
   * 性别封装
   * ------------------------------------------
   *
   * 性别封装
   *
   * @param int $value 状态值
   * @return 状态信息
   */
  public function getSexAttribute($value)
  {
    return SexEnum::getSex($value);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-21
   * ------------------------------------------
   * 省信息封装
   * ------------------------------------------
   *
   * 省信息封装
   *
   * @param int $value 状态值
   * @return 状态信息
   */
  public function getProvinceIdAttribute($value)
  {
    return AreaEnum::getArea($value);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-21
   * ------------------------------------------
   * 市信息封装
   * ------------------------------------------
   *
   * 市信息封装
   *
   * @param int $value 状态值
   * @return 状态信息
   */
  public function getCityIdAttribute($value)
  {
    return AreaEnum::getArea($value);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-21
   * ------------------------------------------
   * 区县信息封装
   * ------------------------------------------
   *
   * 区县信息封装
   *
   * @param int $value 状态值
   * @return 状态信息
   */
  public function getRegionIdAttribute($value)
  {
    return AreaEnum::getArea($value);
  }

  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 会员档案与会员关联表
   * ------------------------------------------
   *
   * 会员档案与会员关联表
   *
   * @return [关联对象]
   */
  public function member()
  {
      return $this->belongsTo('App\Models\Common\Module\Member\Archive', 'id', 'member_id')
                  ->where(['status'=>1]);
  }
}