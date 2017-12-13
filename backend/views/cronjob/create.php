<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model yii2tech\crontab\CronJob */
/* @var $form ActiveForm */
?>
<div class="cron-job">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'min') ?>
        <?= $form->field($model, 'hour') ?>
        <?= $form->field($model, 'day') ?>
        <?= $form->field($model, 'month') ?>
        <?= $form->field($model, 'weekDay') ?>
        <?= $form->field($model, 'command') ?>
        <?= $form->field($model, 'year') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- cron-job -->
