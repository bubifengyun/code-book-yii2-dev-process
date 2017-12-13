<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class EchartsAsset extends AssetBundle
{
    public $sourcePath = '@bower/echarts/dist';
    public $js = [
        'echarts.js',
    ];
}
