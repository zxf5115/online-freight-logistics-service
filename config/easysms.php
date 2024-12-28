<?php
return [
  // HTTP 请求的超时时间（秒）
  'timeout' => 5.0,

  // 默认发送配置
  'default' => [
    // 网关调用策略，默认：顺序调用
    'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

    // 默认可用的发送网关
    'gateways' => [
      'aliyun',
    ],
  ],

  // 可用的网关配置
  'gateways' => [
    'errorlog' => [
      'file' => storage_path().'/sms/easy-sms.log',
    ],

    'aliyun' => [
        'access_key_id' => 'LTAI4GGhgnv2VrY9MF4XGWJP',
        'access_key_secret' => '0y26t2lUSmSg1qZb97rK4T6Tm6wMwI',
        'sign_name' => '均衡营养云职业服务平台',
    ],
  ],
];
