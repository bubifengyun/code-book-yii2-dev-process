<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Lookup;

/* @var $this yii\web\View */
/* @var $model common\models\Sentry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sentry-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'user_id')->dropDownList(Lookup::Users(), ['prompt' => '']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'host')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '更改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
