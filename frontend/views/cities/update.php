<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Cities */

$this->title = '修改市名: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '全部地级市', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="cities-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
