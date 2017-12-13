<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Sentry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sentry-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($gate, 'person_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('记录', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
