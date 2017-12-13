<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Lookup;

/* @var $this yii\web\View */
/* @var $model common\models\Message */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'receiver')->dropDownList(Lookup::Users(), ['prompt' => '']) ?>

    <?= $form->field($model, 'content')->widget(
        'kucha\ueditor\UEditor',
        [
            'clientOptions' => [
                'initialFrameHeight' => '200',
            ]
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('发送', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
