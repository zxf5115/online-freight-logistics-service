<?php
namespace App\Models\Common\Module\Member;

use App\Models\Base;
use App\Enum\Module\Member\MemberEnum;
use App\Http\Constant\Parameter;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-08-01
 *
 * 会员模型类
 */
class Member extends Base
{
  // 表名
  public $table = "module_member";

  // 可以批量修改的字段
  public $fillable = [
    'organization_id',
    'username',
    'password'
  ];

  // 隐藏的属性
  public $hidden = [
    'password', 'remember_token', 'password_salt', 'sms_code', 'try_number', 'last_login_ip'
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-19
   * ------------------------------------------
   * 访问限制
   * ------------------------------------------
   *
   * 在一个小时内访问超过五次，就会触发禁止访问
   *
   * @param [type] $request [description]
   */
  public static function AccessRestrictions($request)
  {
    try
    {
      // 如果用户上次登录时间和当前时间相差小于一个小时并且登录次数小于五次，返回可以访问，否则禁止访问
      if(time() - $request->last_login_time < 3600 && $request->try_number > 5)
      {
        return true;
      }

      return false;
    }
    catch(\Exception $e)
    {
      self::log($e);

      return false;
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-19
   * ------------------------------------------
   * 验证密码
   * ------------------------------------------
   *
   * 具体描述一些细节
   *
   * @param array $request 用户对象
   * @param string $password 用户输入的密码
   * @return 密码正确返回false，否则true
   */
  public static function checkPassword($request, $password)
  {
    try
    {
      if(password_verify($password, $request->password))
      {
        return false;
      }

      return true;
    }
    catch(\Exception $e)
    {
      self::log($e);

      return true;
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 设置密码尝试数据
   * ------------------------------------------
   *
   * 在用户输入密码错误后，进行尝试次数记录
   *
   * @param object $request 用户信息
   */
  public static function setTryNumber($request)
  {
    try
    {
      $request->increment('try_number');
      $request->save();

      return true;
    }
    catch(\Exception $e)
    {
      self::log($e);

      return false;
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 生成密码
   * ------------------------------------------
   *
   * 生成密码 TODO： 后期修改进行加盐处理
   *
   * @param string $password 用户输入的密码
   * @return 加密的密码信息
   */
  public static function generate($password = Parameter::PASSWORD)
  {
    $salt = bin2hex(random_bytes(60));

    $options = [
      'cost' => 12,
    ];

    $password = password_hash($password, PASSWORD_BCRYPT, $options);

    return $password;
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 认证状态封装
   * ------------------------------------------
   *
   * 认证状态封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getCertificationStatusAttribute($value)
  {
    return MemberEnum::getCertificationStatus($value);
  }



  // 关联函数 ------------------------------------------------------


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 会员与机构关联表
   * ------------------------------------------
   *
   * 会员与机构关联表
   *
   * @return [关联对象]
   */
  public function organization()
  {
      return $this->belongsTo('App\Models\Common\Module\Organization\Organization', 'organization_id', 'id')
                  ->where(['status'=>1]);
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 关联到角色表
   * ------------------------------------------
   *
   * 关联到角色表
   *
   * @return [关联对象]
   */
  public function role()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Member\Role',
      'module_member_role_relevance',
      'user_id',
      'role_id'
    )->wherePivot('status', 1);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 关联用户与角色关联表
   * ------------------------------------------
   *
   * 关联用户与角色关联表，用于删除
   *
   * @return [关联对象]
   */
  public function relevance()
  {
      return $this->hasMany('App\Models\Common\Module\Member\Relevance\MemberRoleRelevance', 'user_id', 'id')
                  ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 会员与会员档案关联表
   * ------------------------------------------
   *
   * 会员与会员档案关联表
   *
   * @return [关联对象]
   */
  public function archive()
  {
      return $this->hasOne('App\Models\Common\Module\Member\Archive', 'member_id', 'id')
                  ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 会员与会员认证关联表
   * ------------------------------------------
   *
   * 会员与会员认证关联表
   *
   * @return [关联对象]
   */
  public function certificate()
  {
      return $this->hasOne('App\Models\Common\Module\Member\Certificate', 'member_id', 'id')
                  ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 会员与会员学习课程关联表
   * ------------------------------------------
   *
   * 会员与会员学习课程关联表
   *
   * @return [关联对象]
   */
  public function course()
  {
      return $this->hasMany('App\Models\Common\Module\Member\Relevance\MemberCourseRelevance', 'member_id', 'id')
                  ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 会员与会员评论关联表
   * ------------------------------------------
   *
   * 会员与会员评论关联表
   *
   * @return [关联对象]
   */
  public function comment()
  {
    return $this->hasMany('App\Models\Common\Module\Member\Comment', 'member_id', 'id')
                ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 会员与作业关联表
   * ------------------------------------------
   *
   * 会员与作业关联表
   *
   * @return [关联对象]
   */
  public function homeworkRelevance()
  {
      return $this->hasMany('App\Models\Common\Module\Member\Homework\Homework', 'member_id', 'id')
                  ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 关联到课程
   * ------------------------------------------
   *
   * 关联到课程
   *
   * @return [关联对象]
   */
  public function educationCourse()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Education\Course\Course',
      'module_member_course_relevance',
      'member_id',
      'course_id'
    )->wherePivot('status', 1);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 学员与班级关联函数
   * ------------------------------------------
   *
   * 学员与班级关联函数
   *
   * @return [关联对象]
   */
  public function squad()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Organization\Squad\Squad',
      'module_squad_member_relevance',
      'member_id',
      'squad_id'
    )->wherePivot('status', 1);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 学员与班级关联函数
   * ------------------------------------------
   *
   * 学员与班级关联函数
   *
   * @return [关联对象]
   */
  public function squadRelevance()
  {
      return $this->hasMany('App\Models\Common\Module\Organization\Squad\Relevance\Member', 'member_id', 'id')
                  ->where(['status'=>1]);
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 关联到课程
   * ------------------------------------------
   *
   * 关联到课程
   *
   * @return [关联对象]
   */
  public function paper()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Education\Paper\Paper',
      'module_member_paper_relevance',
      'member_id',
      'paper_id'
    )->wherePivot('status', 1);
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 会员与考试关联表
   * ------------------------------------------
   *
   * 会员与考试关联表
   *
   * @return [关联对象]
   */
  public function paperRelevance()
  {
      return $this->hasMany('App\Models\Common\Module\Member\Paper\Paper', 'member_id', 'id')
                  ->where(['status'=>1]);
  }




  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 会有与消息关联表
   * ------------------------------------------
   *
   * 会有与消息关联表
   *
   * @return [关联对象]
   */
  public function message()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Message\Message',
      'module_member_message_relevance',
      'member_id',
      'message_id'
    )->wherePivot('status', 1);
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 会员与会员学习课程关联表
   * ------------------------------------------
   *
   * 会员与会员学习课程关联表
   *
   * @return [关联对象]
   */
  public function courseStudy()
  {
      return $this->hasMany('App\Models\Common\Module\Member\Relevance\MemberCourseRelevance', 'member_id', 'id')
                  ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 学员与课程学习进度关联表
   * ------------------------------------------
   *
   * 学员与课程学习进度关联表
   *
   * @return [关联对象]
   */
  public function courseProgress()
  {
      return $this->hasMany('App\Models\Common\Module\Member\Study\Progress\Course', 'member_id', 'id')
                  ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 学员与课程单元学习进度关联表
   * ------------------------------------------
   *
   * 学员与课程单元学习进度关联表
   *
   * @return [关联对象]
   */
  public function unitProgress()
  {
      return $this->hasMany('App\Models\Common\Module\Member\Study\Progress\Unit', 'member_id', 'id')
                  ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 学员与课程单元知识点学习进度关联表
   * ------------------------------------------
   *
   * 学员与课程单元知识点学习进度关联表
   *
   * @return [关联对象]
   */
  public function pointProgress()
  {
      return $this->hasMany('App\Models\Common\Module\Member\Study\Progress\Point', 'member_id', 'id')
                  ->where(['status'=>1]);
  }
}
