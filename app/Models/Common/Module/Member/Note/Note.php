<?php
namespace App\Models\Common\Module\Member\Note;

use App\Models\Base;
/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-24
 *
 * 笔记模型类
 */
class Note extends Base
{
  // 表名
  public $table = "module_member_note";

  // 可以批量修改的字段
  public $fillable = [
    'id'
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
   * 会员笔记与会员关联表
   * ------------------------------------------
   *
   * 会员笔记与会员关联表
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
   * 会员笔记与课程知识点关联表
   * ------------------------------------------
   *
   * 会员笔记与课程知识点关联表
   *
   * @return [关联对象]
   */
  public function point()
  {
      return $this->belongsTo('App\Models\Common\Module\Education\Course\Point', 'id', 'point_id')
                  ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 会员笔记与笔记附件关联表
   * ------------------------------------------
   *
   * 会员笔记与笔记附件关联表
   *
   * @return [关联对象]
   */
  public function attachment()
  {
      return $this->hasMany('App\Models\Common\Module\Member\Note\Relevance\Attachment', 'note_id', 'id')
                  ->where(['status'=>1]);
  }
}
