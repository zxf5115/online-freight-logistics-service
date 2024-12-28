<?php
namespace App\Models\Common\Module\Member\Paper;

use App\Models\Base;
use App\Enum\Module\Member\QuestionEnum;
/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-24
 *
 * 会员试卷模型类
 */
class Paper extends Base
{
  // 表名
  public $table = "module_member_paper_relevance";

  // 可以批量修改的字段
  public $fillable = [
    'id',
    'organization_id',
    'squad_id',
    'member_id',
    'course_id',
    'intensify_id',
    'paper_id'
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


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 会员考试与考试关联表
   * ------------------------------------------
   *
   * 会员考试与考试关联表
   *
   * @return [关联对象]
   */
  public function paper()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Paper\Paper', 'paper_id', 'id')
                ->where(['status'=>1]);
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 会员试卷与试卷试题关联表
   * ------------------------------------------
   *
   * 会员试卷与试卷试题关联表
   *
   * @return [关联对象]
   */
  public function question()
  {
    return $this->hasMany('App\Models\Common\Module\Member\Paper\Relevance\Question', 'question_id', 'id')
                ->where(['status'=>1]);
  }
}
