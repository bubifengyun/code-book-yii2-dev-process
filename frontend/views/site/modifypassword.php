<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ModifyPasswordForm */
/* @var $form ActiveForm */

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='fa fa-lock form-control-feedback'></span>"
];
?>
<div class="user-modifypassword">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form
            ->field($model, 'id')
            ->label(false)
            ->hiddenInput(['id'=>0]) ?>

        <?= $form
            ->field($model, 'password_old', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password_old')]) ?>

        <?= $form
            ->field($model, 'password_new', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password_new')]) ?>

        <?= $form
            ->field($model, 'password_new_check', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password_new_check')]) ?>

        <div class="form-group">
            <?= Html::submitButton('确定', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- user-modifypassword -->
