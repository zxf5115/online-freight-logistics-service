<?php
namespace App\Models\Common\Module\Education\Course;

use App\Models\Base;
use App\Enum\Module\Education\UnitEnum;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-22
 *
 * 课程单元模型类
 */
class Unit extends Base
{
  // 表名
  public $table = "module_course_unit";

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];

  // 批量添加
  public $fillable = ['id'];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-31
   * ------------------------------------------
   * 单元栏目封装
   * ------------------------------------------
   *
   * 单元栏目封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getIsColumnAttribute($value)
  {
    return UnitEnum::getColumnStatus($value);
  }


  // 关联函数 ------------------------------------------------------


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-22
   * ------------------------------------------
   * 课程单元与课程关联函数
   * ------------------------------------------
   *
   * 课程单元与课程关联函数
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
   * @dateTime 2020-09-25
   * ------------------------------------------
   * 课程单元与课程关联函数
   * ------------------------------------------
   *
   * 课程单元与课程关联函数
   *
   * @return [关联对象]
   */
  public function point()
  {
    return $this->hasMany('App\Models\Common\Module\Education\Course\Point', 'unit_id', 'id')
                ->where(['status'=>1])->orderBy('sort', 'desc');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-25
   * ------------------------------------------
   * 课程单元本类关联函数
   * ------------------------------------------
   *
   * 课程单元无限单元下，使用本类进行关联查询
   *
   * @return [type]
   */
  public function child()
  {
    return $this->hasMany(__CLASS__, 'parent_id')
                ->where(['status'=>1])
                ->orderBy('sort', 'desc');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-25
   * ------------------------------------------
   * 课程单元本类关联函数
   * ------------------------------------------
   *
   * 课程单元无限单元下，使用本类进行关联查询
   *
   * @return [type]
   */
  public function children()
  {
    return $this->hasMany(__CLASS__, 'parent_id')
                ->with('children')
                ->where(['status'=> 1])
                ->orderBy('sort', 'desc');
  }
}
