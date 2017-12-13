<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\HolidaySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="holiday-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'h_id') ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date_leave') ?>

    <?= $form->field($model, 'which_year') ?>

    <?= $form->field($model, 'date_come') ?>

    <?php // echo $form->field($model, 'date_cancel') ?>

    <?php // echo $form->field($model, 'boss_id') ?>

    <?php // echo $form->field($model, 'where_leave') ?>

    <?php // echo $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'kind') ?>

    <?php // echo $form->field($model, 'paper') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
