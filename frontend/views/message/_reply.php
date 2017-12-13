<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Message */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reply-form">
    <?php
    $form = ActiveForm::begin([
//    'action' => ['view','id' => $id, '#' => 'reply'],
    'method'=>'post',
    ]); ?>
        <div class="row">
            <div class="col-md-12">
            
                <?= $form->field($replyMessage, 'content')->widget(
                    'kucha\ueditor\UEditor',
                    [
                        'clientOptions' => [
                            'initialFrameHeight' => '200',
                        ]
                    ]
                ) ?>

            </div>
        </div>

    <div class="form-group">
        <?= Html::submitButton('回复', ['class' => 'btn btn-success']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>

