<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Personinfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personinfo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'namepinyin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->dropDownList([ '男' => '男', '女' => '女', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'is_married')->dropDownList([ '是' => '是', '否' => '否', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'property')->dropDownList([ '党员' => '党员', '团员' => '团员', '群众' => '群众', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'can_home_weekend')->dropDownList([ '是' => '是', '否' => '否', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'birthdate')->textInput() ?>

    <?= $form->field($model, 'armydate')->textInput() ?>

    <?= $form->field($model, 'current_mil_rank_date')->textInput() ?>

    <?= $form->field($model, 'next_mil_rank_date')->textInput() ?>

    <?= $form->field($model, 'current_techgrade_date')->textInput() ?>

    <?= $form->field($model, 'next_techgrade_date')->textInput() ?>

    <?= $form->field($model, 'current_other_date')->textInput() ?>

    <?= $form->field($model, 'next_other_date')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'mil_rank')->textInput() ?>

    <?= $form->field($model, 'unit_code')->textInput() ?>

    <?= $form->field($model, 'tech_grade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'job')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'myhome_province')->textInput() ?>

    <?= $form->field($model, 'myhome_city')->textInput() ?>

    <?= $form->field($model, 'myhome_district')->textInput() ?>

    <?= $form->field($model, 'parentshome_province')->textInput() ?>

    <?= $form->field($model, 'parentshome_city')->textInput() ?>

    <?= $form->field($model, 'parentshome_district')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
