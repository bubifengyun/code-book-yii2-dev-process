<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Holiday */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="holiday-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date_leave')->textInput(['readonly'=>'readonly']) ?>

    <?= $form->field($model, 'which_year')->textInput(['readonly'=>'readonly']) ?>

    <?= $form->field($model, 'date_come')->textInput(['readonly'=>'readonly']) ?>

    <?= $form->field($model, 'date_cancel')->widget(
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

    <?= $form->field($model, 'where_leave')->textInput(['readonly'=>'readonly']) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kind')->dropDownList(\common\models\Lookup::StatusHoliday()) ?>

    <div class="form-group">
        <?= Html::submitButton('销假', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
