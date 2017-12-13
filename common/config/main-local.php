<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => env('DB_DSN'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'charset' => 'utf8',
            'tablePrefix' => env('DB_TABLE_PREFIX'),
            'enableSchemaCache' => YII_ENV_PROD,
        ],
        /*
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=db_wuzhishan;port=3306',
            'username' => 'litianci',
            'password' => 'litianci',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
            'enableSchemaCache' => YII_ENV_PROD,
        ],
         */
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => env('MAIL_USERNAME')
            ],
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => env('MAIL_HOST'),
                'username' => env('MAIL_USERNAME'),
                'password' => env('MAIL_PASSWORD'),
                'port' => env('MAIL_PORT'),
                'encryption' => env('MAIL_ENCRYPTION')
            ],
        ],
        /*
        'xunsearch' => [
            'class' => 'hightman\xunsearch\Connection',
            'iniDirectory' => '@common/config',
            // 搜索 ini 文件目录，默认：@vendor/hightman/xunsearch/app
            'charset' => 'utf-8',
            // 指定项目使用的默认编码，默认即时 utf-8，可不指定
        ],
         */
    ],
];
