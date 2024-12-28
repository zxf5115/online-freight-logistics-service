<?php
namespace App\Models\Common\Module\Education\Course\Intensify;

use App\Models\Base;
use App\Enum\Module\Education\QuestionEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-14
 *
 * 考前强化试题模型类
 */
class Question extends Base
{
  // 表名
  public $table = "module_course_intensify_question";

  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'create_time',
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];

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
   * 试题与考前强化关联函数
   * ------------------------------------------
   *
   * 试题与考前强化关联函数
   *
   * @return [关联对象]
   */
  public function intensify()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Course\Intensify', 'intensify_id', 'id')
                ->where(['status'=>1]);
  }
}
