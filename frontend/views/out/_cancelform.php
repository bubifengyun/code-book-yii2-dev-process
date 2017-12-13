<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Out */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="out-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'time_leave')->textInput(['readonly'=>'readonly']) ?>

    <?= $form->field($model, 'time_come')->textInput(['readonly'=>'readonly']) ?>

    <?= $form->field($model, 'time_cancel')->widget(
        'kartik\datetime\DateTimePicker',
        [
            'options' => ['placeholder' => '选择日期时间'],
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'php:Y-m-d H:i:s',
                'startDate' => '01-Mar-2014 12:00 AM',
                'todayHighlight' => true,
            ],
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('销假', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
