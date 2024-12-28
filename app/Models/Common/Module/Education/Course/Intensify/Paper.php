<?php
namespace App\Models\Common\Module\Education\Course\Intensify;

use App\Models\Base;
use App\Enum\Module\Education\QuestionEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-14
 *
 * 考前强化试卷模型类
 */
class Paper extends Base
{
  // 表名
  public $table = "module_course_intensify_paper_relevance";

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
  public $fillable = ['id', 'organization_id', 'paper_id'];

}
