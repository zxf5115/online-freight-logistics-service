<?php
namespace App\Models\Common\Module\Education\Course\Point;

use App\Models\Base;
use App\Enum\Module\Education\QuestionEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-09
 *
 * 课程练习题模型类
 */
class Question extends Base
{
  // 表名
  public $table = "module_course_point_question";

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [];

  // 批量添加
  public $fillable = ['id'];



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 练习题类型封装
   * ------------------------------------------
   *
   * 练习题类型封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getTypeAttribute($value)
  {
    return QuestionEnum::getTypeStatus($value);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 练习题内容封装
   * ------------------------------------------
   *
   * 练习题内容封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getOptionsAttribute($value)
  {
    return json_decode($value);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-09
   * ------------------------------------------
   * 练习题答案封装
   * ------------------------------------------
   *
   * 练习题答案封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getAnswerAttribute($value)
  {
    if($this->type['value'] == 5)
    {
      return json_decode($value);
    }
    else
    {
      return $value;
    }
  }


  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-22
   * ------------------------------------------
   * 练习题与课程关联函数
   * ------------------------------------------
   *
   * 练习题与课程关联函数
   *
   * @return [关联对象]
   */
  public function course()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Course\Course', 'course_id', 'id')
                ->where(['status'=>1]);
  }
}
