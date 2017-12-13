<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Gate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'person_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'leave_time')->textInput() ?>

    <?= $form->field($model, 'leave_sentry')->textInput() ?>

    <?= $form->field($model, 'leave_host')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'come_time')->textInput() ?>

    <?= $form->field($model, 'come_sentry')->textInput() ?>

    <?= $form->field($model, 'come_host')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'has_completed')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
