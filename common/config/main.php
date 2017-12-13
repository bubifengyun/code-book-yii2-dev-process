<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => ['log', 'thumbnail'],
    'language' => 'zh-CN',
    'timeZone' => 'Asia/Shanghai',
    'components' => [
        'urlManager' => [
                'enablePrettyUrl' => true,
                'rules' => [
                ],
        ],
        'thumbnail' => [
            'class' => 'himiklab\thumbnail\EasyThumbnail',
            'cacheAlias' => 'assets/gallery_thumbnails',
        ],
        'setting' => [
            'class' => 'common\components\Setting',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
    ],
    /*
    'modules' => [
        'treemanager' =>  [
            'class' => '\frontend\modules\yii2TreeManager\Module',
        ],
    ],
     */
];
