<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
  'namespace'  =>  'Platform',
  'middleware'  =>  'serializer:array'
], function ($api)
{
  $api->group([
    'middleware'  =>  'api.throttle', // 启用节流限制
    'limit'  =>  1000, // 允许次数
    'expires'  =>  1, // 分钟
  ], function ($api)
  {
    // --------------------------------------------------
    // 核心路由
    $api->group(['namespace' => 'System'], function ($api) {

      // 登录路由
      $api->post('login', 'LoginController@login');
      $api->post('register', 'LoginController@register');
      $api->get('logout', 'LoginController@logout');
      $api->get('check_user_login', 'LoginController@check_user_login'); // 验证是否登录

      $api->post('kernel', 'SystemController@kernel');
      $api->post('clear', 'SystemController@clear');

      // 首页路由
      $api->group(['prefix' => 'index'], function ($api) {
        $api->post('total', 'IndexController@total');
        $api->post('data', 'IndexController@data');
        $api->post('user', 'IndexController@user');
        $api->post('course', 'IndexController@course');
        $api->post('keyword', 'IndexController@keyword');
        $api->post('equipment', 'IndexController@equipment');
        $api->post('question', 'IndexController@question');
        $api->post('study', 'IndexController@study');
      });

      // 文件上传路由
      $api->group(['prefix' => 'file'], function ($api) {
        $api->post('resource', 'FileController@resource');
        $api->post('file', 'FileController@file');
        $api->post('image', 'FileController@image');
        $api->post('avatar', 'FileController@avatar');
        $api->post('picture', 'FileController@picture');
        $api->post('document', 'FileController@document');
      });


      // 平台用户路由
      $api->group(['prefix'  =>  'user'], function ($api) {
        $api->any('list', 'UserController@list');
        $api->get('select', 'UserController@select');
        $api->get('view/{id}', 'UserController@view');
        $api->get('action', 'UserController@action');
        $api->post('handle', 'UserController@handle');
        $api->post('delete', 'UserController@delete');
        $api->get('router', 'UserController@router');
        $api->get('navigation', 'UserController@navigation');
        $api->get('menu', 'UserController@menu');
        $api->any('password', 'UserController@password');
        $api->any('change_password', 'UserController@change_password');

        // 平台用户消息路由
        $api->group(['namespace' => 'User', 'prefix'  =>  'message'], function ($api) {
          $api->any('list', 'MessageController@list');
          $api->post('unread', 'MessageController@unread');
          $api->post('readed', 'MessageController@readed');
          $api->post('delete', 'MessageController@delete');
        });
      });


      // 平台角色路由
      $api->group(['prefix'  =>  'role'], function ($api) {
        $api->any('list', 'RoleController@list');
        $api->get('select', 'RoleController@select');
        $api->get('view/{id}', 'RoleController@view');
        $api->post('handle', 'RoleController@handle');
        $api->post('delete', 'RoleController@delete');
        $api->any('permission/{id}', 'RoleController@permission');
      });


      // 平台菜单路由
      $api->group(['prefix'  =>  'menu'], function ($api) {
        $api->any('list', 'MenuController@list');
        $api->get('select', 'MenuController@select');
        $api->get('view/{id}', 'MenuController@view');
        $api->post('handle', 'MenuController@handle');
        $api->post('delete', 'MenuController@delete');

        $api->any('level', 'MenuController@level');
        $api->post('active', 'MenuController@active');
        $api->post('track', 'MenuController@track');

        // 菜单分类
        $api->group(['namespace' => 'Menu', 'prefix' => 'category'], function ($api) {
          $api->any('list', 'CategoryController@list');
          $api->get('select', 'CategoryController@select');
          $api->get('view/{id}', 'CategoryController@view');
          $api->post('handle', 'CategoryController@handle');
          $api->post('delete', 'CategoryController@delete');
        });
      });


       // 系统配置路由
      $api->group(['prefix'  =>  'config'], function ($api) {
        // 配置管理路由
        $api->any('list', 'ConfigController@list');
        $api->get('select', 'ConfigController@select');
        $api->get('view/{id}', 'ConfigController@view');
        $api->post('handle', 'ConfigController@handle');
        $api->post('delete/{id?}', 'ConfigController@delete');

        // 配置分类管理路由
        $api->group(['namespace' => 'Config', 'prefix'  =>  'category'], function ($api) {
          $api->any('list', 'CategoryController@list');
          $api->get('select', 'CategoryController@select');
          $api->get('view/{id}', 'CategoryController@view');
          $api->get('level', 'CategoryController@level');
          $api->post('handle', 'CategoryController@handle');
          $api->post('delete/{id?}', 'CategoryController@delete');
        });
      });


      // 系统设置路由
      $api->group(['prefix'  =>  'setting'], function ($api) {
        $api->any('data', 'SettingController@data');
      });


      // 系统消息路由
      $api->group(['prefix'  =>  'message'], function ($api) {
        $api->any('list', 'MessageController@list');
        $api->get('view/{id}', 'MessageController@view');
        $api->post('handle', 'MessageController@handle');
        $api->get('type', 'MessageController@type');
        $api->post('readed', 'MessageController@readed');
        $api->post('delete', 'MessageController@delete');
      });

      // 系统日志路由
      $api->group(['namespace' => 'Log', 'prefix'  =>  'log'], function ($api) {
        // 行为日志
        $api->group(['prefix'  =>  'action'], function ($api) {
          $api->any('list', 'ActionController@list');
          $api->get('view/{id}', 'ActionController@view');
          $api->post('delete', 'ActionController@delete');
        });

        // 操作日志
        $api->group(['prefix'  =>  'operate'], function ($api) {
          $api->any('list', 'OperateController@list');
          $api->get('view/{id}', 'OperateController@view');
          $api->post('delete', 'OperateController@delete');
        });
      });
    });


    // --------------------------------------------------
    // 模块路由
    $api->group(['namespace' => 'Module'], function ($api) {

      // 公共路由
      $api->group(['namespace' => 'Common', 'prefix'  =>  'common'], function ($api) {
        $api->get('education/degree', 'EducationController@degree'); // 教育程度路由
        $api->get('national/list', 'NationalController@list'); // 民族路由
        $api->get('area/list', 'AreaController@list'); // 民族路由
      });


      // 关键字路由
      $api->group(['namespace' => 'Keyword', 'prefix' => 'keyword'], function ($api) {
        $api->any('list', 'KeywordController@list');
        $api->get('view/{id}', 'KeywordController@view');
        $api->post('handle', 'KeywordController@handle');
        $api->post('delete', 'KeywordController@delete');
      });


      // 机构路由
      $api->group(['namespace' => 'Organization', 'prefix' => 'organization'], function ($api) {
        $api->any('list', 'OrganizationController@list');
        $api->get('select', 'OrganizationController@select');
        $api->get('view/{id}', 'OrganizationController@view');
        $api->post('handle', 'OrganizationController@handle');
        $api->post('audit', 'OrganizationController@audit');
        $api->post('certification', 'OrganizationController@certification');
        $api->post('export', 'OrganizationController@export');
        $api->post('delete', 'OrganizationController@delete');


        $api->group(['namespace' => 'Relevance'], function ($api) {
          // 机构课程路由
          $api->group(['prefix' => 'course'], function ($api) {
            $api->any('list', 'CourseController@list');
            $api->get('select', 'CourseController@select');
            $api->get('course', 'CourseController@course');
            $api->get('view/{id}', 'CourseController@view');
            $api->post('handle', 'CourseController@handle');
            $api->post('delete/{id?}', 'CourseController@delete');
          });
        });

        // 班级路由
        $api->group(['namespace' => 'Squad', 'prefix' => 'squad'], function ($api) {
          $api->any('list', 'SquadController@list');
          $api->get('view/{id}', 'SquadController@view');
          $api->get('label/{id}', 'SquadController@label');
          $api->post('handle', 'SquadController@handle');
          $api->post('audit', 'SquadController@audit');
          $api->post('status', 'SquadController@status');
          $api->post('export', 'SquadController@export');
          $api->post('delete/{id?}', 'SquadController@delete');
        });
      });


      // 会员路由
      $api->group(['namespace' => 'Member', 'prefix'  =>  'member'], function ($api) {
        $api->any('list', 'MemberController@list');
        $api->get('select', 'MemberController@select');
        $api->get('view/{id}', 'MemberController@view');
        $api->post('status', 'MemberController@status');
        $api->post('handle', 'MemberController@handle');
        $api->any('password', 'MemberController@password');
        $api->post('export', 'MemberController@export');
        $api->post('delete', 'MemberController@delete');

        // 会员角色路由
        $api->group(['prefix'  =>  'role'], function ($api) {
          $api->any('list', 'RoleController@list');
          $api->get('select', 'RoleController@select');
          $api->get('view/{id}', 'RoleController@view');
          $api->post('handle', 'RoleController@handle');
          $api->post('delete', 'RoleController@delete');
          $api->any('permission/{id}', 'RoleController@permission');
        });

        // 会员档案路由
        $api->group(['prefix'  =>  'archive'], function ($api) {
          $api->any('list', 'ArchiveController@list');
          $api->get('view/{id}', 'ArchiveController@view');
          $api->post('handle', 'ArchiveController@handle');
          $api->post('delete', 'ArchiveController@delete');
        });

        // 会员评论路由
        $api->group(['prefix'  =>  'comment'], function ($api) {
          $api->any('list', 'CommentController@list');
          $api->get('view/{id}', 'CommentController@view');
          $api->post('handle', 'CommentController@handle');
          $api->post('delete', 'CommentController@delete');
        });
      });

      // 广告路由
      $api->group(['namespace' => 'Advertising', 'prefix' => 'advertising'], function ($api) {
        // 广告路由
        $api->any('list', 'AdvertisingController@list');
        $api->get('view/{id}', 'AdvertisingController@view');
        $api->get('position', 'AdvertisingController@position');
        $api->post('handle', 'AdvertisingController@handle');
        $api->post('delete', 'AdvertisingController@delete');

        // 广告位路由
        $api->group(['prefix' => 'position'], function ($api) {
          $api->any('list', 'PositionController@list');
          $api->get('view/{id}', 'PositionController@view');
          $api->post('handle', 'PositionController@handle');
          $api->post('delete/{id?}', 'PositionController@delete');
        });
      });


      // 教育中心路由
      $api->group(['namespace' => 'Education', 'prefix' => 'education'], function ($api) {
        // 课程路由
        $api->group(['namespace' => 'Course', 'prefix' => 'course'], function ($api) {
          $api->any('list', 'CourseController@list');
          $api->get('select', 'CourseController@select');
          $api->get('view/{id}', 'CourseController@view');
          $api->get('label/{id}', 'CourseController@label');
          $api->get('type', 'CourseController@type');
          $api->get('structure/{id}', 'CourseController@structure');
          $api->post('handle', 'CourseController@handle');
          $api->post('delete/{id?}', 'CourseController@delete');

          // 课程体验路由
          $api->group(['prefix'  => 'experience'], function ($api) {
            $api->get('view/{id}', 'ExperienceController@view');
            $api->post('handle', 'ExperienceController@handle');
          });

          // 课程单元路由
          $api->group(['prefix'  => 'unit'], function ($api) {
            $api->any('list', 'UnitController@list');
            $api->get('select', 'UnitController@select');
            $api->get('view/{id}', 'UnitController@view');
            $api->get('level', 'UnitController@level');
            $api->post('handle', 'UnitController@handle');
            $api->post('delete/{id?}', 'UnitController@delete');
          });

          // 课程知识点路由
          $api->group(['prefix'  => 'point'], function ($api) {
            $api->any('list', 'PointController@list');
            $api->get('select', 'PointController@select');
            $api->get('view/{id}', 'PointController@view');
            $api->get('level', 'PointController@level');
            $api->post('handle', 'PointController@handle');
            $api->post('delete/{id?}', 'PointController@delete');

            $api->group(['namespace' => 'Point'], function ($api) {
              // 练习题路由
              $api->group(['prefix' => 'question'], function ($api) {
                $api->any('list', 'QuestionController@list');
                $api->get('select', 'QuestionController@select');
                $api->get('view/{id}', 'QuestionController@view');
                $api->get('type', 'QuestionController@type');
                $api->post('choices', 'QuestionController@choices');
                $api->post('mchoices', 'QuestionController@mchoices');
                $api->post('judgement', 'QuestionController@judgement');
                $api->post('connection', 'QuestionController@connection');
                $api->post('compute', 'QuestionController@compute');
                $api->post('special', 'QuestionController@special');
                $api->post('explain', 'QuestionController@explain');
                $api->post('delete/{id?}', 'QuestionController@delete');
              });


              // 知识点重点路由
              $api->group(['prefix'  =>  'emphasis'], function ($api) {
                $api->any('list/{id}', 'EmphasisController@list');
                $api->get('select', 'EmphasisController@select');
              });

              // 知识点练习题关联路由
              $api->group(['namespace' => 'Relevance', 'prefix'  => 'relevance'], function ($api) {
                $api->group(['prefix'  =>  'question'], function ($api) {
                  $api->any('list/{id}', 'QuestionController@list');
                  $api->post('handle', 'QuestionController@handle');
                });
              });
            });
          });

          // 课程标签路由
          $api->group(['prefix'  => 'label'], function ($api) {
            $api->any('list', 'LabelController@list');
            $api->get('select', 'LabelController@select');
            $api->get('view/{id}', 'LabelController@view');
            $api->post('handle', 'LabelController@handle');
            $api->post('delete/{id?}', 'LabelController@delete');
          });

          // 课程资料路由
          $api->group(['prefix'  => 'resource'], function ($api) {
            $api->any('list', 'ResourceController@list');
            $api->get('select', 'ResourceController@select');
            $api->get('view/{id}', 'ResourceController@view');
            $api->post('handle', 'ResourceController@handle');
            $api->post('delete/{id?}', 'ResourceController@delete');

            // 课程资料分类管理路由
            $api->group(['namespace' => 'Resource', 'prefix'  =>  'category'], function ($api) {
              $api->any('list', 'CategoryController@list');
              $api->get('select', 'CategoryController@select');
              $api->get('view/{id}', 'CategoryController@view');
              $api->post('handle', 'CategoryController@handle');
              $api->post('delete/{id?}', 'CategoryController@delete');
            });
          });

          // 考前强化路由
          $api->group(['prefix'  => 'intensify'], function ($api) {
            $api->any('list', 'IntensifyController@list');
            $api->get('select', 'IntensifyController@select');
            $api->get('paper/{id}', 'IntensifyController@paper');
            $api->get('question/{id}', 'IntensifyController@question');
            $api->get('view/{id}', 'IntensifyController@view');
            $api->post('handle', 'IntensifyController@handle');
            $api->post('delete/{id?}', 'IntensifyController@delete');

            // 考前强化分类管理路由
            $api->group(['namespace' => 'Intensify', 'prefix'  =>  'category'], function ($api) {
              $api->any('list', 'CategoryController@list');
              $api->get('select', 'CategoryController@select');
              $api->get('view/{id}', 'CategoryController@view');
              $api->post('handle', 'CategoryController@handle');
              $api->post('delete/{id?}', 'CategoryController@delete');
            });

            // 强化题路由
            $api->group(['namespace' => 'Intensify', 'prefix' => 'question'], function ($api) {
              $api->any('list', 'QuestionController@list');
              $api->get('select', 'QuestionController@select');
              $api->get('view/{id}', 'QuestionController@view');
              $api->get('type', 'QuestionController@type');
              $api->post('choices', 'QuestionController@choices');
              $api->post('mchoices', 'QuestionController@mchoices');
              $api->post('judgement', 'QuestionController@judgement');
              $api->post('connection', 'QuestionController@connection');
              $api->post('compute', 'QuestionController@compute');
              $api->post('special', 'QuestionController@special');
              $api->post('explain', 'QuestionController@explain');
              $api->post('delete/{id?}', 'QuestionController@delete');
            });
          });



          $api->group(['namespace' => 'Relevance', 'prefix'  => 'relevance'], function ($api) {
            // 课程练习题关联路由
            $api->group(['prefix'  =>  'question'], function ($api) {
              $api->any('list/{id}', 'QuestionController@list');
              $api->post('handle', 'QuestionController@handle');
            });

            // 课程资料关联路由
            $api->group(['prefix'  =>  'resource'], function ($api) {
              $api->any('list/{id}', 'ResourceController@list');
              $api->post('handle', 'ResourceController@handle');
            });
          });
        });



        // 结业路由
        $api->group(['namespace' => 'Graduation', 'prefix'  => 'graduation'], function ($api) {
          $api->any('list', 'GraduationController@list');
          $api->get('select', 'GraduationController@select');
          $api->get('view/{id}', 'GraduationController@view');
          $api->post('audit', 'GraduationController@audit');
          $api->post('handle', 'GraduationController@handle');
          $api->post('delete/{id?}', 'GraduationController@delete');
        });

        // 作业路由
        $api->group(['namespace' => 'Homework', 'prefix'  => 'homework'], function ($api) {
          $api->any('list', 'HomeworkController@list');
          $api->get('select', 'HomeworkController@select');
          $api->get('view/{id}', 'HomeworkController@view');
          $api->post('handle', 'HomeworkController@handle');
          $api->post('delete/{id?}', 'HomeworkController@delete');
        });

        // 试卷路由
        $api->group(['namespace' => 'Paper', 'prefix'  => 'paper'], function ($api) {
          $api->any('list', 'PaperController@list');
          $api->get('select', 'PaperController@select');
          $api->get('view/{id}', 'PaperController@view');
          $api->get('statistical/{id}', 'PaperController@statistical');
          $api->post('handle', 'PaperController@handle');
          $api->post('delete/{id?}', 'PaperController@delete');

          // 试题路由
          $api->group(['prefix' => 'question'], function ($api) {
            $api->any('list', 'QuestionController@list');
            $api->get('select', 'QuestionController@select');
            $api->get('view/{id}', 'QuestionController@view');
            $api->get('type', 'QuestionController@type');
            $api->post('choices', 'QuestionController@choices');
            $api->post('mchoices', 'QuestionController@mchoices');
            $api->post('judgement', 'QuestionController@judgement');
            $api->post('connection', 'QuestionController@connection');
            $api->post('compute', 'QuestionController@compute');
            $api->post('special', 'QuestionController@special');
            $api->post('delete/{id?}', 'QuestionController@delete');
          });
        });
      });


      // 消息路由
      $api->group(['namespace' => 'Message', 'prefix'  =>  'notice'], function ($api) {
        $api->any('list', 'MessageController@list');
        $api->get('view/{id}', 'MessageController@view');
        $api->post('handle', 'MessageController@handle');
        $api->post('delete/{id?}', 'MessageController@delete');
      });

      // 统计路由
      $api->group(['namespace' => 'Statistical', 'prefix' => 'statistical'], function ($api) {

        // 关键字统计路由
        $api->group(['prefix' => 'keyword'], function ($api) {
          $api->any('list', 'KeywordController@list');
        });

        // 在线会员路由
        $api->group(['prefix' => 'online'], function ($api) {
          $api->any('list', 'OnlineController@list');
        });
      });
    });
  });
});
