<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Weekend */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="weekend-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'begin_date')->widget(
        'kartik\datetime\DateTimePicker',
        [
            'options' => ['placeholder' => '选择日期时间'],
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'php:Y-m-d H:i:s',
                'todayHighlight' => true,
            ]
        ]
    ) ?>

    <?= $form->field($model, 'end_date')->widget(
        'kartik\datetime\DateTimePicker',
        [
            'options' => ['placeholder' => '选择日期时间'],
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'php:Y-m-d H:i:s',
                'todayHighlight' => true,
            ]
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('更改', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
