<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use common\components\Html5CamQrcodeWidget;
use yii\helpers\Url;

$this->title = '关于';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
<?php
echo Html5CamQrcodeWidget::widget([
]);
?>
</div>
