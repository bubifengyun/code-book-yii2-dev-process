<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ReadyWarSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ready-war-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'begin_date') ?>

    <?= $form->field($model, 'end_date') ?>

    <?= $form->field($model, 'ratio_land_officer') ?>

    <?php // echo $form->field($model, 'ratio_air_officer') ?>

    <?php // echo $form->field($model, 'ratio_soldier') ?>

    <?php // echo $form->field($model, 'ratio_officer') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
