
<div id="main" class="main">
<div id="mainbody" class="mainbody">
<table class="tsel" border="0" width="100%">
<tr>
<td valign="top" align="center" width="50%">
<table class="tsel" border="0">
<tr>
<?php
    //common\assets\Html5CamQrcodeAsset::register($this);
    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@common/assets');
?>
<td><img class="selector" id="webcamimg" src="<?= $directoryAsset ?>/images/vid.png" onclick="setwebcam()" align="left" /></td>
<td><img class="selector" id="qrimg" src="<?= $directoryAsset ?>/images/cam.png" onclick="setimg()" align="right"/></td></tr>
<tr><td colspan="2" align="center">
<div id="outdiv" class="outdiv">
</div></td></tr>
</table>
</td>
</tr>
<tr><td colspan="3" align="center">
<img src="<?= $directoryAsset ?>/images/down.png"/>
</td></tr>
<tr><td colspan="3" align="center">
<div id="result" class="result"></div>
</td></tr>
</table>
</div>&nbsp;
</div>
    <canvas id="qr-canvas" class="qr-canvas" width="<?=$width ?>" height="<?= $height ?>"></canvas>
