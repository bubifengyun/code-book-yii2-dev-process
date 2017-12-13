<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StatisticsHoliday */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="statistics-holiday-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'day_total')->textInput() ?>

    <?= $form->field($model, 'day_left')->textInput() ?>

    <?= $form->field($model, 'day_tohere')->textInput() ?>

    <?= $form->field($model, 'boss_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'current_h_id')->textInput() ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'day_add')->textInput() ?>

    <?= $form->field($model, 'day_add_is_nextyear')->textInput() ?>

    <?= $form->field($model, 'day_add_ps')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'day_path')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
