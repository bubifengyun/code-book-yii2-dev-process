<?php

namespace common\assets;

use yii\web\AssetBundle;

class Html5CamQrcodeAsset extends AssetBundle
{
    public $sourcePath = '@common/assets';
    public $css = [
        'css/html5camqrcode.css',
    ];
    public $js = [
        'js/llqrcode.js',
        'js/plusone.js',
        'js/webqr.js',
        'js/ga.js',
    ];
}
