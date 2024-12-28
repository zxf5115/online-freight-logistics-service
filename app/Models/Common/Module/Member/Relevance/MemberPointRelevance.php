<?php
namespace App\Models\Common\Module\Member\Relevance;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-15
 *
 * 会员知识点关联模型类
 */
class MemberPointRelevance extends Base
{
  // 表名
  public $table = 'module_member_point_relevance';

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
  public $fillable = ['point_id'];

  // 追加到模型数组表单的访问器
  public $appends = [];


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
    return $this->belongsTo('App\Models\Common\Module\Member', 'member_id', 'id')
                ->where(['status'=>1]);
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-03-07
   * ------------------------------------------
   * 反向关联知识点
   * ------------------------------------------
   *
   * 反向关联知识点
   *
   * @return [type]
   */
  public function point()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Course\Point', 'point_id', 'id')
                ->where(['status'=>1]);
  }
}
