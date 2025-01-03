define({ "api": [
  {
    "type": "get",
    "url": "/api/system/data",
    "title": "2. 首页统计数据",
    "description": "<p>获取首页统计数据</p>",
    "group": "01._系统模块",
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "online",
            "description": "<p>在线学习人数</p>"
          },
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "member",
            "description": "<p>系统会员总数</p>"
          },
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "organization",
            "description": "<p>系统入住机构数</p>"
          },
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "subsidy",
            "description": "<p>政策性补贴人数</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/system/data"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/SystemController.php",
    "groupTitle": "01._系统模块",
    "name": "GetApiSystemData"
  },
  {
    "type": "get",
    "url": "/api/system/kernel",
    "title": "1. 系统配置信息",
    "description": "<p>获取系统配置信息</p>",
    "group": "01._系统模块",
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "web_chinese_name",
            "description": "<p>网站中文名称</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "web_english_name",
            "description": "<p>网站英文名字</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "web_url",
            "description": "<p>站点链接</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "keywords",
            "description": "<p>网站关键字</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>网站描述</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "logo",
            "description": "<p>网站logo</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "mobile",
            "description": "<p>公司电话</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>公司邮箱</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "copyright",
            "description": "<p>备案号</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "web_status",
            "description": "<p>站点状态</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "web_close_info",
            "description": "<p>站点关闭原因</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "contact_mobile",
            "description": "<p>联系电话</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "qr_code",
            "description": "<p>二维码</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/system/kernel"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/SystemController.php",
    "groupTitle": "01._系统模块",
    "name": "GetApiSystemKernel"
  },
  {
    "type": "post",
    "url": "/api/file/answer",
    "title": "3. 上传答案",
    "description": "<p>上传答案（图片、视频、音频）</p>",
    "group": "02._上传模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "file",
            "description": "<p>图片数据</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/file/answer"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/FileController.php",
    "groupTitle": "02._上传模块",
    "name": "PostApiFileAnswer"
  },
  {
    "type": "post",
    "url": "/api/file/avatar",
    "title": "1. 上传头像",
    "description": "<p>上传头像</p>",
    "group": "02._上传模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "file",
            "description": "<p>图片数据</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/file/avatar"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/FileController.php",
    "groupTitle": "02._上传模块",
    "name": "PostApiFileAvatar"
  },
  {
    "type": "post",
    "url": "/api/file/business_license",
    "title": "5. 上传营业执照",
    "description": "<p>上传营业执照</p>",
    "group": "02._上传模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "file",
            "description": "<p>营业执照数据</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/file/business_license"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/FileController.php",
    "groupTitle": "02._上传模块",
    "name": "PostApiFileBusiness_license"
  },
  {
    "type": "post",
    "url": "/api/file/file",
    "title": "4. 上传文件",
    "description": "<p>上传图片</p>",
    "group": "02._上传模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "file",
            "description": "<p>文件数据</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/file/file"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/FileController.php",
    "groupTitle": "02._上传模块",
    "name": "PostApiFileFile"
  },
  {
    "type": "post",
    "url": "/api/file/picture",
    "title": "2. 上传图片（非答案）",
    "description": "<p>上传图片（非答案）</p>",
    "group": "02._上传模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "file",
            "description": "<p>图片数据</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/file/picture"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/FileController.php",
    "groupTitle": "02._上传模块",
    "name": "PostApiFilePicture"
  },
  {
    "type": "get",
    "url": "/api/common/type/course",
    "title": "获取课程类型列表",
    "description": "<p>获取课程类型列表</p>",
    "group": "03._公共模块",
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "value",
            "description": "<p>类型值</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "text",
            "description": "<p>类型内容</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/common/type/course"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/TypeController.php",
    "groupTitle": "03._公共模块",
    "name": "GetApiCommonTypeCourse"
  },
  {
    "type": "post",
    "url": "/api/common/area/list",
    "title": "1. 获取地区列表",
    "description": "<p>获取省市县地区列表</p>",
    "group": "03._公共模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "parent_id",
            "description": "<p>上级地区编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>地区编号</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "parent_id",
            "description": "<p>上级编号</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>地区名字</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/common/area/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/AreaController.php",
    "groupTitle": "03._公共模块",
    "name": "PostApiCommonAreaList"
  },
  {
    "type": "get",
    "url": "/api/check_user_login",
    "title": "4. 是否已经登录",
    "description": "<p>检测当前用户是否已经登录</p>",
    "group": "04._登录模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/check_user_login"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "04._登录模块",
    "name": "GetApiCheck_user_login"
  },
  {
    "type": "get",
    "url": "/api/logout",
    "title": "5. 用户退出",
    "description": "<p>用户退出系统</p>",
    "group": "04._登录模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/logout"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "04._登录模块",
    "name": "GetApiLogout"
  },
  {
    "type": "post",
    "url": "/api/login",
    "title": "1.用户密码登录",
    "description": "<p>通过用户与密码进行系统登录</p>",
    "group": "04._登录模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户（18201018926）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": "<p>登录密码（123456）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/login"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "04._登录模块",
    "name": "PostApiLogin"
  },
  {
    "type": "post",
    "url": "/api/sms_code",
    "title": "3. 登录验证码",
    "description": "<p>获取手机登录验证码</p>",
    "group": "04._登录模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户（18201018926）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/sms_code"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "04._登录模块",
    "name": "PostApiSms_code"
  },
  {
    "type": "post",
    "url": "/api/sms_login",
    "title": "2. 手机验证码登录",
    "description": "<p>通过手机短信验证码进行系统登录</p>",
    "group": "04._登录模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户（18201018926）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sms_code",
            "description": "<p>短信验证码（123456）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/sms_login"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "04._登录模块",
    "name": "PostApiSms_login"
  },
  {
    "type": "post",
    "url": "/api/weixin_login",
    "title": "6. 第三方登录-微信",
    "description": "<p>第三方登录-微信</p>",
    "group": "04._登录模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户（18201018926）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sms_code",
            "description": "<p>短信验证码（123456）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/weixin_login"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "04._登录模块",
    "name": "PostApiWeixin_login"
  },
  {
    "type": "post",
    "url": "/api/member/register",
    "title": "3. 注册会员",
    "description": "<p>注册会员</p>",
    "group": "05._注册模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号（为空：新增，不为空：编辑）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "role_id",
            "description": "<p>角色 1 机构管理员 3 学员（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户（手机号码, 不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": "<p>密码（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password_confirmation",
            "description": "<p>确认密码（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sms_code",
            "description": "<p>验证码（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>会员邮箱（可以为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/register"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/RegisterController.php",
    "groupTitle": "05._注册模块",
    "name": "PostApiMemberRegister"
  },
  {
    "type": "post",
    "url": "/api/member/register_first_step",
    "title": "4. 注册步骤一",
    "description": "<p>注册会员</p>",
    "group": "05._注册模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号（为空：新增，不为空：编辑）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "role_id",
            "description": "<p>角色 1 机构管理员 3 学员（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户（手机号码, 不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sms_code",
            "description": "<p>验证码（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>会员邮箱（可以为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/register_first_step"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/RegisterController.php",
    "groupTitle": "05._注册模块",
    "name": "PostApiMemberRegister_first_step"
  },
  {
    "type": "post",
    "url": "/api/member/register_second_step",
    "title": "5. 注册步骤二",
    "description": "<p>注册会员</p>",
    "group": "05._注册模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": "<p>密码（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password_confirmation",
            "description": "<p>确认密码（不能为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/register_second_step"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/RegisterController.php",
    "groupTitle": "05._注册模块",
    "name": "PostApiMemberRegister_second_step"
  },
  {
    "type": "post",
    "url": "/api/member/sms_code",
    "title": "1. 获取注册验证码",
    "description": "<p>获取注册验证码</p>",
    "group": "05._注册模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>注册账户（18201018926）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/sms_code"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/RegisterController.php",
    "groupTitle": "05._注册模块",
    "name": "PostApiMemberSms_code"
  },
  {
    "type": "post",
    "url": "/api/member/validation_code",
    "title": "2. 验证注册验证码",
    "description": "<p>验证注册验证码</p>",
    "group": "05._注册模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>注册账户（18201018926）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sms_code",
            "description": "<p>验证码（不能为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/validation_code"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/RegisterController.php",
    "groupTitle": "05._注册模块",
    "name": "PostApiMemberValidation_code"
  },
  {
    "type": "get",
    "url": "/api/member/archive/{id}",
    "title": "获取会员档案",
    "description": "<p>获取会员档案</p>",
    "group": "06._会员模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/archive"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "06._会员模块",
    "name": "GetApiMemberArchiveId"
  },
  {
    "type": "get",
    "url": "/api/member/director",
    "title": "获取机构班主任列表(不分页)",
    "description": "<p>获取机构班主任列表(不分页)</p>",
    "group": "06._会员模块",
    "sampleRequest": [
      {
        "url": "/api/member/director"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "06._会员模块",
    "name": "GetApiMemberDirector"
  },
  {
    "type": "get",
    "url": "/api/member/teacher",
    "title": "获取机构老师列表(不分页)",
    "description": "<p>获取机构老师列表(不分页)</p>",
    "group": "06._会员模块",
    "sampleRequest": [
      {
        "url": "/api/member/teacher"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "06._会员模块",
    "name": "GetApiMemberTeacher"
  },
  {
    "type": "get",
    "url": "/api/member/user_info",
    "title": "获取会员信息",
    "description": "<p>获取会员信息</p>",
    "group": "06._会员模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/user_info"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "06._会员模块",
    "name": "GetApiMemberUser_info"
  },
  {
    "type": "get",
    "url": "/api/member/view/{id}",
    "title": "获取会员详情",
    "description": "<p>获取会员详情</p>",
    "group": "06._会员模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "06._会员模块",
    "name": "GetApiMemberViewId"
  },
  {
    "type": "post",
    "url": "/api/member/back_email",
    "title": "通过邮箱码找回",
    "description": "<p>通过邮箱码找回</p>",
    "group": "06._会员模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>会员邮箱</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sms_code",
            "description": "<p>验证码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": "<p>新密码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password_confirmation",
            "description": "<p>确认密码</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/back_email"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "06._会员模块",
    "name": "PostApiMemberBack_email"
  },
  {
    "type": "post",
    "url": "/api/member/back_mobile",
    "title": "通过手机号码找回",
    "description": "<p>通过手机号码找回</p>",
    "group": "06._会员模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>登录手机号码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sms_code",
            "description": "<p>验证码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": "<p>新密码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password_confirmation",
            "description": "<p>确认密码</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/back_mobile"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "06._会员模块",
    "name": "PostApiMemberBack_mobile"
  },
  {
    "type": "post",
    "url": "/api/member/certification",
    "title": "会员认证",
    "description": "<p>对当前会员进行认证</p>",
    "group": "06._会员模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "realname",
            "description": "<p>真实姓名（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "id_card_no",
            "description": "<p>身份证号（不能为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/certification"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "06._会员模块",
    "name": "PostApiMemberCertification"
  },
  {
    "type": "post",
    "url": "/api/member/change_code",
    "title": "获取账户更换验证码",
    "description": "<p>获取账户更换验证码</p>",
    "group": "06._会员模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户（18201018888）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/change_code"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "06._会员模块",
    "name": "PostApiMemberChange_code"
  },
  {
    "type": "post",
    "url": "/api/member/change_username",
    "title": "更换账户",
    "description": "<p>更换账户手机号码</p>",
    "group": "06._会员模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>账户手机号码（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sms_code",
            "description": "<p>验证码（不能为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/change_username"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "06._会员模块",
    "name": "PostApiMemberChange_username"
  },
  {
    "type": "post",
    "url": "/api/member/delete",
    "title": "会员删除",
    "description": "<p>会员删除</p>",
    "group": "06._会员模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/delete"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "06._会员模块",
    "name": "PostApiMemberDelete"
  },
  {
    "type": "post",
    "url": "/api/member/email_code",
    "title": "获取邮件验证码",
    "description": "<p>获取邮件验证码</p>",
    "group": "06._会员模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>email（1326336909@qq.com）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/email_code"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "06._会员模块",
    "name": "PostApiMemberEmail_code"
  },
  {
    "type": "post",
    "url": "/api/member/generate",
    "title": "生成班主任",
    "description": "<p>生成班主任</p>",
    "group": "06._会员模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>班主任电话</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "nickname",
            "description": "<p>班主任姓名</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/generate"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "06._会员模块",
    "name": "PostApiMemberGenerate"
  },
  {
    "type": "post",
    "url": "/api/member/handle",
    "title": "编辑会员信息",
    "description": "<p>编辑会员信息</p>",
    "group": "06._会员模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "mobile",
            "description": "<p>手机号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>邮箱号（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "realname",
            "description": "<p>姓名（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sex",
            "description": "<p>性别（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "province_id",
            "description": "<p>省（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "city_id",
            "description": "<p>市（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "region_id",
            "description": "<p>县（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "age",
            "description": "<p>年龄（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "weixin",
            "description": "<p>微信号（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "address",
            "description": "<p>详细地址（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "work_address",
            "description": "<p>工作地址（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "json",
            "optional": false,
            "field": "example",
            "description": "<p>{&quot;id&quot;:9,&quot;mobile&quot;:&quot;18201018926&quot;,&quot;avatar&quot;:&quot;http://localhost:8070/storage/mavon/2020-10-21/6bb4a5bd356378971a97603a8ee33cbb.jpg&quot;,&quot;nickname&quot;:&quot;赵大宝&quot;,&quot;email&quot;:&quot;1326336909@qq.com&quot;,&quot;realname&quot;:&quot;赵二宝&quot;,&quot;sex&quot;:1,&quot;province_id&quot;:&quot;140000&quot;,&quot;city_id&quot;:&quot;140100&quot;,&quot;region_id&quot;:&quot;140105&quot;,&quot;age&quot;:28,&quot;weixin&quot;:&quot;654321&quot;,&quot;address&quot;:&quot;北京市昌平区&quot;,&quot;work_address&quot;:&quot;北京市昌平区&quot;}</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "06._会员模块",
    "name": "PostApiMemberHandle"
  },
  {
    "type": "post",
    "url": "/api/member/password",
    "title": "修改当前用户的密码",
    "description": "<p>修改当前用户的密码</p>",
    "group": "06._会员模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "old_password",
            "description": "<p>旧密码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": "<p>新密码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password_confirmation",
            "description": "<p>确认密码</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/password"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "06._会员模块",
    "name": "PostApiMemberPassword"
  },
  {
    "type": "post",
    "url": "/api/member/reset_code",
    "title": "获取重置验证码",
    "description": "<p>获取重置验证码</p>",
    "group": "06._会员模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户（18201018888）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/reset_code"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "06._会员模块",
    "name": "PostApiMemberReset_code"
  },
  {
    "type": "post",
    "url": "/api/member/role",
    "title": "变成角色",
    "description": "<p>变成角色</p>",
    "group": "06._会员模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "role_id",
            "description": "<p>角色编号 2 老师 3 学生（不能为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/role"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "06._会员模块",
    "name": "PostApiMemberRole"
  },
  {
    "type": "post",
    "url": "/api/member/status",
    "title": "变更会员状态",
    "description": "<p>变更会员状态</p>",
    "group": "06._会员模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "status",
            "description": "<p>状态 1 正常 2 禁用（不能为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/status"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "06._会员模块",
    "name": "PostApiMemberStatus"
  },
  {
    "type": "get",
    "url": "/api/signature/list?page={page}",
    "title": "1. 当前用户签到列表(分页)",
    "description": "<p>获取当前用户签到列表(分页)</p>",
    "group": "07._签到模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Signature/SignatureController.php",
    "groupTitle": "07._签到模块",
    "name": "GetApiSignatureListPagePage"
  },
  {
    "type": "get",
    "url": "/api/signature/select",
    "title": "2. 当前用户签到列表(不分页)",
    "description": "<p>获取当前用户签到列表(不分页)</p>",
    "group": "07._签到模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/signature/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Signature/SignatureController.php",
    "groupTitle": "07._签到模块",
    "name": "GetApiSignatureSelect"
  },
  {
    "type": "get",
    "url": "/api/signature/status",
    "title": "5. 今天是否签到",
    "description": "<p>获取当前用户今天是否签到</p>",
    "group": "07._签到模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/signature/status"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Signature/SignatureController.php",
    "groupTitle": "07._签到模块",
    "name": "GetApiSignatureStatus"
  },
  {
    "type": "get",
    "url": "/api/signature/view/{id}",
    "title": "3. 当前用户签到详情",
    "description": "<p>获取当前用户签到详情</p>",
    "group": "07._签到模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/signature/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Signature/SignatureController.php",
    "groupTitle": "07._签到模块",
    "name": "GetApiSignatureViewId"
  },
  {
    "type": "post",
    "url": "/api/signature/handle",
    "title": "4. 签到操作",
    "description": "<p>会员登录进行签到</p>",
    "group": "07._签到模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sign_ip_address",
            "description": "<p>客户端IP地址（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "equipment",
            "description": "<p>客户端设备信息 1 PC端  2 移动端（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "system",
            "description": "<p>客户端系统信息（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "browser",
            "description": "<p>客户端浏览器信息（可以为空）</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Signature/SignatureController.php",
    "groupTitle": "07._签到模块",
    "name": "PostApiSignatureHandle"
  },
  {
    "type": "get",
    "url": "/api/keyword/list?page={page}",
    "title": "1. 热门关键字列表(分页)",
    "description": "<p>获取当前用户热门关键字列表(分页)</p>",
    "group": "08._热门关键字模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Keyword/KeywordController.php",
    "groupTitle": "08._热门关键字模块",
    "name": "GetApiKeywordListPagePage"
  },
  {
    "type": "get",
    "url": "/api/keyword/select",
    "title": "2. 热门关键字列表(不分页)",
    "description": "<p>获取当前用户热门关键字列表(不分页)</p>",
    "group": "08._热门关键字模块",
    "sampleRequest": [
      {
        "url": "/api/keyword/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Keyword/KeywordController.php",
    "groupTitle": "08._热门关键字模块",
    "name": "GetApiKeywordSelect"
  },
  {
    "type": "get",
    "url": "/api/advertising/course",
    "title": "6. 获取课程广告列表",
    "description": "<p>获取课程广告列表(不分页)</p>",
    "group": "10._广告模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "广告字段说明": [
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>广告编号</p>"
          },
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>广告名称</p>"
          },
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "link",
            "description": "<p>广告跳转链接</p>"
          },
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>广告图片</p>"
          },
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>广告资源（音频、视频）</p>"
          }
        ],
        "广告位字段说明": [
          {
            "group": "广告位字段说明",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>广告位编号</p>"
          },
          {
            "group": "广告位字段说明",
            "type": "String",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "广告位字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>广告位名称</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/advertising/course"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Advertising/AdvertisingController.php",
    "groupTitle": "10._广告模块",
    "name": "GetApiAdvertisingCourse"
  },
  {
    "type": "get",
    "url": "/api/advertising/list?page={page}",
    "title": "1. 获取广告列表(分页)",
    "description": "<p>获取广告列表(分页)</p>",
    "group": "10._广告模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "location_id",
            "description": "<p>广告类型 1 首页轮播图 4 课程学习页广告 5 技能超市页广告</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Advertising/AdvertisingController.php",
    "groupTitle": "10._广告模块",
    "name": "GetApiAdvertisingListPagePage"
  },
  {
    "type": "get",
    "url": "/api/advertising/login",
    "title": "5. 获取登录页广告",
    "description": "<p>获取登录页广告</p>",
    "group": "10._广告模块",
    "success": {
      "fields": {
        "广告字段说明": [
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>广告编号</p>"
          },
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>广告名称</p>"
          },
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "link",
            "description": "<p>广告跳转链接</p>"
          },
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>广告图片</p>"
          },
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>广告资源（音频、视频）</p>"
          }
        ],
        "广告位字段说明": [
          {
            "group": "广告位字段说明",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>广告位编号</p>"
          },
          {
            "group": "广告位字段说明",
            "type": "String",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "广告位字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>广告位名称</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/advertising/login"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Advertising/AdvertisingController.php",
    "groupTitle": "10._广告模块",
    "name": "GetApiAdvertisingLogin"
  },
  {
    "type": "get",
    "url": "/api/advertising/select",
    "title": "2. 获取广告列表(不分页)",
    "description": "<p>获取广告列表(不分页)</p>",
    "group": "10._广告模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "location_id",
            "description": "<p>广告类型 1 首页轮播图 4 课程学习页广告 5 技能超市页广告</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "广告字段说明": [
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>广告编号</p>"
          },
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>广告名称</p>"
          },
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "link",
            "description": "<p>广告跳转链接</p>"
          },
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>广告图片</p>"
          },
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>广告资源（音频、视频）</p>"
          }
        ],
        "广告位字段说明": [
          {
            "group": "广告位字段说明",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>广告位编号</p>"
          },
          {
            "group": "广告位字段说明",
            "type": "String",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "广告位字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>广告位名称</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/advertising/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Advertising/AdvertisingController.php",
    "groupTitle": "10._广告模块",
    "name": "GetApiAdvertisingSelect"
  },
  {
    "type": "get",
    "url": "/api/advertising/video",
    "title": "4. 获取视频广告",
    "description": "<p>获取视频广告</p>",
    "group": "10._广告模块",
    "success": {
      "fields": {
        "广告字段说明": [
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>广告编号</p>"
          },
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>广告名称</p>"
          },
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "link",
            "description": "<p>广告跳转链接</p>"
          },
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>广告图片</p>"
          },
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>广告资源（音频、视频）</p>"
          }
        ],
        "广告位字段说明": [
          {
            "group": "广告位字段说明",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>广告位编号</p>"
          },
          {
            "group": "广告位字段说明",
            "type": "String",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "广告位字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>广告位名称</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/advertising/video"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Advertising/AdvertisingController.php",
    "groupTitle": "10._广告模块",
    "name": "GetApiAdvertisingVideo"
  },
  {
    "type": "get",
    "url": "/api/advertising/view/{id}",
    "title": "3. 获取广告详情",
    "description": "<p>获取广告详情</p>",
    "group": "10._广告模块",
    "success": {
      "fields": {
        "广告字段说明": [
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>广告编号</p>"
          },
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>广告名称</p>"
          },
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "link",
            "description": "<p>广告跳转链接</p>"
          },
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>广告图片</p>"
          },
          {
            "group": "广告字段说明",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>广告资源（音频、视频）</p>"
          }
        ],
        "广告位字段说明": [
          {
            "group": "广告位字段说明",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>广告位编号</p>"
          },
          {
            "group": "广告位字段说明",
            "type": "String",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "广告位字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>广告位名称</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/advertising/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Advertising/AdvertisingController.php",
    "groupTitle": "10._广告模块",
    "name": "GetApiAdvertisingViewId"
  },
  {
    "type": "get",
    "url": "/api/education/course/experience/view/{id}",
    "title": "01. 课程体验信息",
    "description": "<p>根据课程编号获取课程体验信息</p>",
    "group": "22._课程体验模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>课程编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>体验内容</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/experience/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/ExperienceController.php",
    "groupTitle": "22._课程体验模块",
    "name": "GetApiEducationCourseExperienceViewId"
  },
  {
    "type": "get",
    "url": "/api/me",
    "title": "7. 获取登录用户信息",
    "description": "<p>获取登录用户信息</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/me"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "Auth",
    "name": "GetApiMe"
  },
  {
    "type": "get",
    "url": "/api/member/homework/list?page={page}",
    "title": "获取当前用户作业列表(分页)",
    "description": "<p>获取当前用户作业列表(分页)</p>",
    "group": "会员作业模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "point_id",
            "description": "<p>知识点编号（可以为空）</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Homework/HomeworkController.php",
    "groupTitle": "会员作业模块",
    "name": "GetApiMemberHomeworkListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/homework/select",
    "title": "获取当前用户作业列表(不分页)",
    "description": "<p>获取当前用户作业列表(不分页)</p>",
    "group": "会员作业模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "point_id",
            "description": "<p>知识点编号（可以为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/homework/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Homework/HomeworkController.php",
    "groupTitle": "会员作业模块",
    "name": "GetApiMemberHomeworkSelect"
  },
  {
    "type": "get",
    "url": "/api/member/homework/view/{id}",
    "title": "获取当前用户作业详情",
    "description": "<p>获取当前用户作业详情</p>",
    "group": "会员作业模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/homework/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Homework/HomeworkController.php",
    "groupTitle": "会员作业模块",
    "name": "GetApiMemberHomeworkViewId"
  },
  {
    "type": "post",
    "url": "/api/member/homework/correct",
    "title": "批改作业",
    "description": "<p>批改作业</p>",
    "group": "会员作业模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "homework_id",
            "description": "<p>作业编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "result",
            "description": "<p>作业是否正确 1 正确 2 错误（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "remark",
            "description": "<p>作业批注（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "json",
            "optional": false,
            "field": "example",
            "description": "<p>{&quot;homework_id&quot;:&quot;5&quot;,&quot;result&quot;:1,&quot;remark&quot;:&quot;回到的很不错&quot;}</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Homework/HomeworkController.php",
    "groupTitle": "会员作业模块",
    "name": "PostApiMemberHomeworkCorrect"
  },
  {
    "type": "post",
    "url": "/api/member/homework/handle",
    "title": "写作业",
    "description": "<p>写作业</p>",
    "group": "会员作业模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "homework_id",
            "description": "<p>作业编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "answer",
            "description": "<p>作业答案（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "array",
            "optional": false,
            "field": "attachment",
            "description": "<p>附件地址数组（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "json",
            "optional": false,
            "field": "example",
            "description": "<p>{&quot;homework_id&quot;:&quot;5&quot;,&quot;answer&quot;:&quot;31231313212312312313&quot;,&quot;attachment&quot;:[{&quot;title&quot;:&quot;111&quot;,&quot;url&quot;:&quot;www.qiansha&quot;},{&quot;title&quot;:&quot;222&quot;,&quot;url&quot;:&quot;www.xiechengfuwu.com&quot;},{&quot;title&quot;:&quot;333&quot;,&quot;url&quot;:&quot;www.baidu.com&quot;}]}</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Homework/HomeworkController.php",
    "groupTitle": "会员作业模块",
    "name": "PostApiMemberHomeworkHandle"
  },
  {
    "type": "get",
    "url": "/api/member/study/center",
    "title": "获取会员学习中心信息",
    "description": "<p>获取会员学习中心信息</p>",
    "group": "会员学习中心模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/study/center"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Study/StudyController.php",
    "groupTitle": "会员学习中心模块",
    "name": "GetApiMemberStudyCenter"
  },
  {
    "type": "get",
    "url": "/api/member/study/is_first",
    "title": "是否时第一次学习",
    "description": "<p>是否时第一次学习</p>",
    "group": "会员学习中心模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "unit_id",
            "description": "<p>单元编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "point_id",
            "description": "<p>知识点编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/study/is_first"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Study/StudyController.php",
    "groupTitle": "会员学习中心模块",
    "name": "GetApiMemberStudyIs_first"
  },
  {
    "type": "post",
    "url": "/api/member/study/already_study_time",
    "title": "已学完时间点",
    "description": "<p>记录当前学员单个知识点已学完时间点</p>",
    "group": "会员学习中心模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "unit_id",
            "description": "<p>单元编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "point_id",
            "description": "<p>知识点编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "time",
            "description": "<p>当前已学完时间点（时间戳）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/study/already_study_time"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Study/StudyController.php",
    "groupTitle": "会员学习中心模块",
    "name": "PostApiMemberStudyAlready_study_time"
  },
  {
    "type": "post",
    "url": "/api/member/study/end_study",
    "title": "结束学习",
    "description": "<p>结束学习</p>",
    "group": "会员学习中心模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "unit_id",
            "description": "<p>单元编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/study/end_study"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Study/StudyController.php",
    "groupTitle": "会员学习中心模块",
    "name": "PostApiMemberStudyEnd_study"
  },
  {
    "type": "post",
    "url": "/api/member/study/finish",
    "title": "完成知识点学习",
    "description": "<p>完成知识点学习</p>",
    "group": "会员学习中心模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "unit_id",
            "description": "<p>单元编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "point_id",
            "description": "<p>知识点编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/study/finish"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Study/StudyController.php",
    "groupTitle": "会员学习中心模块",
    "name": "PostApiMemberStudyFinish"
  },
  {
    "type": "post",
    "url": "/api/member/study/point_study",
    "title": "知识点学习",
    "description": "<p>知识点学习</p>",
    "group": "会员学习中心模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "unit_id",
            "description": "<p>单元编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "point_id",
            "description": "<p>单元编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "start_time",
            "description": "<p>结束时间</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "end_time",
            "description": "<p>结束时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/study/point_study"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Study/StudyController.php",
    "groupTitle": "会员学习中心模块",
    "name": "PostApiMemberStudyPoint_study"
  },
  {
    "type": "post",
    "url": "/api/member/study/start_study",
    "title": "开始学习",
    "description": "<p>开始学习</p>",
    "group": "会员学习中心模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "unit_id",
            "description": "<p>单元编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "is_first",
            "description": "<p>第一次点击</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/study/start_study"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Study/StudyController.php",
    "groupTitle": "会员学习中心模块",
    "name": "PostApiMemberStudyStart_study"
  },
  {
    "type": "get",
    "url": "/api/member/study/progress/course/list",
    "title": "获取会员学习课程进度信息",
    "description": "<p>获取会员学习课程进度信息</p>",
    "group": "会员学习进度模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/study/progress/course/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Study/Progress/CourseController.php",
    "groupTitle": "会员学习进度模块",
    "name": "GetApiMemberStudyProgressCourseList"
  },
  {
    "type": "get",
    "url": "/api/member/study/progress/course/unit/list",
    "title": "获取会员学习课程单元进度信息",
    "description": "<p>获取会员学习课程单元进度信息</p>",
    "group": "会员学习进度模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "parent_id",
            "description": "<p>上级单元编号（顶级单元，传0）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/study/progress/course/unit/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Study/Progress/UnitController.php",
    "groupTitle": "会员学习进度模块",
    "name": "GetApiMemberStudyProgressCourseUnitList"
  },
  {
    "type": "get",
    "url": "/api/member/study/progress/course/unit/point/list",
    "title": "获取会员学习课程单元知识点进度信息",
    "description": "<p>获取会员学习课程单元知识点进度信息</p>",
    "group": "会员学习进度模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "unit_id",
            "description": "<p>单元编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/study/progress/course/unit/point/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Study/Progress/PointController.php",
    "groupTitle": "会员学习进度模块",
    "name": "GetApiMemberStudyProgressCourseUnitPointList"
  },
  {
    "type": "get",
    "url": "/api/member/grade/center",
    "title": "获取会员成绩中心信息",
    "description": "<p>获取会员成绩中心信息</p>",
    "group": "会员成绩中心模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/grade/center"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Grade/GradeController.php",
    "groupTitle": "会员成绩中心模块",
    "name": "GetApiMemberGradeCenter"
  },
  {
    "type": "get",
    "url": "/api/member/grade/class_after_question",
    "title": "获取课后练习题信息",
    "description": "<p>获取课后练习题信息</p>",
    "group": "会员成绩中心模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/grade/class_after_question"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Grade/GradeController.php",
    "groupTitle": "会员成绩中心模块",
    "name": "GetApiMemberGradeClass_after_question"
  },
  {
    "type": "get",
    "url": "/api/member/grade/class_after_question_detail",
    "title": "课后练习题详情",
    "description": "<p>获取课后练习题详情信息</p>",
    "group": "会员成绩中心模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/grade/class_after_question_detail"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Grade/GradeController.php",
    "groupTitle": "会员成绩中心模块",
    "name": "GetApiMemberGradeClass_after_question_detail"
  },
  {
    "type": "get",
    "url": "/api/member/grade/comprehensive_question",
    "title": "综合练习题信息",
    "description": "<p>获取综合练习题信息</p>",
    "group": "会员成绩中心模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/grade/comprehensive_question"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Grade/GradeController.php",
    "groupTitle": "会员成绩中心模块",
    "name": "GetApiMemberGradeComprehensive_question"
  },
  {
    "type": "get",
    "url": "/api/member/grade/comprehensive_question_detail",
    "title": "综合练习题详情",
    "description": "<p>获取综合练习题详情信息</p>",
    "group": "会员成绩中心模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/grade/comprehensive_question_detail"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Grade/GradeController.php",
    "groupTitle": "会员成绩中心模块",
    "name": "GetApiMemberGradeComprehensive_question_detail"
  },
  {
    "type": "get",
    "url": "/api/member/grade/simulation_exam",
    "title": "获取模拟试卷信息",
    "description": "<p>获取模拟试卷信息</p>",
    "group": "会员成绩中心模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/grade/simulation_exam"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Grade/GradeController.php",
    "groupTitle": "会员成绩中心模块",
    "name": "GetApiMemberGradeSimulation_exam"
  },
  {
    "type": "get",
    "url": "/api/member/message/list?page={page}",
    "title": "获取当前会员消息列表(分页)",
    "description": "<p>获取当前会员消息列表(分页)</p>",
    "group": "会员消息模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Message/MessageController.php",
    "groupTitle": "会员消息模块",
    "name": "GetApiMemberMessageListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/message/select",
    "title": "获取当前会员消息列表(不分页)",
    "description": "<p>获取当前会员消息列表(不分页)</p>",
    "group": "会员消息模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/message/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Message/MessageController.php",
    "groupTitle": "会员消息模块",
    "name": "GetApiMemberMessageSelect"
  },
  {
    "type": "get",
    "url": "/api/member/squad/list?page={page}",
    "title": "获取当前用户班级列表(分页)",
    "description": "<p>获取当前用户班级列表(分页)</p>",
    "group": "会员班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Squad/SquadController.php",
    "groupTitle": "会员班级模块",
    "name": "GetApiMemberSquadListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/squad/select",
    "title": "获取当前用户班级列表(不分页)",
    "description": "<p>获取当前用户班级列表(不分页)</p>",
    "group": "会员班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/squad/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Squad/SquadController.php",
    "groupTitle": "会员班级模块",
    "name": "GetApiMemberSquadSelect"
  },
  {
    "type": "get",
    "url": "/api/member/squad/view/{id}",
    "title": "获取当前用户班级详情",
    "description": "<p>获取当前用户班级详情</p>",
    "group": "会员班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/squad/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Squad/SquadController.php",
    "groupTitle": "会员班级模块",
    "name": "GetApiMemberSquadViewId"
  },
  {
    "type": "get",
    "url": "/api/member/point/list?page={page}",
    "title": "获取会员知识点列表(分页)",
    "description": "<p>获取会员知识点列表(分页)</p>",
    "group": "会员知识点模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Point/PointController.php",
    "groupTitle": "会员知识点模块",
    "name": "GetApiMemberPointListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/point/select",
    "title": "获取会员知识点列表(不分页)",
    "description": "<p>获取会员知识点列表(不分页)</p>",
    "group": "会员知识点模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/point/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Point/PointController.php",
    "groupTitle": "会员知识点模块",
    "name": "GetApiMemberPointSelect"
  },
  {
    "type": "get",
    "url": "/api/member/point/status/{point_id}",
    "title": "获取当前知识点是否被订阅",
    "description": "<p>获取当前知识点是否被订阅</p>",
    "group": "会员知识点模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/point/status/{point_id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Point/PointController.php",
    "groupTitle": "会员知识点模块",
    "name": "GetApiMemberPointStatusPoint_id"
  },
  {
    "type": "post",
    "url": "/api/member/point/handle",
    "title": "订购知识点",
    "description": "<p>会员登录进行笔记</p>",
    "group": "会员知识点模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "point_id",
            "description": "<p>知识点编号</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Point/PointController.php",
    "groupTitle": "会员知识点模块",
    "name": "PostApiMemberPointHandle"
  },
  {
    "type": "get",
    "url": "/api/member/note/list?page={page}",
    "title": "获取当前用户笔记列表(分页)",
    "description": "<p>获取当前用户笔记列表(分页)</p>",
    "group": "会员笔记模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "point_id",
            "description": "<p>知识点编号（可以为空）</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Note/NoteController.php",
    "groupTitle": "会员笔记模块",
    "name": "GetApiMemberNoteListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/note/select",
    "title": "获取当前用户笔记列表(不分页)",
    "description": "<p>获取当前用户笔记列表(不分页)</p>",
    "group": "会员笔记模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "point_id",
            "description": "<p>知识点编号（可以为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/note/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Note/NoteController.php",
    "groupTitle": "会员笔记模块",
    "name": "GetApiMemberNoteSelect"
  },
  {
    "type": "get",
    "url": "/api/member/note/view/{id}",
    "title": "获取当前用户笔记详情",
    "description": "<p>获取当前用户笔记详情</p>",
    "group": "会员笔记模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/note/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Note/NoteController.php",
    "groupTitle": "会员笔记模块",
    "name": "GetApiMemberNoteViewId"
  },
  {
    "type": "get",
    "url": "/api/member/paper/list?page={page}",
    "title": "获取用户笔记列表(分页)",
    "description": "<p>获取用户笔记列表(分页)</p>",
    "group": "会员笔记模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号（可以为空）</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Paper/PaperController.php",
    "groupTitle": "会员笔记模块",
    "name": "GetApiMemberPaperListPagePage"
  },
  {
    "type": "post",
    "url": "/api/member/note/handle",
    "title": "笔记操作",
    "description": "<p>会员登录进行笔记</p>",
    "group": "会员笔记模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "point_id",
            "description": "<p>课程知识点编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "content",
            "description": "<p>笔记内容</p>"
          },
          {
            "group": "Parameter",
            "type": "array",
            "optional": false,
            "field": "attachment",
            "description": "<p>附件地址数组（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "json",
            "optional": false,
            "field": "example",
            "description": "<p>{&quot;squad_id&quot;:&quot;1&quot;,&quot;course_id&quot;:&quot;5&quot;, &quot;point_id&quot;:&quot;5&quot;, &quot;content&quot;:&quot;321&quot;,&quot;attachment&quot;:[{&quot;title&quot;:&quot;111&quot;,&quot;url&quot;:&quot;www.qiansha&quot;},{&quot;title&quot;:&quot;222&quot;,&quot;url&quot;:&quot;www.xiechengfuwu.com&quot;},{&quot;title&quot;:&quot;333&quot;,&quot;url&quot;:&quot;www.baidu.com&quot;}]}</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Note/NoteController.php",
    "groupTitle": "会员笔记模块",
    "name": "PostApiMemberNoteHandle"
  },
  {
    "type": "get",
    "url": "/api/member/comment/list?page={page}",
    "title": "获取会员评论列表(分页)",
    "description": "<p>获取会员评论列表(分页)</p>",
    "group": "会员评论模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "appraiser_id",
            "description": "<p>评价人编号（可以为空）</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "description": "<p>学员编号</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "score",
            "description": "<p>评价分数</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "content",
            "description": "<p>评价内容</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "appraiser_id",
            "description": "<p>评价人</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "create_time",
            "description": "<p>评价时间</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Comment/CommentController.php",
    "groupTitle": "会员评论模块",
    "name": "GetApiMemberCommentListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/comment/select",
    "title": "获取会员评论列表(不分页)",
    "description": "<p>获取会员评论列表(不分页)</p>",
    "group": "会员评论模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "appraiser_id",
            "description": "<p>评价人编号（可以为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/comment/select"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "description": "<p>学员编号</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "score",
            "description": "<p>评价分数</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "content",
            "description": "<p>评价内容</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "appraiser_id",
            "description": "<p>评价人</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "create_time",
            "description": "<p>评价时间</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Comment/CommentController.php",
    "groupTitle": "会员评论模块",
    "name": "GetApiMemberCommentSelect"
  },
  {
    "type": "get",
    "url": "/api/member/comment/view/{id}",
    "title": "获取会员评论详情",
    "description": "<p>获取会员评论详情</p>",
    "group": "会员评论模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/comment/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Comment/CommentController.php",
    "groupTitle": "会员评论模块",
    "name": "GetApiMemberCommentViewId"
  },
  {
    "type": "post",
    "url": "/api/member/comment/delete",
    "title": "删除会员评论",
    "description": "<p>删除会员评论</p>",
    "group": "会员评论模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "id",
            "description": "<p>评论编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/comment/delete"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Comment/CommentController.php",
    "groupTitle": "会员评论模块",
    "name": "PostApiMemberCommentDelete"
  },
  {
    "type": "post",
    "url": "/api/member/comment/handle",
    "title": "评论操作",
    "description": "<p>评论操作</p>",
    "group": "会员评论模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "description": "<p>学员编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "score",
            "description": "<p>评价分数1-5（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "content",
            "description": "<p>评价内容（不能为空）</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Comment/CommentController.php",
    "groupTitle": "会员评论模块",
    "name": "PostApiMemberCommentHandle"
  },
  {
    "type": "get",
    "url": "/api/member/paper/select",
    "title": "获取用户试卷列表(不分页)",
    "description": "<p>获取用户试卷列表(不分页)</p>",
    "group": "会员试卷模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号（可以为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/paper/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Paper/PaperController.php",
    "groupTitle": "会员试卷模块",
    "name": "GetApiMemberPaperSelect"
  },
  {
    "type": "get",
    "url": "/api/member/paper/view/{id}",
    "title": "获取当前用户试卷详情",
    "description": "<p>获取用户试卷详情</p>",
    "group": "会员试卷模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/paper/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Paper/PaperController.php",
    "groupTitle": "会员试卷模块",
    "name": "GetApiMemberPaperViewId"
  },
  {
    "type": "post",
    "url": "/api/member/paper/handle",
    "title": "提交试卷答案",
    "description": "<p>提交试卷答案</p>",
    "group": "会员试卷模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "intensify_id",
            "description": "<p>考前强化编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "paper_id",
            "description": "<p>试卷编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "score",
            "description": "<p>试卷得分</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "answer",
            "description": "<p>试卷答案</p>"
          },
          {
            "group": "Parameter",
            "type": "json",
            "optional": false,
            "field": "example",
            "description": "<p>{&quot;course_id&quot;:&quot;2&quot;,&quot;intensify_id&quot;:&quot;11&quot;,&quot;paper_id&quot;:&quot;1&quot;,&quot;score&quot;:&quot;85&quot;,&quot;answer&quot;:[{&quot;question_id&quot;:1,&quot;result&quot;:1},{&quot;question_id&quot;:1,&quot;result&quot;:2},{&quot;question_id&quot;:1,&quot;result&quot;:1},{&quot;question_id&quot;:1,&quot;result&quot;:1},{&quot;question_id&quot;:1,&quot;result&quot;:1}]}</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Paper/PaperController.php",
    "groupTitle": "会员试卷模块",
    "name": "PostApiMemberPaperHandle"
  },
  {
    "type": "get",
    "url": "/api/member/course/data?page={page}",
    "title": "获取指定学员课程列表(分页)",
    "description": "<p>获取指定学员课程列表(分页)</p>",
    "group": "会员课程模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "is_finish",
            "description": "<p>是否完成 2 未完成 1 已完成</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Course/CourseController.php",
    "groupTitle": "会员课程模块",
    "name": "GetApiMemberCourseDataPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/course/list?page={page}",
    "title": "获取会员课程列表(分页)",
    "description": "<p>获取会员课程列表(分页)</p>",
    "group": "会员课程模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "is_finish",
            "description": "<p>是否完成 2 未完成 1 已完成</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Course/CourseController.php",
    "groupTitle": "会员课程模块",
    "name": "GetApiMemberCourseListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/course/select",
    "title": "获取会员课程列表(不分页)",
    "description": "<p>获取会员课程列表(不分页)</p>",
    "group": "会员课程模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "is_finish",
            "description": "<p>是否完成 2 未完成 1 已完成</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/course/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Course/CourseController.php",
    "groupTitle": "会员课程模块",
    "name": "GetApiMemberCourseSelect"
  },
  {
    "type": "get",
    "url": "/api/member/course/status/{course_id}",
    "title": "获取当前课程是否被订阅",
    "description": "<p>获取当前课程是否被订阅</p>",
    "group": "会员课程模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/course/status/{course_id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Course/CourseController.php",
    "groupTitle": "会员课程模块",
    "name": "GetApiMemberCourseStatusCourse_id"
  },
  {
    "type": "post",
    "url": "/api/member/course/handle",
    "title": "订购课程",
    "description": "<p>会员登录进行笔记</p>",
    "group": "会员课程模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Course/CourseController.php",
    "groupTitle": "会员课程模块",
    "name": "PostApiMemberCourseHandle"
  },
  {
    "type": "get",
    "url": "/api/education/homework/list?page={page}",
    "title": "获取作业列表(分页)",
    "description": "<p>获取作业列表(分页)</p>",
    "group": "作业模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号（可以为空）</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Homework/HomeworkController.php",
    "groupTitle": "作业模块",
    "name": "GetApiEducationHomeworkListPagePage"
  },
  {
    "type": "get",
    "url": "/api/education/homework/select",
    "title": "获取作业列表(不分页)",
    "description": "<p>获取作业列表(不分页)</p>",
    "group": "作业模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号（可以为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/homework/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Homework/HomeworkController.php",
    "groupTitle": "作业模块",
    "name": "GetApiEducationHomeworkSelect"
  },
  {
    "type": "get",
    "url": "/api/education/homework/view/{id}",
    "title": "获取作业详情",
    "description": "<p>获取作业详情</p>",
    "group": "作业模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/homework/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Homework/HomeworkController.php",
    "groupTitle": "作业模块",
    "name": "GetApiEducationHomeworkViewId"
  },
  {
    "type": "post",
    "url": "/api/education/homework/delete",
    "title": "删除作业信息",
    "description": "<p>删除作业信息</p>",
    "group": "作业模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/homework/delete"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Homework/HomeworkController.php",
    "groupTitle": "作业模块",
    "name": "PostApiEducationHomeworkDelete"
  },
  {
    "type": "post",
    "url": "/api/education/homework/handle",
    "title": "创建作业",
    "description": "<p>创建作业</p>",
    "group": "作业模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>作业编号（为空：新增，不为空：编辑）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "point_id",
            "description": "<p>课程知识点编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "title",
            "description": "<p>作业标题（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "content",
            "description": "<p>作业内容（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "array",
            "optional": false,
            "field": "resource",
            "description": "<p>作业资源地址数组（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "json",
            "optional": false,
            "field": "example",
            "description": "<p>{&quot;id&quot;:&quot;65&quot;,&quot;course_id&quot;:&quot;5&quot;,&quot;point_id&quot;:&quot;5&quot;,&quot;squad_id&quot;:&quot;1,2,3&quot;,&quot;title&quot;:&quot;22222222222&quot;,&quot;content&quot;:&quot;31231313212312312313&quot;,&quot;resource&quot;:[{&quot;title&quot;:&quot;11111&quot;,&quot;url&quot;:&quot;www.11111.com&quot;},{&quot;title&quot;:&quot;22222&quot;,&quot;url&quot;:&quot;www.22222.com&quot;}]}</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Homework/HomeworkController.php",
    "groupTitle": "作业模块",
    "name": "PostApiEducationHomeworkHandle"
  },
  {
    "type": "post",
    "url": "/api/member/intensify/question/handle",
    "title": "提交强化练习题答案",
    "description": "<p>提交强化练习题答案</p>",
    "group": "强化练习题模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "intensify_id",
            "description": "<p>考前强化编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "question_id",
            "description": "<p>练习题编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "result",
            "description": "<p>练习题结果 1 正确 2 错误</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Paper/Relevance/QuestionController.php",
    "groupTitle": "强化练习题模块",
    "name": "PostApiMemberIntensifyQuestionHandle"
  },
  {
    "type": "get",
    "url": "/api/probe/search",
    "title": "获取知识点探针令牌",
    "description": "<p>获取知识点探针令牌</p>",
    "group": "探针模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/probe/search"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Probe/ProbeController.php",
    "groupTitle": "探针模块",
    "name": "GetApiProbeSearch"
  },
  {
    "type": "post",
    "url": "/api/probe/handle",
    "title": "记录探针令牌",
    "description": "<p>记录探针令牌</p>",
    "group": "探针模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "point_id",
            "description": "<p>知识点编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "probe_token",
            "description": "<p>探针令牌（32位字符串）</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Probe/ProbeController.php",
    "groupTitle": "探针模块",
    "name": "PostApiProbeHandle"
  },
  {
    "type": "get",
    "url": "/api/organization/squad/study/center/{squad_id}",
    "title": "获取机构学习中心信息",
    "description": "<p>获取机构学习中心信息</p>",
    "group": "机构学习中心模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/squad/study/center/{squad_id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/StudyController.php",
    "groupTitle": "机构学习中心模块",
    "name": "GetApiOrganizationSquadStudyCenterSquad_id"
  },
  {
    "type": "get",
    "url": "/api/organization/squad/study/statistical/list/{squad_id}",
    "title": "获取机构学习统计数据",
    "description": "<p>获取机构学习统计数据</p>",
    "group": "机构学习中心模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/squad/study/list/{squad_id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/Study/StatisticalController.php",
    "groupTitle": "机构学习中心模块",
    "name": "GetApiOrganizationSquadStudyStatisticalListSquad_id"
  },
  {
    "type": "get",
    "url": "/api/organization/squad/study/view/{squad_id}",
    "title": "获取机构学习中心详情",
    "description": "<p>获取机构学习中心详情</p>",
    "group": "机构学习中心模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/squad/study/view/{squad_id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/StudyController.php",
    "groupTitle": "机构学习中心模块",
    "name": "GetApiOrganizationSquadStudyViewSquad_id"
  },
  {
    "type": "get",
    "url": "/api/organization/squad/grade/center/{squad_id}",
    "title": "获取机构成绩中心信息",
    "description": "<p>获取机构成绩中心信息</p>",
    "group": "机构成绩中心模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/squad/grade/center/{squad_id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/GradeController.php",
    "groupTitle": "机构成绩中心模块",
    "name": "GetApiOrganizationSquadGradeCenterSquad_id"
  },
  {
    "type": "get",
    "url": "/api/organization/squad/grade/class_after_question",
    "title": "获取课后练习题信息",
    "description": "<p>获取课后练习题信息</p>",
    "group": "机构成绩中心模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/squad/grade/class_after_question"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/Grade/DetailController.php",
    "groupTitle": "机构成绩中心模块",
    "name": "GetApiOrganizationSquadGradeClass_after_question"
  },
  {
    "type": "get",
    "url": "/api/organization/squad/grade/comprehensive_question",
    "title": "获取综合练习题信息",
    "description": "<p>获取综合练习题信息</p>",
    "group": "机构成绩中心模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/squad/grade/comprehensive_question"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/Grade/DetailController.php",
    "groupTitle": "机构成绩中心模块",
    "name": "GetApiOrganizationSquadGradeComprehensive_question"
  },
  {
    "type": "get",
    "url": "/api/organization/squad/grade/simulation_exam",
    "title": "获取模拟试卷信息",
    "description": "<p>获取模拟试卷信息</p>",
    "group": "机构成绩中心模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/squad/grade/simulation_exam"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/Grade/DetailController.php",
    "groupTitle": "机构成绩中心模块",
    "name": "GetApiOrganizationSquadGradeSimulation_exam"
  },
  {
    "type": "get",
    "url": "/api/organization/list?page={page}",
    "title": "获取机构列表(分页)",
    "description": "<p>获取机构列表(分页)</p>",
    "group": "机构模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/OrganizationController.php",
    "groupTitle": "机构模块",
    "name": "GetApiOrganizationListPagePage"
  },
  {
    "type": "get",
    "url": "/api/organization/select",
    "title": "获取机构列表(不分页)",
    "description": "<p>获取机构列表(不分页)</p>",
    "group": "机构模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/OrganizationController.php",
    "groupTitle": "机构模块",
    "name": "GetApiOrganizationSelect"
  },
  {
    "type": "get",
    "url": "/api/organization/view/{id}",
    "title": "获取机构详情",
    "description": "<p>获取机构详情</p>",
    "group": "机构模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/OrganizationController.php",
    "groupTitle": "机构模块",
    "name": "GetApiOrganizationViewId"
  },
  {
    "type": "post",
    "url": "/api/organization/apply_first_step",
    "title": "机构注册第一步",
    "description": "<p>机构注册第一步</p>",
    "group": "机构模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "title",
            "description": "<p>机构名称（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>登录手机号码（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sms_code",
            "description": "<p>验证码（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>机构邮箱（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "json",
            "optional": false,
            "field": "example",
            "description": "<p>{&quot;title&quot;:&quot;中职动力北京科技有限公司&quot;,&quot;username&quot;:&quot;15185296312&quot;,&quot;sms_code&quot;:&quot;120120&quot;,&quot;email&quot;:&quot;13848259634@138.com&quot;}</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/apply_first_step"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/OrganizationController.php",
    "groupTitle": "机构模块",
    "name": "PostApiOrganizationApply_first_step"
  },
  {
    "type": "post",
    "url": "/api/organization/apply_second_step",
    "title": "机构注册第二步",
    "description": "<p>机构注册第二步</p>",
    "group": "机构模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": "<p>密码（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password_confirmation",
            "description": "<p>确认密码（不能为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/apply_second_step"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/OrganizationController.php",
    "groupTitle": "机构模块",
    "name": "PostApiOrganizationApply_second_step"
  },
  {
    "type": "post",
    "url": "/api/organization/certification",
    "title": "机构认证",
    "description": "<p>编辑机构信息</p>",
    "group": "机构模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>机构编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "business_license",
            "description": "<p>机构营业执照（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "title",
            "description": "<p>机构名称（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "head",
            "description": "<p>负责人姓名（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "head_mobile",
            "description": "<p>负责人电话（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "home_address",
            "description": "<p>机构所在地（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "contact",
            "description": "<p>联系人姓名（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "contact_mobile",
            "description": "<p>联系人电话（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>机构邮箱（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "weixin",
            "description": "<p>机构微信（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "qq",
            "description": "<p>机构QQ（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "address",
            "description": "<p>机构地址（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "json",
            "optional": false,
            "field": "example",
            "description": "<p>{&quot;id&quot;:&quot;1&quot;,&quot;logo&quot;:&quot;www.baidu.com&quot;,&quot;business_license&quot;:&quot;www.google.com&quot;,&quot;title&quot;:&quot;一下科技北京科技有限公司&quot;,&quot;head&quot;:&quot;赵大宝&quot;,&quot;head_mobile&quot;:&quot;15185296312&quot;,&quot;home_address&quot;:&quot;北京市朝阳区115号&quot;,&quot;contact&quot;:&quot;邓大平&quot;,&quot;contact_mobile&quot;:&quot;13848259634&quot;,&quot;email&quot;:&quot;13848259634@138.com&quot;,&quot;weixin&quot;:&quot;13848259634&quot;,&quot;qq&quot;:&quot;13848259634&quot;,&quot;address&quot;:&quot;天津市天津区天津街天津号&quot;}</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/certification"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/OrganizationController.php",
    "groupTitle": "机构模块",
    "name": "PostApiOrganizationCertification"
  },
  {
    "type": "post",
    "url": "/api/organization/handle",
    "title": "编辑机构信息",
    "description": "<p>编辑机构信息</p>",
    "group": "机构模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号（为空：新增，不为空：编辑）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "logo",
            "description": "<p>机构logo（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "head_mobile",
            "description": "<p>负责人电话（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "contact",
            "description": "<p>联系人姓名（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "contact_mobile",
            "description": "<p>联系人电话（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>机构邮箱（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "weixin",
            "description": "<p>机构微信（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "qq",
            "description": "<p>机构QQ（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "address",
            "description": "<p>机构地址（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "json",
            "optional": false,
            "field": "example",
            "description": "<p>{&quot;id&quot;:&quot;2&quot;,&quot;logo&quot;:&quot;中职动力北京科技有限公司&quot;,&quot;head_mobile&quot;:&quot;15185296312&quot;,&quot;contact&quot;:&quot;邓大平&quot;,&quot;contact_mobile&quot;:&quot;13848259634&quot;,&quot;email&quot;:&quot;13848259634@138.com&quot;,&quot;weixin&quot;:&quot;13848259634&quot;,&quot;qq&quot;:&quot;13848259634&quot;,&quot;address&quot;:&quot;天津市天津区天津街天津号&quot;}</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/OrganizationController.php",
    "groupTitle": "机构模块",
    "name": "PostApiOrganizationHandle"
  },
  {
    "type": "get",
    "url": "/api/organization/course/list?page={page}",
    "title": "获取机构课程列表(分页)",
    "description": "<p>获取机构课程列表(分页)</p>",
    "group": "机构课程模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Relevance/CourseController.php",
    "groupTitle": "机构课程模块",
    "name": "GetApiOrganizationCourseListPagePage"
  },
  {
    "type": "get",
    "url": "/api/organization/course/select",
    "title": "获取机构课程列表(不分页)",
    "description": "<p>获取机构课程列表(不分页)</p>",
    "group": "机构课程模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Relevance/CourseController.php",
    "groupTitle": "机构课程模块",
    "name": "GetApiOrganizationCourseSelect"
  },
  {
    "type": "get",
    "url": "/api/organization/course/watch",
    "title": "是否可以观看课程",
    "description": "<p>获取当前用户是否可以观看课程</p>",
    "group": "机构课程模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Relevance/CourseController.php",
    "groupTitle": "机构课程模块",
    "name": "GetApiOrganizationCourseWatch"
  },
  {
    "type": "get",
    "url": "/api/message/list?page={page}",
    "title": "获取消息列表(分页)",
    "description": "<p>获取消息列表(分页)</p>",
    "group": "消息模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Message/MessageController.php",
    "groupTitle": "消息模块",
    "name": "GetApiMessageListPagePage"
  },
  {
    "type": "get",
    "url": "/api/message/select",
    "title": "获取消息列表(不分页)",
    "description": "<p>获取消息列表(不分页)</p>",
    "group": "消息模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/message/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Message/MessageController.php",
    "groupTitle": "消息模块",
    "name": "GetApiMessageSelect"
  },
  {
    "type": "get",
    "url": "/api/message/view/{id}",
    "title": "获取消息详情",
    "description": "<p>获取消息详情</p>",
    "group": "消息模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/message/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Message/MessageController.php",
    "groupTitle": "消息模块",
    "name": "GetApiMessageViewId"
  },
  {
    "type": "post",
    "url": "/api/message/handle",
    "title": "消息操作",
    "description": "<p>消息操作</p>",
    "group": "消息模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "type",
            "description": "<p>1 系统消息 2 班级消息</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "title",
            "description": "<p>消息标题</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "content",
            "description": "<p>消息内容</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "squad_id",
            "description": "<p>1,2,3,4 班级编号</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Message/MessageController.php",
    "groupTitle": "消息模块",
    "name": "PostApiMessageHandle"
  },
  {
    "type": "get",
    "url": "/api/organization/export",
    "title": "导出学员档案",
    "description": "<p>导出学员档案</p>",
    "group": "班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "organization_id",
            "description": "<p>机构编号(不能为空)</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/OrganizationController.php",
    "groupTitle": "班级模块",
    "name": "GetApiOrganizationExport"
  },
  {
    "type": "get",
    "url": "/api/organization/squad/course/select",
    "title": "获取班级已选课程列表(不分页)",
    "description": "<p>获取班级已选课程列表(不分页)</p>",
    "group": "班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/Relevance/CourseController.php",
    "groupTitle": "班级模块",
    "name": "GetApiOrganizationSquadCourseSelect"
  },
  {
    "type": "get",
    "url": "/api/organization/squad/list?page={page}",
    "title": "获取班级列表(分页)",
    "description": "<p>获取班级列表(分页)</p>",
    "group": "班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "organization_id",
            "description": "<p>机构编号</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/SquadController.php",
    "groupTitle": "班级模块",
    "name": "GetApiOrganizationSquadListPagePage"
  },
  {
    "type": "get",
    "url": "/api/organization/squad/member/export",
    "title": "导出学习记录档案",
    "description": "<p>导出学习记录档案</p>",
    "group": "班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号(不能为空)</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/Relevance/MemberController.php",
    "groupTitle": "班级模块",
    "name": "GetApiOrganizationSquadMemberExport"
  },
  {
    "type": "get",
    "url": "/api/organization/squad/member/roster?page={page}",
    "title": "获取班级花名册列表(分页)",
    "description": "<p>获取班级花名册列表(分页)</p>",
    "group": "班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/Relevance/MemberController.php",
    "groupTitle": "班级模块",
    "name": "GetApiOrganizationSquadMemberRosterPagePage"
  },
  {
    "type": "get",
    "url": "/api/organization/squad/member/student?page={page}",
    "title": "获取班级学生列表(分页)",
    "description": "<p>获取班级学生列表(分页)</p>",
    "group": "班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/Relevance/MemberController.php",
    "groupTitle": "班级模块",
    "name": "GetApiOrganizationSquadMemberStudentPagePage"
  },
  {
    "type": "get",
    "url": "/api/organization/squad/member/teacher?page={page}",
    "title": "获取班级老师列表(分页)",
    "description": "<p>获取班级老师列表(分页)</p>",
    "group": "班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/Relevance/MemberController.php",
    "groupTitle": "班级模块",
    "name": "GetApiOrganizationSquadMemberTeacherPagePage"
  },
  {
    "type": "get",
    "url": "/api/organization/squad/select",
    "title": "获取班级列表(不分页)",
    "description": "<p>获取班级列表(不分页)</p>",
    "group": "班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "organization_id",
            "description": "<p>机构编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/squad/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/SquadController.php",
    "groupTitle": "班级模块",
    "name": "GetApiOrganizationSquadSelect"
  },
  {
    "type": "get",
    "url": "/api/organization/squad/view/{id}",
    "title": "获取班级详情",
    "description": "<p>获取班级详情</p>",
    "group": "班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/squad/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/SquadController.php",
    "groupTitle": "班级模块",
    "name": "GetApiOrganizationSquadViewId"
  },
  {
    "type": "post",
    "url": "/api/organization/squad/again_add_student",
    "title": "再次添加学员",
    "description": "<p>再次添加学员</p>",
    "group": "班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>班级编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "file",
            "description": "<p>花名册（不能为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/squad/again_add_student"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/SquadController.php",
    "groupTitle": "班级模块",
    "name": "PostApiOrganizationSquadAgain_add_student"
  },
  {
    "type": "post",
    "url": "/api/organization/squad/apply_first_step",
    "title": "申请班级第一步",
    "description": "<p>申请班级第一步</p>",
    "group": "班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "title",
            "description": "<p>班级名称（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "number",
            "description": "<p>班级人数（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "teacher_id",
            "description": "<p>班主任id（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "json",
            "optional": false,
            "field": "example",
            "description": "<p>{&quot;title&quot;:&quot;班级名称&quot;,&quot;number&quot;:&quot;班级人数&quot;,&quot;teacher_id&quot;:&quot;班主任编号&quot;}</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/squad/apply_first_step"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/SquadController.php",
    "groupTitle": "班级模块",
    "name": "PostApiOrganizationSquadApply_first_step"
  },
  {
    "type": "post",
    "url": "/api/organization/squad/apply_fourth_step",
    "title": "申请班级第四步",
    "description": "<p>申请班级第四步</p>",
    "group": "班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>班级编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程信息（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "json",
            "optional": false,
            "field": "example",
            "description": "<p>{&quot;id&quot;:&quot;2&quot;,&quot;course_id&quot;:[课程编号1,课程编号2]}</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/squad/apply_fourth_step"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/SquadController.php",
    "groupTitle": "班级模块",
    "name": "PostApiOrganizationSquadApply_fourth_step"
  },
  {
    "type": "post",
    "url": "/api/organization/squad/apply_second_step",
    "title": "申请班级第二步",
    "description": "<p>申请班级第一步</p>",
    "group": "班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>班级编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "description",
            "description": "<p>培训计划（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "start_time",
            "description": "<p>开班时间（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "end_time",
            "description": "<p>结业时间（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "json",
            "optional": false,
            "field": "example",
            "description": "<p>{&quot;id&quot;:&quot;2&quot;,&quot;description&quot;:&quot;培训计划&quot;,&quot;start_time&quot;:&quot;2020-12-12&quot;,&quot;end_time&quot;:&quot;2021-12-12&quot;}</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/squad/apply_second_step"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/SquadController.php",
    "groupTitle": "班级模块",
    "name": "PostApiOrganizationSquadApply_second_step"
  },
  {
    "type": "post",
    "url": "/api/organization/squad/apply_third_step",
    "title": "申请班级第三步",
    "description": "<p>申请班级第三步</p>",
    "group": "班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>班级编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "file",
            "description": "<p>花名册（不能为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/squad/apply_third_step"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/SquadController.php",
    "groupTitle": "班级模块",
    "name": "PostApiOrganizationSquadApply_third_step"
  },
  {
    "type": "post",
    "url": "/api/organization/squad/change_end_time",
    "title": "修改班级结业时间",
    "description": "<p>修改班级结业时间</p>",
    "group": "班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "end_time",
            "description": "<p>结业时间（不能为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/squad/change_end_time"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/SquadController.php",
    "groupTitle": "班级模块",
    "name": "PostApiOrganizationSquadChange_end_time"
  },
  {
    "type": "post",
    "url": "/api/organization/squad/change_status",
    "title": "修改班级状态",
    "description": "<p>修改班级状态</p>",
    "group": "班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "status",
            "description": "<p>班级状态 1 开课 2 停课（不能为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/squad/change_status"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/SquadController.php",
    "groupTitle": "班级模块",
    "name": "PostApiOrganizationSquadChange_status"
  },
  {
    "type": "post",
    "url": "/api/organization/squad/course",
    "title": "添加班级课程",
    "description": "<p>添加班级课程</p>",
    "group": "班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "id",
            "description": "<p>班级编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程信息（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "json",
            "optional": false,
            "field": "example",
            "description": "<p>{&quot;id&quot;:&quot;2&quot;,&quot;course_id&quot;:[课程编号1,课程编号2]}</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/squad/course"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/SquadController.php",
    "groupTitle": "班级模块",
    "name": "PostApiOrganizationSquadCourse"
  },
  {
    "type": "post",
    "url": "/api/organization/squad/member/graduation",
    "title": "获取当前可结业用户列表(不分页)",
    "description": "<p>获取当前可结业用户列表(不分页)</p>",
    "group": "班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "array",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号（可以为空）</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/Relevance/MemberController.php",
    "groupTitle": "班级模块",
    "name": "PostApiOrganizationSquadMemberGraduation"
  },
  {
    "type": "post",
    "url": "/api/organization/squad/member/ungraduation",
    "title": "获取当前不可结业用户列表(不分页)",
    "description": "<p>获取当前不可结业用户列表(不分页)</p>",
    "group": "班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "array",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号（可以为空）</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/Relevance/MemberController.php",
    "groupTitle": "班级模块",
    "name": "PostApiOrganizationSquadMemberUngraduation"
  },
  {
    "type": "post",
    "url": "/api/organization/squad/status",
    "title": "是否可以结业",
    "description": "<p>是否可以结业</p>",
    "group": "班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号（不能为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/organization/squad/status"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Organization/Squad/SquadController.php",
    "groupTitle": "班级模块",
    "name": "PostApiOrganizationSquadStatus"
  },
  {
    "type": "get",
    "url": "/api/education/course/tree/select",
    "title": "获取课程知识地图列表(不分页)",
    "description": "<p>获取课程知识地图列表(不分页)</p>",
    "group": "知识地图模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>课程编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/tree/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/TreeController.php",
    "groupTitle": "知识地图模块",
    "name": "GetApiEducationCourseTreeSelect"
  },
  {
    "type": "get",
    "url": "/api/education/course/point/detail/{unit_id}",
    "title": "获取知识点详情(通过课程单元编号)",
    "description": "<p>获取知识点详情(通过课程单元编号)</p>",
    "group": "知识点模块",
    "sampleRequest": [
      {
        "url": "/api/education/course/point/detail/{unit_id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/PointController.php",
    "groupTitle": "知识点模块",
    "name": "GetApiEducationCoursePointDetailUnit_id"
  },
  {
    "type": "get",
    "url": "/api/education/course/point/list?page={page}",
    "title": "获取知识点列表(分页)",
    "description": "<p>获取知识点列表(分页)</p>",
    "group": "知识点模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "title",
            "description": "<p>课程标题(可以为空)</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号(可以为空)</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "unit_id",
            "description": "<p>单元编号(可以为空)</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/PointController.php",
    "groupTitle": "知识点模块",
    "name": "GetApiEducationCoursePointListPagePage"
  },
  {
    "type": "get",
    "url": "/api/education/course/point/recommend",
    "title": "获取推荐知识点列表(不分页)",
    "description": "<p>获取推荐知识点列表(不分页)</p>",
    "group": "知识点模块",
    "sampleRequest": [
      {
        "url": "/api/education/course/point/recommend"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/PointController.php",
    "groupTitle": "知识点模块",
    "name": "GetApiEducationCoursePointRecommend"
  },
  {
    "type": "get",
    "url": "/api/education/course/point/select",
    "title": "获取知识点列表(不分页)",
    "description": "<p>获取知识点列表(不分页)</p>",
    "group": "知识点模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "title",
            "description": "<p>课程标题(可以为空)</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号(可以为空)</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "unit_id",
            "description": "<p>单元编号(可以为空)</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/point/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/PointController.php",
    "groupTitle": "知识点模块",
    "name": "GetApiEducationCoursePointSelect"
  },
  {
    "type": "get",
    "url": "/api/education/course/point/view/{id}",
    "title": "获取知识点详情",
    "description": "<p>获取知识点详情</p>",
    "group": "知识点模块",
    "sampleRequest": [
      {
        "url": "/api/education/course/point/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/PointController.php",
    "groupTitle": "知识点模块",
    "name": "GetApiEducationCoursePointViewId"
  },
  {
    "type": "post",
    "url": "/api/education/course/point/similarity",
    "title": "获取相似知识点列表(不分页)",
    "description": "<p>获取相似知识点列表(不分页)</p>",
    "group": "知识点模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "array",
            "optional": false,
            "field": "label_id",
            "description": "<p>标签数组（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "json",
            "optional": false,
            "field": "example",
            "description": "<p>{&quot;label_id&quot;: [&quot;66&quot;, &quot;67&quot;]}</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/point/similarity"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/PointController.php",
    "groupTitle": "知识点模块",
    "name": "PostApiEducationCoursePointSimilarity"
  },
  {
    "type": "get",
    "url": "/api/education/course/point/question/view/{id}",
    "title": "获取练习题详情",
    "description": "<p>获取练习题详情</p>",
    "group": "练习题模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/point/question/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/Point/QuestionController.php",
    "groupTitle": "练习题模块",
    "name": "GetApiEducationCoursePointQuestionViewId"
  },
  {
    "type": "post",
    "url": "/api/education/course/point/question/reply",
    "title": "回答练习题",
    "description": "<p>回答练习题</p>",
    "group": "练习题模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "point_id",
            "description": "<p>知识点编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "question_id",
            "description": "<p>练习题编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "result",
            "description": "<p>回答结果 1 正常 2 错误</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/Point/Relevance/QuestionController.php",
    "groupTitle": "练习题模块",
    "name": "PostApiEducationCoursePointQuestionReply"
  },
  {
    "type": "post",
    "url": "/api/member/point/question/handle",
    "title": "提交练习题答案",
    "description": "<p>提交练习题答案</p>",
    "group": "练习题模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "point_id",
            "description": "<p>知识点编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "question_id",
            "description": "<p>练习题编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "type",
            "description": "<p>练习题类型 1 普通类型 2 特殊类型</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "result",
            "description": "<p>练习题结果 1 正确 2 错误</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Point/Relevance/QuestionController.php",
    "groupTitle": "练习题模块",
    "name": "PostApiMemberPointQuestionHandle"
  },
  {
    "type": "get",
    "url": "/api/education/graduation/status",
    "title": "获取班级结业状态",
    "description": "<p>获取班级结业状态</p>",
    "group": "结业模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号（不能为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/graduation/status"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Graduation/GraduationController.php",
    "groupTitle": "结业模块",
    "name": "GetApiEducationGraduationStatus"
  },
  {
    "type": "get",
    "url": "/api/education/graduation/view/{id}",
    "title": "获取结业详情",
    "description": "<p>获取结业详情</p>",
    "group": "结业模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/graduation/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Graduation/GraduationController.php",
    "groupTitle": "结业模块",
    "name": "GetApiEducationGraduationViewId"
  },
  {
    "type": "post",
    "url": "/api/education/graduation/apply_first_step",
    "title": "结业申请第一步",
    "description": "<p>结业申请第一步</p>",
    "group": "结业模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "array",
            "optional": false,
            "field": "squad_id",
            "description": "<p>（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "json",
            "optional": false,
            "field": "example",
            "description": "<p>{&quot;squad_id&quot;:1}</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Graduation/GraduationController.php",
    "groupTitle": "结业模块",
    "name": "PostApiEducationGraduationApply_first_step"
  },
  {
    "type": "post",
    "url": "/api/education/graduation/apply_second_step",
    "title": "结业申请第二步",
    "description": "<p>结业申请第二步</p>",
    "group": "结业模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>结业编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "array",
            "optional": false,
            "field": "graduation",
            "description": "<p>可以结业学员（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "array",
            "optional": false,
            "field": "ungraduation",
            "description": "<p>以结业学员（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "json",
            "optional": false,
            "field": "example",
            "description": "<p>{&quot;id&quot;:&quot;65&quot;,&quot;graduation&quot;:[&quot;1&quot;,&quot;2&quot;], &quot;ungraduation&quot;:[&quot;3&quot;,&quot;4&quot;]}</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Graduation/GraduationController.php",
    "groupTitle": "结业模块",
    "name": "PostApiEducationGraduationApply_second_step"
  },
  {
    "type": "get",
    "url": "/api/education/course/intensify/intensify/select",
    "title": "获取考前强化内容列表(不分页)",
    "description": "<p>获取考前强化内容列表(不分页)</p>",
    "group": "考前强化模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "category_id",
            "description": "<p>分类</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/intensify/intensify/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/Intensify/IntensifyController.php",
    "groupTitle": "考前强化模块",
    "name": "GetApiEducationCourseIntensifyIntensifySelect"
  },
  {
    "type": "get",
    "url": "/api/education/course/intensify/intensify/view/{id}",
    "title": "获取考前强化内容详情",
    "description": "<p>获取考前强化内容详情</p>",
    "group": "考前强化模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/intensify/intensify/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/Intensify/IntensifyController.php",
    "groupTitle": "考前强化模块",
    "name": "GetApiEducationCourseIntensifyIntensifyViewId"
  },
  {
    "type": "get",
    "url": "/api/education/course/intensify/list?page={page}",
    "title": "获取考前强化列表(分页)",
    "description": "<p>获取考前强化列表(分页)</p>",
    "group": "考前强化模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/IntensifyController.php",
    "groupTitle": "考前强化模块",
    "name": "GetApiEducationCourseIntensifyListPagePage"
  },
  {
    "type": "get",
    "url": "/api/education/course/intensify/select",
    "title": "获取考前强化列表(不分页)",
    "description": "<p>获取考前强化列表(不分页)</p>",
    "group": "考前强化模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/intensify/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/IntensifyController.php",
    "groupTitle": "考前强化模块",
    "name": "GetApiEducationCourseIntensifySelect"
  },
  {
    "type": "get",
    "url": "/api/education/course/intensify/view/{id}",
    "title": "获取考前强化详情",
    "description": "<p>获取考前强化详情</p>",
    "group": "考前强化模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/intensify/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/IntensifyController.php",
    "groupTitle": "考前强化模块",
    "name": "GetApiEducationCourseIntensifyViewId"
  },
  {
    "type": "post",
    "url": "/api/member/intensify/question/handle",
    "title": "提交强化练习题答案",
    "description": "<p>提交强化练习题答案</p>",
    "group": "考前强化模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "intensify_id",
            "description": "<p>考前强化编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "question_id",
            "description": "<p>练习题编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "result",
            "description": "<p>练习题结果 1 正确 2 错误</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Intensify/Relevance/QuestionController.php",
    "groupTitle": "考前强化模块",
    "name": "PostApiMemberIntensifyQuestionHandle"
  },
  {
    "type": "get",
    "url": "/api/education/paper/list?page={page}",
    "title": "获取试卷列表(分页)",
    "description": "<p>获取试卷列表(分页)</p>",
    "group": "试卷模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Paper/PaperController.php",
    "groupTitle": "试卷模块",
    "name": "GetApiEducationPaperListPagePage"
  },
  {
    "type": "get",
    "url": "/api/education/paper/select",
    "title": "获取试卷列表(不分页)",
    "description": "<p>获取试卷列表(不分页)</p>",
    "group": "试卷模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/paper/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Paper/PaperController.php",
    "groupTitle": "试卷模块",
    "name": "GetApiEducationPaperSelect"
  },
  {
    "type": "get",
    "url": "/api/education/paper/view/{id}",
    "title": "获取试卷详情",
    "description": "<p>获取试卷详情</p>",
    "group": "试卷模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/paper/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Paper/PaperController.php",
    "groupTitle": "试卷模块",
    "name": "GetApiEducationPaperViewId"
  },
  {
    "type": "get",
    "url": "/api/education/course/unit/list?page={page}",
    "title": "获取课程单元列表(分页)",
    "description": "<p>获取课程单元列表(分页)</p>",
    "group": "课程单元模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "parent_id",
            "description": "<p>课程编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/UnitController.php",
    "groupTitle": "课程单元模块",
    "name": "GetApiEducationCourseUnitListPagePage"
  },
  {
    "type": "get",
    "url": "/api/education/course/unit/select",
    "title": "获取课程单元列表(不分页)",
    "description": "<p>获取课程单元列表(不分页)</p>",
    "group": "课程单元模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "parent_id",
            "description": "<p>课程编号（不能为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/unit/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/UnitController.php",
    "groupTitle": "课程单元模块",
    "name": "GetApiEducationCourseUnitSelect"
  },
  {
    "type": "get",
    "url": "/api/education/course/unit/view/{id}",
    "title": "获取课程单元详情",
    "description": "<p>获取课程单元详情</p>",
    "group": "课程单元模块",
    "sampleRequest": [
      {
        "url": "/api/education/course/unit/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/UnitController.php",
    "groupTitle": "课程单元模块",
    "name": "GetApiEducationCourseUnitViewId"
  },
  {
    "type": "post",
    "url": "/api/education/course/unit/index",
    "title": "课程首页单元（栏目）",
    "description": "<p>课程首页单元（栏目）</p>",
    "group": "课程单元模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/unit/index"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/UnitController.php",
    "groupTitle": "课程单元模块",
    "name": "PostApiEducationCourseUnitIndex"
  },
  {
    "type": "get",
    "url": "/api/education/course/label/list?page={page}",
    "title": "获取课程标签列表(分页)",
    "description": "<p>获取课程标签列表(分页)</p>",
    "group": "课程标签模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/LabelController.php",
    "groupTitle": "课程标签模块",
    "name": "GetApiEducationCourseLabelListPagePage"
  },
  {
    "type": "get",
    "url": "/api/education/course/label/select",
    "title": "获取课程标签列表(不分页)",
    "description": "<p>获取课程标签列表(不分页)</p>",
    "group": "课程标签模块",
    "sampleRequest": [
      {
        "url": "/api/education/course/label/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/LabelController.php",
    "groupTitle": "课程标签模块",
    "name": "GetApiEducationCourseLabelSelect"
  },
  {
    "type": "get",
    "url": "/api/education/course/list?page={page}",
    "title": "获取课程列表(分页)",
    "description": "<p>获取课程列表(分页)</p>",
    "group": "课程模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "title",
            "description": "<p>课程标题(可以为空)</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/CourseController.php",
    "groupTitle": "课程模块",
    "name": "GetApiEducationCourseListPagePage"
  },
  {
    "type": "get",
    "url": "/api/education/course/recommend",
    "title": "获取推荐课程列表(不分页)",
    "description": "<p>获取推荐课程列表(不分页)</p>",
    "group": "课程模块",
    "sampleRequest": [
      {
        "url": "/api/education/course/recommend"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/CourseController.php",
    "groupTitle": "课程模块",
    "name": "GetApiEducationCourseRecommend"
  },
  {
    "type": "get",
    "url": "/api/education/course/select",
    "title": "获取课程列表(不分页)",
    "description": "<p>获取课程列表(不分页)</p>",
    "group": "课程模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "title",
            "description": "<p>课程标题(可以为空)</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/CourseController.php",
    "groupTitle": "课程模块",
    "name": "GetApiEducationCourseSelect"
  },
  {
    "type": "get",
    "url": "/api/education/course/view/{id}",
    "title": "获取课程详情",
    "description": "<p>获取课程详情</p>",
    "group": "课程模块",
    "sampleRequest": [
      {
        "url": "/api/education/course/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/CourseController.php",
    "groupTitle": "课程模块",
    "name": "GetApiEducationCourseViewId"
  },
  {
    "type": "post",
    "url": "/api/education/course/column",
    "title": "课程是否有栏目",
    "description": "<p>获取指定课程是否有栏目</p>",
    "group": "课程模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "array",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号（不能为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/column"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/CourseController.php",
    "groupTitle": "课程模块",
    "name": "PostApiEducationCourseColumn"
  },
  {
    "type": "post",
    "url": "/api/education/course/similarity",
    "title": "获取相似课程列表(不分页)",
    "description": "<p>获取相似课程列表(不分页)</p>",
    "group": "课程模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "array",
            "optional": false,
            "field": "label_id",
            "description": "<p>标签数组（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "json",
            "optional": false,
            "field": "example",
            "description": "<p>{&quot;label_id&quot;: [&quot;66&quot;, &quot;67&quot;]}</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/similarity"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/CourseController.php",
    "groupTitle": "课程模块",
    "name": "PostApiEducationCourseSimilarity"
  },
  {
    "type": "get",
    "url": "/api/education/course/resource/list?page={page}",
    "title": "获取课程资料列表(分页)",
    "description": "<p>获取课程资料列表(分页)</p>",
    "group": "课程资料模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/ResourceController.php",
    "groupTitle": "课程资料模块",
    "name": "GetApiEducationCourseResourceListPagePage"
  },
  {
    "type": "get",
    "url": "/api/education/course/resource/select",
    "title": "获取课程资料列表(不分页)",
    "description": "<p>获取课程资料列表(不分页)</p>",
    "group": "课程资料模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/resource/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/ResourceController.php",
    "groupTitle": "课程资料模块",
    "name": "GetApiEducationCourseResourceSelect"
  },
  {
    "type": "get",
    "url": "/api/education/course/resource/view/{id}",
    "title": "获取课程资料详情",
    "description": "<p>获取课程资料详情</p>",
    "group": "课程资料模块",
    "sampleRequest": [
      {
        "url": "/api/education/course/resource/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/ResourceController.php",
    "groupTitle": "课程资料模块",
    "name": "GetApiEducationCourseResourceViewId"
  },
  {
    "type": "get",
    "url": "/api/education/course/point/emphasis/list?page={page}",
    "title": "获取课程重点列表(分页)",
    "description": "<p>获取课程重点列表(分页)</p>",
    "group": "课程重点模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/Point/EmphasisController.php",
    "groupTitle": "课程重点模块",
    "name": "GetApiEducationCoursePointEmphasisListPagePage"
  },
  {
    "type": "get",
    "url": "/api/education/course/point/emphasis/select",
    "title": "获取课程重点列表(不分页)",
    "description": "<p>获取课程重点列表(不分页)</p>",
    "group": "课程重点模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/point/emphasis/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/Point/EmphasisController.php",
    "groupTitle": "课程重点模块",
    "name": "GetApiEducationCoursePointEmphasisSelect"
  },
  {
    "type": "get",
    "url": "/api/education/course/point/emphasis/view/{id}",
    "title": "获取课程重点详情",
    "description": "<p>获取课程重点详情</p>",
    "group": "课程重点模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/point/emphasis/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/Point/EmphasisController.php",
    "groupTitle": "课程重点模块",
    "name": "GetApiEducationCoursePointEmphasisViewId"
  },
  {
    "type": "post",
    "url": "/api/education/course/point/emphasis/handle",
    "title": "创建课程重点信息",
    "description": "<p>创建课程重点信息</p>",
    "group": "课程重点模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>JWTtoken</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>课程重点编号（为空：新增，不为空：编辑）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "point_id",
            "description": "<p>课程知识点编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "squad_id",
            "description": "<p>班级编号（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "content",
            "description": "<p>重点内容（不能为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "array",
            "optional": false,
            "field": "attachment",
            "description": "<p>附件地址数组（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "json",
            "optional": false,
            "field": "example",
            "description": "<p>{&quot;id&quot;:&quot;65&quot;,&quot;course_id&quot;:&quot;11&quot;,&quot;point_id&quot;:&quot;6&quot;,&quot;squad_id&quot;:[&quot;7&quot;,&quot;8&quot;],&quot;title&quot;:&quot;2222222222&quot;,&quot;content&quot;:&quot;31231313212312312313&quot;,&quot;attachment&quot;:[{&quot;title&quot;:&quot;111&quot;,&quot;url&quot;:&quot;www.qiansha&quot;},{&quot;title&quot;:&quot;222&quot;,&quot;url&quot;:&quot;www.xiechengfuwu.com&quot;},{&quot;title&quot;:&quot;333&quot;,&quot;url&quot;:&quot;www.baidu.com&quot;}]}</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/Point/EmphasisController.php",
    "groupTitle": "课程重点模块",
    "name": "PostApiEducationCoursePointEmphasisHandle"
  }
] });
