<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Sentry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sentry-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'host')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('开始履行职责', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
