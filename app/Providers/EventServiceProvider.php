<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        // 热门搜索
        'App\Events\Api\KeywordEvent' => [
            'App\Listeners\Api\KeywordListeners',
        ],

        // 记录用户行为日志
        'App\Events\Platform\UserActionLogEvent' => [
            'App\Listeners\Platform\UserActionLogListeners',
        ],

        // 记录机构操作日志
        'App\Events\Api\Organization\OperateLogEvent' => [
            'App\Listeners\Api\Organization\OperateLogListeners',
        ],

        // 发送短信
        'App\Events\Common\Message\SmsEvent' => [
            'App\Listeners\Common\Message\SmsListeners',
        ],

        // 短信验证码
        'App\Events\Common\Sms\CodeEvent' => [
            'App\Listeners\Common\Sms\CodeListeners',
        ],

        // 发送邮件
        'App\Events\Common\Message\EmailEvent' => [
            'App\Listeners\Common\Message\EmailListeners',
        ],

        // 学习进度记录
        'App\Events\Api\Member\Study\ProgressEvent' => [
            'App\Listeners\Api\Member\Study\ProgressListeners',
        ],

        // 在线人数统计
        'App\Events\Api\Member\OnlineEvent' => [
            'App\Listeners\Api\Member\OnlineListeners',
        ],


        // 微信登录
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            'SocialiteProviders\Weixin\WeixinExtendSocialite@handle',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
