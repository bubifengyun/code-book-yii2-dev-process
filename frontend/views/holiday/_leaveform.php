<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Holiday */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="holiday-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date_leave')->widget(
        'kartik\date\DatePicker',
        [
            'options' => ['placeholder' => '选择日期'],
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'php:Y-m-d',
                'todayHighlight' => true,
            ]
        ]
    ) ?>

    <?= $form->field($model, 'kind')->dropDownList(\common\models\Lookup::StatusHoliday(), ['prompt' => '']) ?>

    <?= $form->field($model, 'date_come')->widget(
        'kartik\date\DatePicker',
        [
            'options' => ['placeholder' => '选择日期'],
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'php:Y-m-d',
                'todayHighlight' => true,
            ]
        ]
    ) ?>

    <?= $form->field($model, 'where_leave')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '休假' : '更改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
