<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Personinfo */

$this->title = '更新：' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '所有人员', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="personinfo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
