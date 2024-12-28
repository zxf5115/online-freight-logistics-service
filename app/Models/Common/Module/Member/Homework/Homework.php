<?php
namespace App\Models\Common\Module\Member\Homework;

use App\Models\Base;
use App\Enum\Module\Education\HomeworkEnum;
/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-24
 *
 * 会员作业模型类
 */
class Homework extends Base
{
  // 表名
  public $table = "module_member_homework_relevance";

  // 可以批量修改的字段
  public $fillable = [
    'id',
    'organization_id',
    'member_id',
    'squad_id',
    'homework_id',
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
    return HomeworkEnum::getResultStatus($value);
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
   * 会员作业与作业关联表
   * ------------------------------------------
   *
   * 会员作业与作业关联表
   *
   * @return [关联对象]
   */
  public function homework()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Homework\Homework', 'homework_id', 'id')
                ->where(['status'=>1]);
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 会员作业与作业附件关联表
   * ------------------------------------------
   *
   * 会员作业与作业附件关联表
   *
   * @return [关联对象]
   */
  public function attachment()
  {
      return $this->hasMany('App\Models\Common\Module\Member\Homework\Relevance\Attachment', 'homework_id', 'id')
                  ->where(['status'=>1]);
  }
}
