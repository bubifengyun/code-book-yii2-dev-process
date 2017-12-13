<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PersoninfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personinfo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'namepinyin') ?>

    <?= $form->field($model, 'sex') ?>

    <?= $form->field($model, 'is_married') ?>

    <?php // echo $form->field($model, 'property') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'can_home_weekend') ?>

    <?php // echo $form->field($model, 'birthdate') ?>

    <?php // echo $form->field($model, 'armydate') ?>

    <?php // echo $form->field($model, 'current_mil_rank_date') ?>

    <?php // echo $form->field($model, 'next_mil_rank_date') ?>

    <?php // echo $form->field($model, 'current_techgrade_date') ?>

    <?php // echo $form->field($model, 'next_techgrade_date') ?>

    <?php // echo $form->field($model, 'current_other_date') ?>

    <?php // echo $form->field($model, 'next_other_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'mil_rank') ?>

    <?php // echo $form->field($model, 'unit_code') ?>

    <?php // echo $form->field($model, 'tech_grade') ?>

    <?php // echo $form->field($model, 'job') ?>

    <?php // echo $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'myhome_province') ?>

    <?php // echo $form->field($model, 'myhome_city') ?>

    <?php // echo $form->field($model, 'myhome_district') ?>

    <?php // echo $form->field($model, 'parentshome_province') ?>

    <?php // echo $form->field($model, 'parentshome_city') ?>

    <?php // echo $form->field($model, 'parentshome_district') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
