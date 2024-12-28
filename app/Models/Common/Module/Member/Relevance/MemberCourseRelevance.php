<?php
namespace App\Models\Common\Module\Member\Relevance;

use App\Models\Base;
use App\Enum\Common\TimeEnum;
use App\Enum\Module\Member\Relevance\CourseEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-15
 *
 * 会员课程关联模型类
 */
class MemberCourseRelevance extends Base
{
  // 表名
  public $table = 'module_member_course_relevance';

  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'create_time',
    'update_time'
  ];

  /**
   * 可以被批量赋值的属性
   */
  public $fillable = [
    'organization_id',
    'squad_id',
    'member_id',
    'course_id',
    'course_time'
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-31
   * ------------------------------------------
   * 学习设备类型封装
   * ------------------------------------------
   *
   * 学习设备类型封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getTypeAttribute($value)
  {
    return CourseEnum::getTypeStatus($value);
  }


  // 关联函数 ------------------------------------------------------


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-03-07
   * ------------------------------------------
   * 反向关联用户
   * ------------------------------------------
   *
   * 反向关联用户
   *
   * @return [type]
   */
  public function member()
  {
    return $this->belongsTo('App\Models\Common\Module\Member\Member', 'member_id', 'id')
                ->where(['status'=>1]);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-03-07
   * ------------------------------------------
   * 反向关联班级
   * ------------------------------------------
   *
   * 反向关联班级
   *
   * @return [type]
   */
  public function squad()
  {
    return $this->belongsTo('App\Models\Api\Module\Organization\Squad\Squad', 'squad_id', 'id')
                ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-03-07
   * ------------------------------------------
   * 反向关联课程
   * ------------------------------------------
   *
   * 反向关联课程
   *
   * @return [type]
   */
  public function course()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Course\Course', 'course_id', 'id');
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-03-07
   * ------------------------------------------
   * 反向关联课程
   * ------------------------------------------
   *
   * 反向关联课程
   *
   * @return [type]
   */
  public function unit()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Course\Unit', 'unit_id', 'id')
                ->where(['status'=>1]);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-03-07
   * ------------------------------------------
   * 反向关联课程
   * ------------------------------------------
   *
   * 反向关联课程
   *
   * @return [type]
   */
  public function point()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Course\Point', 'point_id', 'id')
                ->where(['status'=>1]);
  }
}
