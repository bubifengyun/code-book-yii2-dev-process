<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Overleave */

$this->title = 'Update Overleave: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Overleaves', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="overleave-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
