<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Provinces */

$this->title = '修改省份: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '全部省份', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="provinces-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
