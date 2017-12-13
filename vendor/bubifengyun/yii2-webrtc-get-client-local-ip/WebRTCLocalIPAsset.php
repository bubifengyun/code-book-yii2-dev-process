<?php

namespace bubifengyun\WebrtcGetClientLocalIp;

use yii\web\AssetBundle;

class WebRTCLocalIPAsset extends AssetBundle
{
    public $sourcePath = __dir__;
    public $css = [];
    public $js = [
        'js/webrtclocalip.js',
    ];
}
