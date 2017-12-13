<?php

use kartik\dialog\Dialog;
use yii\helpers\Url;
 
if ($model == '.' or $model == '..') {
    return;
}
 
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist/');
$url = Url::to(['change-avatar', 'avatar' => $model]);

$btns = <<< HTML
<a type="button" href=$url>
    <img src="$directoryAsset/img/$model" alt="没有头像"/>
</a>
HTML;

echo $btns;
