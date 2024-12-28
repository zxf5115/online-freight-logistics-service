<?php
namespace App\Models\Common\Module\Member\Study\Progress;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-24
 *
 * 会员学习进度模型类
 */
class Point extends Base
{
  // 表名
  public $table = "module_member_study_course_unit_point_progress";

  // 可以批量修改的字段
  public $fillable = [
    'id',
    'organization_id',
    'member_id',
    'squad_id',
    'course_id',
    'unit_id',
    'point_id',
    'courseware_time',
  ];

  // 隐藏的属性
  public $hidden = [];

  // 追加到模型数组表单的访问器
  protected $appends = [];


  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 会员学习进度与机构关联表
   * ------------------------------------------
   *
   * 会员学习进度与机构关联表
   *
   * @return [关联对象]
   */
  public function organization()
  {
      return $this->belongsTo('App\Models\Common\Module\Organization\Organization', 'id', 'organization_id')
                  ->where(['status'=>1]);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 会员学习进度与会员关联表
   * ------------------------------------------
   *
   * 会员学习进度与会员关联表
   *
   * @return [关联对象]
   */
  public function member()
  {
      return $this->belongsTo('App\Models\Common\Module\Member\Member', 'id', 'member_id')
                  ->where(['status'=>1]);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 会员学习进度与课程关联表
   * ------------------------------------------
   *
   * 会员学习进度与课程关联表
   *
   * @return [关联对象]
   */
  public function course()
  {
      return $this->belongsTo('App\Models\Common\Module\Education\Course\Course', 'course_id', 'id')
                  ->where(['status'=>1]);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 会员学习进度与课程关联表
   * ------------------------------------------
   *
   * 会员学习进度与课程关联表
   *
   * @return [关联对象]
   */
  public function unit()
  {
      return $this->belongsTo('App\Models\Common\Module\Education\Course\Unit', 'id', 'unit_id')
                  ->where(['status'=>1]);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 会员学习进度与课程知识点关联表
   * ------------------------------------------
   *
   * 会员学习进度与课程知识点关联表
   *
   * @return [关联对象]
   */
  public function point()
  {
      return $this->belongsTo('App\Models\Common\Module\Education\Course\Point', 'point_id', 'id')
                  ->where(['status'=>1]);
  }
}
