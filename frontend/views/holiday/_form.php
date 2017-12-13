<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Holiday */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="holiday-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_leave')->textInput() ?>

    <?= $form->field($model, 'which_year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_come')->textInput() ?>

    <?= $form->field($model, 'date_cancel')->textInput() ?>

    <?= $form->field($model, 'boss_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'where_leave')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kind')->textInput() ?>

    <?= $form->field($model, 'paper')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
