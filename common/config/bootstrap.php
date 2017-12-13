<?php
Yii::$classMap['yii\helpers\Html'] = '@common/helpers/Html.php';
Yii::$classMap['yii\helpers\Markdown'] = '@common/helpers/Markdown.php';

Yii::setAlias('root', dirname(dirname(__DIR__)));
Yii::setAlias('common', dirname(__DIR__));
Yii::setAlias('frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('database', dirname(dirname(__DIR__)) . '/database');
Yii::setAlias('api', dirname(dirname(__DIR__)) . '/api');

Yii::setAlias('storagePath', '@root/web/storage');
Yii::setAlias('storageUrl', env('SITE_URL') . '/storage');
