<?php


/**
 * 支付宝沙箱环境链接：https://openhome.alipay.com/platform/appDaily.htm?tab=info 
 * 公钥生成 https://opendocs.alipay.com/open/291/introduce
 * 通过上诉网址的公钥生成密钥
 * 'app_id' => '支付宝沙箱appid',
 * 'ali_public_key' => '支付宝沙箱显示的公钥',
 * 'private_key' => '刚刚生成的私钥',    
 */
return [
    'alipay' => [
        'app_id'         => env('ALIPAY_APP_ID'),
        'ali_public_key' => env('ALIPAY_PUBLIC_KEY'),
        'private_key'    => env('ALIPAY_PRIVATE_KEY'),
        'log'            => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id'      => env('WECHAT_PAY_APP_ID'),
        'mch_id'      => env('WECHAT_PAY_MCH_ID'),
        'key'         => env('WECHAT_PAY_KEY'),
        'cert_client' => resource_path('wechat_pay/apiclient_cert.pem'),
        'cert_key'    => resource_path('wechat_pay/apiclient_key.pem'),
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];