<?php
namespace App\Models\Common\Module\Member\Intensify;

use App\Models\Base;
use App\Enum\Module\Member\QuestionEnum;
/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-24
 *
 * 会员强化题模型类
 */
class Question extends Base
{
  // 表名
  public $table = "module_member_intensify_question_relevance";

  // 可以批量修改的字段
  public $fillable = [
    'id',
    'organization_id',
    'squad_id',
    'member_id',
    'course_id',
    'intensify_id',
    'question_id'
  ];

  // 隐藏的属性
  public $hidden = [];

  // 追加到模型数组表单的访问器
  protected $appends = [];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 作业结果封装
   * ------------------------------------------
   *
   * 作业结果封装
   *
   * @param int $value 状态值
   * @return 状态信息
   */
  public function getResultAttribute($value)
  {
    return QuestionEnum::getResultStatus($value);
  }


  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 会员作业与会员关联表
   * ------------------------------------------
   *
   * 会员作业与会员关联表
   *
   * @return [关联对象]
   */
  public function member()
  {
    return $this->belongsTo('App\Models\Common\Module\Member\Member', 'member_id', 'id')
                ->where(['status'=>1]);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 会员练习题与课程关联表
   * ------------------------------------------
   *
   * 会员练习题与课程关联表
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
   * 会员强化题与考前强化关联表
   * ------------------------------------------
   *
   * 会员强化题与考前强化关联表
   *
   * @return [关联对象]
   */
  public function intensify()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Course\Intensify', 'intensify_id', 'id')
                ->where(['status'=>1]);
  }
}
