<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
  'namespace'  =>  'Api',
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
      $api->post('sms_login', 'LoginController@sms_login');
      $api->post('sms_code', 'LoginController@sms_code');
      $api->post('register', 'LoginController@register');
      $api->get('logout', 'LoginController@logout');
      $api->get('check_user_login', 'LoginController@check_user_login'); // 验证是否登录
      $api->get('/me', 'LoginController@me'); // 获取用户信息

      // 第三方登录-微信
      $api->get('weixin_login', 'LoginController@weixin_login');
      $api->get('weixin_redirect', 'LoginController@weixin_redirect');


      // 注册路由
      $api->group(['prefix'  =>  'member'], function ($api) {
        $api->post('register', 'RegisterController@register');
        $api->post('register_first_step', 'RegisterController@register_first_step');
        $api->post('register_second_step', 'RegisterController@register_second_step');
        $api->post('sms_code', 'RegisterController@sms_code');
        $api->post('validation_code', 'RegisterController@validation_code');
      });



      // 系统路由
      $api->group(['prefix' => 'system'], function ($api) {
        // 系统信息路由
        $api->get('kernel', 'SystemController@kernel');
        // 首页统计路由
        $api->get('data', 'SystemController@data');
      });

      // 文件上传路由
      $api->group(['prefix' => 'file'], function ($api) {
        $api->post('avatar', 'FileController@avatar');
        $api->post('picture', 'FileController@picture');
        $api->post('answer', 'FileController@answer');
        $api->post('business_license', 'FileController@business_license');
      });
    });




    // --------------------------------------------------
    // 模块路由
    $api->group(['namespace' => 'Module'], function ($api) {

      // 公共路由
      $api->group(['namespace' => 'Common', 'prefix' => 'common'], function ($api) {

        // 类型路由
        $api->group(['prefix' => 'type'], function ($api) {
          $api->get('course', 'TypeController@course');
        });

        // 地区路由
        $api->group(['prefix' => 'area'], function ($api) {
          $api->get('list', 'AreaController@list');
        });
      });

      // 关键字路由
      $api->group(['namespace' => 'Keyword', 'prefix' => 'keyword'], function ($api) {
        $api->any('list', 'KeywordController@list');
        $api->get('select', 'KeywordController@select');
      });

      // 探针路由
      $api->group(['namespace' => 'Probe', 'prefix' => 'probe'], function ($api) {
        $api->get('search', 'ProbeController@search');
        $api->post('handle', 'ProbeController@handle');
      });

      // 消息路由
      $api->group(['namespace' => 'Message', 'prefix' => 'message', 'middleware' => ['auth:api', 'refresh.token']], function ($api) {
        $api->get('list', 'MessageController@list');
        $api->get('select', 'MessageController@select');
        $api->get('view/{id}', 'MessageController@view');
        $api->post('handle', 'MessageController@handle');
      });

      // 机构路由
      $api->group(['namespace' => 'Organization', 'prefix' => 'organization'], function ($api) {
        $api->get('list', 'OrganizationController@list');
        $api->get('select', 'OrganizationController@select');
        $api->get('export', 'OrganizationController@export');
        $api->get('view/{id}', 'OrganizationController@view');
        $api->post('certification', 'OrganizationController@certification');
        $api->post('handle', 'OrganizationController@handle');
        $api->post('apply_first_step', 'OrganizationController@apply_first_step');
        $api->post('apply_second_step', 'OrganizationController@apply_second_step');

        // 机构课程路由
        $api->group(['namespace' => 'Relevance', 'prefix' => 'course', 'middleware' => ['auth:api', 'refresh.token']], function ($api) {
          $api->get('list', 'CourseController@list');
          $api->get('select', 'CourseController@select');
          $api->get('watch', 'CourseController@watch');
        });


        // 班级路由
        $api->group(['namespace' => 'Squad', 'prefix' => 'squad', 'middleware' => ['auth:api', 'refresh.token']], function ($api) {
          $api->get('list', 'SquadController@list');
          $api->get('select', 'SquadController@select');
          $api->get('view/{id}', 'SquadController@view');
          $api->post('course', 'SquadController@course');
          $api->post('apply_first_step', 'SquadController@apply_first_step');
          $api->post('apply_second_step', 'SquadController@apply_second_step');
          $api->post('apply_third_step', 'SquadController@apply_third_step');
          $api->post('apply_fourth_step', 'SquadController@apply_fourth_step');
          $api->post('again_add_student', 'SquadController@again_add_student');
          $api->post('change_end_time', 'SquadController@change_end_time');
          $api->post('change_status', 'SquadController@change_status');
          $api->post('status', 'SquadController@status');

          // 机构班级学习中心
          $api->group(['prefix' => 'study'], function ($api) {
            $api->get('center/{squad_id}', 'StudyController@center');
            $api->get('view/{squad_id}', 'StudyController@view');

            $api->group(['namespace' => 'Study', 'prefix' => 'statistical'], function ($api) {
              $api->get('list/{squad_id}', 'StatisticalController@list');
            });
          });

          // 机构班级成绩
          $api->group(['prefix' => 'grade'], function ($api) {
            $api->get('center/{squad_id}', 'GradeController@center');


            $api->group(['namespace' => 'Grade'], function ($api) {
              $api->get('class_after_question/{squad_id}', 'DetailController@class_after_question');
              $api->get('comprehensive_question/{squad_id}', 'DetailController@comprehensive_question');
              $api->get('simulation_exam/{squad_id}', 'DetailController@simulation_exam');
            });
          });

          // 班级会员路由
          $api->group(['namespace' => 'Relevance', 'prefix' => 'member'], function ($api) {
            $api->get('teacher', 'MemberController@teacher');
            $api->get('student', 'MemberController@student');
            $api->get('roster', 'MemberController@roster');
            $api->get('export', 'MemberController@export');
            $api->post('graduation', 'MemberController@graduation');
            $api->post('ungraduation', 'MemberController@ungraduation');
          });

          // 班级已选课程路由
          $api->group(['namespace' => 'Relevance', 'prefix' => 'course'], function ($api) {
            $api->get('select', 'CourseController@select');
          });
        });
      });

      // 会员路由
      $api->group(['namespace' => 'Member', 'prefix'  =>  'member'], function ($api) {
        $api->get('archive/{id}', 'MemberController@archive')->middleware(['auth:api', 'refresh.token']);
        $api->get('view/{id}', 'MemberController@view');
        $api->get('user_info', 'MemberController@user_info');
        $api->post('handle', 'MemberController@handle');
        $api->post('delete', 'MemberController@delete');
        $api->post('password', 'MemberController@password');
        $api->post('reset_code', 'MemberController@reset_code');
        $api->post('back_mobile', 'MemberController@back_mobile');
        $api->post('email_code', 'MemberController@email_code');
        $api->post('back_email', 'MemberController@back_email');
        $api->post('status', 'MemberController@status');
        $api->post('role', 'MemberController@role');
        $api->get('teacher', 'MemberController@teacher');
        $api->get('director', 'MemberController@director');
        $api->post('generate', 'MemberController@generate');
        $api->post('certification', 'MemberController@certification');
        $api->post('change_code', 'MemberController@change_code');
        $api->post('change_username', 'MemberController@change_username');

        // 会员学习中心
        $api->group(['namespace' => 'Study', 'prefix' => 'study'], function ($api) {
          $api->get('center', 'StudyController@center');
          $api->post('start_study', 'StudyController@start_study');
          $api->post('point_study', 'StudyController@point_study');
          $api->post('end_study', 'StudyController@end_study');
          $api->post('finish', 'StudyController@finish');
          $api->post('already_study_time', 'StudyController@already_study_time');
          $api->get('is_first', 'StudyController@is_first');

          // 会员学习进度中心
          $api->group(['namespace' => 'Progress', 'prefix' => 'progress'], function ($api) {
            $api->group(['prefix' => 'course'], function ($api) {
              $api->get('list', 'CourseController@list');

              $api->group(['prefix' => 'unit'], function ($api) {
                $api->get('list', 'UnitController@list');

                $api->group(['prefix' => 'point'], function ($api) {
                  $api->get('list', 'PointController@list');
                });
              });
            });
          });
        });

        // 会员班级中心
        $api->group(['namespace' => 'Squad', 'prefix' => 'squad'], function ($api) {
          $api->get('list', 'SquadController@list');
          $api->get('select', 'SquadController@select');
          $api->get('view', 'SquadController@view');
        });

        // 会员成绩中心
        $api->group(['namespace' => 'Grade', 'prefix' => 'grade'], function ($api) {
          $api->get('center', 'GradeController@center');
          $api->get('class_after_question', 'GradeController@class_after_question');
          $api->get('class_after_question_detail', 'GradeController@class_after_question_detail');
          $api->get('comprehensive_question', 'GradeController@comprehensive_question');
          $api->get('comprehensive_question_detail', 'GradeController@comprehensive_question_detail');
          $api->get('simulation_exam', 'GradeController@simulation_exam');
        });

        // 会员课程路由
        $api->group(['namespace' => 'Course', 'prefix'  =>  'course', 'middleware' => ['auth:api', 'refresh.token']], function ($api) {
          $api->get('list', 'CourseController@list');
          $api->get('select', 'CourseController@select');
          $api->get('data', 'CourseController@data');
          $api->get('status/{id}', 'CourseController@status');
          $api->post('handle', 'CourseController@handle');
        });

        // 会员知识点路由
        $api->group(['namespace' => 'Point', 'prefix'  =>  'point', 'middleware' => ['auth:api', 'refresh.token']], function ($api) {
          $api->get('list', 'PointController@list');
          $api->get('select', 'PointController@select');
          $api->get('status/{id}', 'PointController@status');
          $api->post('handle', 'PointController@handle');
        });

        // 会员笔记路由
        $api->group(['namespace' => 'Note', 'prefix'  =>  'note', 'middleware' => ['auth:api', 'refresh.token']], function ($api) {
          $api->get('list', 'NoteController@list');
          $api->get('select', 'NoteController@select');
          $api->get('view/{id}', 'NoteController@view');
          $api->post('handle', 'NoteController@handle');
        });

        // 会员作业路由
        $api->group(['namespace' => 'Homework', 'prefix'  => 'homework', 'middleware' => ['auth:api', 'refresh.token']], function ($api) {
          $api->get('list', 'HomeworkController@list');
          $api->get('select', 'HomeworkController@select');
          $api->get('view/{id}', 'HomeworkController@view');
          $api->post('handle', 'HomeworkController@handle');
          $api->post('correct', 'HomeworkController@correct');
        });

        // 会员课后练习题路由
        $api->group(['namespace' => 'Point', 'prefix'  => 'point', 'middleware' => ['auth:api', 'refresh.token']], function ($api) {

          $api->group(['namespace' => 'Relevance', 'prefix'  => 'question'], function ($api) {
            $api->post('handle', 'QuestionController@handle');
          });
        });

        // 会员强化练习题路由
        $api->group(['namespace' => 'Intensify', 'prefix'  => 'intensify', 'middleware' => ['auth:api', 'refresh.token']], function ($api) {
          $api->group(['namespace' => 'Relevance', 'prefix'  => 'question'], function ($api) {
            $api->post('handle', 'QuestionController@handle');
          });
        });

        // 会员试卷路由
        $api->group(['namespace' => 'Paper', 'prefix'  => 'paper', 'middleware' => ['auth:api', 'refresh.token']], function ($api) {
          $api->get('list', 'PaperController@list');
          $api->get('select', 'PaperController@select');
          $api->get('view/{id}', 'PaperController@view');
          $api->post('handle', 'PaperController@handle');
        });

        // 会员消息路由
        $api->group(['namespace' => 'Message', 'prefix'  => 'message', 'middleware' => ['auth:api', 'refresh.token']], function ($api) {
          $api->get('list', 'MessageController@list');
          $api->get('select', 'MessageController@select');
        });

        // 评论路由
        $api->group(['namespace' => 'Comment', 'prefix'  => 'comment', 'middleware' => ['auth:api', 'refresh.token']], function ($api) {
          $api->get('list', 'CommentController@list');
          $api->get('select', 'CommentController@select');
          $api->get('view/{id}', 'CommentController@view');
          $api->post('handle', 'CommentController@handle');
          $api->post('delete/{id?}', 'CommentController@delete');
        });
      });

      // 签到路由
      $api->group(['namespace' => 'Signature', 'prefix'  => 'signature', 'middleware' => ['auth:api', 'refresh.token']], function ($api) {
        $api->get('list', 'SignatureController@list');
        $api->get('select', 'SignatureController@select');
        $api->get('view/{id}', 'SignatureController@view');
        $api->get('status', 'SignatureController@status');
        $api->post('handle', 'SignatureController@handle');
      });

      // 广告路由
      $api->group(['namespace' => 'Advertising', 'prefix' => 'advertising'], function ($api) {
        $api->get('list', 'AdvertisingController@list');
        $api->get('select', 'AdvertisingController@select');
        $api->get('view/{id}', 'AdvertisingController@view');
        $api->get('video', 'AdvertisingController@video');
        $api->get('login', 'AdvertisingController@login');
        $api->get('course', 'AdvertisingController@course');
      });


      // 教育中心路由
      $api->group(['namespace' => 'Education', 'prefix' => 'education'], function ($api) {
        // 课程路由
        $api->group(['namespace' => 'Course', 'prefix' => 'course'], function ($api) {
          $api->any('list', 'CourseController@list');
          $api->get('select', 'CourseController@select');
          $api->get('recommend', 'CourseController@recommend');
          $api->post('similarity', 'CourseController@similarity');
          $api->post('column', 'CourseController@column');
          $api->get('view/{id}', 'CourseController@view');

          // 课程体验路由
          $api->group(['prefix'  => 'experience'], function ($api) {
            $api->get('view/{id}', 'ExperienceController@view');
          });


          // 课程单元路由
          $api->group(['prefix'  => 'unit'], function ($api) {
            $api->any('list', 'UnitController@list');
            $api->get('select', 'UnitController@select');
            $api->get('view/{id}', 'UnitController@view');
            $api->post('index', 'UnitController@index');
          });

          // 课程知识点路由
          $api->group(['prefix'  => 'point'], function ($api) {
            $api->any('list', 'PointController@list');
            $api->get('select', 'PointController@select');
            $api->get('recommend', 'PointController@recommend');
            $api->post('similarity', 'PointController@similarity');
            $api->get('view/{id}', 'PointController@view');
            $api->get('detail/{unit_id}', 'PointController@detail');

            $api->group(['namespace' => 'Point'], function ($api) {
              // 练习题路由
              $api->group(['prefix' => 'question'], function ($api) {
                $api->get('view/{id}', 'QuestionController@view');

                // 回答练习题
                $api->group(['namespace' => 'Relevance'], function ($api) {
                  $api->post('reply', 'QuestionController@reply');
                });
              });


              // 知识点重点路由
              $api->group(['prefix'  =>  'emphasis'], function ($api) {
                $api->any('list', 'EmphasisController@list');
                $api->get('select', 'EmphasisController@select');
                $api->get('view/{id}', 'EmphasisController@view');
                $api->post('handle', 'EmphasisController@handle');
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
          });

          // 课程资料路由
          $api->group(['prefix'  => 'resource'], function ($api) {
            $api->any('list', 'ResourceController@list');
            $api->get('select', 'ResourceController@select');
            $api->get('view/{id}', 'ResourceController@view');
            $api->post('handle', 'ResourceController@handle');
            $api->post('delete/{id?}', 'ResourceController@delete');
          });

          $api->group(['namespace' => 'Relevance'], function ($api) {
            // 课程练习题关联路由
            $api->group(['prefix'  =>  'question'], function ($api) {
              $api->any('list/{id}', 'QuestionController@list');
              $api->post('handle', 'QuestionController@handle');
            });
          });

          // 课程知识地图路由
          $api->group(['prefix'  => 'tree'], function ($api) {
            $api->get('select', 'TreeController@select');
          });


          // 考前强化路由
          $api->group(['prefix'  => 'intensify'], function ($api) {
            $api->any('list', 'IntensifyController@list');
            $api->get('select', 'IntensifyController@select');
            $api->get('paper/{id}', 'IntensifyController@paper');
            $api->get('question/{id}', 'IntensifyController@question');
            $api->get('view/{id}', 'IntensifyController@view');

            // 考前强化分类管理路由
            $api->group(['namespace' => 'Intensify', 'prefix'  =>  'intensify'], function ($api) {
              $api->get('select', 'IntensifyController@select');
              $api->get('view/{id}', 'IntensifyController@view');
            });
          });



        });

        // 班级路由
        $api->group(['namespace' => 'Squad', 'prefix' => 'squad', 'middleware' => ['auth:api', 'refresh.token']], function ($api) {
          $api->any('list', 'SquadController@list');
          $api->get('view/{id}', 'SquadController@view');
          $api->get('label/{id}', 'SquadController@label');
          $api->post('handle', 'SquadController@handle');
          $api->post('delete/{id?}', 'SquadController@delete');
        });

        // 练习题路由
        $api->group(['namespace' => 'Question', 'prefix' => 'question', 'middleware' => ['auth:api', 'refresh.token']], function ($api) {
          $api->any('list', 'QuestionController@list');
          $api->get('view/{id}', 'QuestionController@view');
          $api->get('type', 'QuestionController@type');
          $api->post('handle', 'QuestionController@handle');
          $api->post('delete/{id?}', 'QuestionController@delete');
        });

        // 结业路由
        $api->group(['namespace' => 'Graduation', 'prefix'  => 'graduation', 'middleware' => ['auth:api', 'refresh.token']], function ($api) {
          $api->get('view/{id}', 'GraduationController@view');
          $api->get('status', 'GraduationController@status');
          $api->post('apply_first_step', 'GraduationController@apply_first_step');
          $api->post('apply_second_step', 'GraduationController@apply_second_step');
        });

        // 作业路由
        $api->group(['namespace' => 'Homework', 'prefix'  => 'homework', 'middleware' => ['auth:api', 'refresh.token']], function ($api) {
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
        });
      });
    });
  });
});
