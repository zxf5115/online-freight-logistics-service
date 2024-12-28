<?php
namespace App\Models\Common\Module\Organization\Squad;

use App\Models\Base;
use App\Enum\Module\Organization\Squad\SquadEnum;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-07
 *
 * 班级模型类
 */
class Squad extends Base
{
  // 表名
  public $table = "module_squad";

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [
    'valid_time',
  ];

  // 批量添加
  public $fillable = ['id'];


  /**
   * 转换属性类型
   */
  protected $casts = [
    'status' => 'array',
    'start_time' => 'datetime:Y-m-d',
    'end_time' => 'datetime:Y-m-d',
    'create_time' => 'datetime:Y-m-d H:i:s',
    'update_time' => 'datetime:Y-m-d H:i:s',
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 封装有效时间
   * ------------------------------------------
   *
   * 封装有效时间
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getValidTimeAttribute($value)
  {
    $start_time = date('Y-m-d', strtotime($this->start_time));
    $end_time = date('Y-m-d', strtotime($this->end_time));

    return [
      $start_time,
      $end_time
    ];
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
    return SquadEnum::getAuditStatus($value);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-25
   * ------------------------------------------
   * 开课状态封装
   * ------------------------------------------
   *
   * 开课状态封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getOpenStatusAttribute($value)
  {
    return SquadEnum::getOpenStatus($value);
  }


  // 关联函数 ------------------------------------------------------



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 班级与机构关联函数
   * ------------------------------------------
   *
   * 班级与机构关联函数
   *
   * @return [关联对象]
   */
  public function organization()
  {
    return $this->hasOne('App\Models\Common\Module\Organization\Organization', 'id', 'organization_id')
                ->where(['status'=>1]);
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
  public function course()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Education\Course\Course',
      'module_squad_course_relevance',
      'squad_id',
      'course_id'
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
  public function courseRelevance()
  {
    return $this->hasMany('App\Models\Common\Module\Organization\Squad\Relevance\Course', 'squad_id', 'id')
                ->where('status', 1);
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 班级与会员关联函数
   * ------------------------------------------
   *
   * 班级与会员关联函数
   *
   * @return [关联对象]
   */
  public function member()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Member\Member',
      'module_squad_member_relevance',
      'squad_id',
      'member_id'
    )->wherePivot('status', 1);
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 班级与学员关联函数
   * ------------------------------------------
   *
   * 班级与学员关联函数
   *
   * @return [关联对象]
   */
  public function memberRelevance()
  {
    return $this->hasMany('App\Models\Common\Module\Organization\Squad\Relevance\Member', 'squad_id', 'id')->where('status', 1);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 班级与学员课程学习情况关联函数
   * ------------------------------------------
   *
   * 班级与学员课程学习情况关联函数
   *
   * @return [关联对象]
   */
  public function memberCourse()
  {
    return $this->hasMany('App\Models\Common\Module\Member\Relevance\MemberCourseRelevance', 'squad_id', 'id')
                ->where('status', 1);
  }




  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 班级与作业关联函数
   * ------------------------------------------
   *
   * 班级与作业关联函数
   *
   * @return [关联对象]
   */
  public function homeworkRelevance()
  {
    return $this->hasMany('App\Models\Common\Module\Education\Homework\Relevance\Squad', 'squad_id', 'id')
                ->where('status', 1);
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 班级与审核关联函数
   * ------------------------------------------
   *
   * 班级与审核关联函数
   *
   * @return [关联对象]
   */
  public function audit()
  {
    return $this->hasOne('App\Models\Common\Module\Organization\Squad\Relevance\Audit', 'squad_id', 'id')
                ->where(['status'=>1]);
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 班级与课程学习进度关联表
   * ------------------------------------------
   *
   * 班级与课程学习进度关联表
   *
   * @return [关联对象]
   */
  public function courseProgress()
  {
      return $this->hasMany('App\Models\Common\Module\Member\Study\Progress\Course', 'squad_id', 'id')
                  ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 班级与课程单元学习进度关联表
   * ------------------------------------------
   *
   * 班级与课程单元学习进度关联表
   *
   * @return [关联对象]
   */
  public function unitProgress()
  {
      return $this->hasMany('App\Models\Common\Module\Member\Study\Progress\Unit', 'squad_id', 'id')
                  ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 班级与课程单元知识点学习进度关联表
   * ------------------------------------------
   *
   * 班级与课程单元知识点学习进度关联表
   *
   * @return [关联对象]
   */
  public function pointProgress()
  {
      return $this->hasMany('App\Models\Common\Module\Member\Study\Progress\Point', 'squad_id', 'id')
                  ->where(['status'=>1]);
  }
}
