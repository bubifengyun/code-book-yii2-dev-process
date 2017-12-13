<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ReadyWar */

$this->title = '设置日期: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '设置';
?>
<div class="ready-war-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
