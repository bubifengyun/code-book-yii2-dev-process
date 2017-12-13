<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use common\models\Provinces;
use common\models\Lookup;
use common\models\Unit;
use common\models\MilRank;

/* @var $this yii\web\View */
/* @var $model common\models\Personinfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personinfo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->dropDownList([ '男' => '男', '女' => '女', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'is_married')->dropDownList([ '是' => '是', '否' => '否', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'property')->dropDownList([ '党员' => '党员', '团员' => '团员', '群众' => '群众', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'type_date')->widget(
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

    <?= $form->field($model, 'can_home_weekend')->dropDownList([ '是' => '是', '否' => '否', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'birthdate')->widget(
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

    <?= $form->field($model, 'armydate')->widget(
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

    <?= $form->field($model, 'current_mil_rank_date')->widget(
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

    <?= $form->field($model, 'next_mil_rank_date')->widget(
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

    <?= $form->field($model, 'current_techgrade_date')->widget(
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

    <?= $form->field($model, 'next_techgrade_date')->widget(
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

    <?= $form->field($model, 'current_other_date')->widget(
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

    <?= $form->field($model, 'next_other_date')->widget(
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

    <?= $form->field($model, 'mil_rank')->dropDownList(ArrayHelper::map(MilRank::find()->orderBy('id')->asArray()->all(), 'id', 'name'), ['prompt' => '']) ?>

    <?= $form->field($model, 'unit_code')->dropDownList(ArrayHelper::map(Unit::find()->orderBy('id')->asArray()->all(), 'id', 'name'), ['prompt' => '']) ?>

    <?= $form->field($model, 'tech_grade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'job')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'current_job_date')->widget(
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

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <?php
    $provinces = ArrayHelper::map(Provinces::find()
        ->orderBy('CONVERT(name USING gbk) ASC')
        ->asArray()
        ->all(), 'id', 'name');
    $provinces = ['' => ''] + $provinces;
    ?>

    <?= $form->field($model, 'myhome_province')->widget(Select2::classname(), [
        'data' => $provinces,
]) ?>

    <?= $form->field($model, 'myhome_city')->widget(DepDrop::classname(), [
//        'data' => [empty($model->myhome_city)? null : $model->myhome_city],
    'options' => ['placeholder' => '选择...'],
    'type' => DepDrop::TYPE_SELECT2,
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'depends'=>['personinfo-myhome_province'],
        'url' => Url::to(['personinfo/province-city', 'selected' => $model->myhome_city]),
        'loadingText' => '加载市...',
    ]
]) ?>

    <?= $form->field($model, 'myhome_district')->widget(DepDrop::classname(), [
    'options' => ['placeholder' => '选择...'],
    'type' => DepDrop::TYPE_SELECT2,
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'depends'=>['personinfo-myhome_province', 'personinfo-myhome_city'],
        'initialize' => true,
        'initDepends'=>['personinfo-myhome_province'],
        'url' => Url::to(['personinfo/city-district', 'selected' => $model->myhome_district]),
        'loadingText' => '加载县...',
    ]
]) ?>

    <?= $form->field($model, 'parentshome_province')->widget(Select2::classname(), [
        'data' => $provinces,
    ]) ?>

    <?= $form->field($model, 'parentshome_city')->widget(DepDrop::classname(), [
    'options' => ['placeholder' => '选择...'],
    'type' => DepDrop::TYPE_SELECT2,
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'depends'=>['personinfo-parentshome_province'],
        'url' => Url::to(['personinfo/province-city', 'selected' => $model->parentshome_city]),
        'loadingText' => '加载市...',
    ]
]) ?>

    <?= $form->field($model, 'parentshome_district')->widget(DepDrop::classname(), [
    'options' => ['placeholder' => '选择...'],
    'type' => DepDrop::TYPE_SELECT2,
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'depends'=>['personinfo-parentshome_province', 'personinfo-parentshome_city'],
        'initialize' => true,
        'initDepends'=>['personinfo-parentshome_province'],
        'url' => Url::to(['personinfo/city-district', 'selected' => $model->parentshome_district]),
        'loadingText' => '加载县...',
    ]
]) ?>

    <?= $form->field($model, 'minzu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'education')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hometown')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'home_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ps')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
