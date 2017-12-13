<?php

use yii\helpers\Html;

?>

<div class="login-box">
<h3>检测到您的浏览器为IE浏览器</h3>
使用IE浏览器，可能影响本网站的内容显示。
<br>
建议下载<strong>火狐或谷歌浏览器</strong>
    <div class="login-box-body">
<pre>
<strong>附件</strong>
<strong>
<?= Html::a('火狐浏览器XP32位.exe', ['site/download', 'filename' => 'firefox32.exe'], ['class' => 'profile-link']) ?>
<br>
<?= Html::a('火狐浏览器64位.exe', ['site/download', 'filename' => 'firefox64.exe'], ['class' => 'profile-link']) ?>
<br>
<?= Html::a('谷歌浏览器XP32位.exe', ['site/download', 'filename' => 'chrome32.exe'], ['class' => 'profile-link']) ?>
<br>
<?= Html::a('谷歌浏览器64位.exe', ['site/download', 'filename' => 'chrome64.exe'], ['class' => 'profile-link']) ?>
</strong>
</pre>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
