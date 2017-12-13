<?php

namespace common\assets;

use yii\web\AssetBundle;

class WebRTCLocalIPAsset extends AssetBundle
{
    public $sourcePath = '@common/assets';
    public $css = [];
    public $js = [
        'js/webrtclocalip.js',
    ];
}
