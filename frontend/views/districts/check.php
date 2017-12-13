<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use common\models\Provinces;

/* @var $this yii\web\View */
/* @var $model common\models\Districts */
/* @var $form yii\widgets\ActiveForm */

$this->title = '路途查询';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="districts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $provinces = ArrayHelper::map(Provinces::find()
        ->orderBy('CONVERT(name USING gbk) ASC')
        ->asArray()
        ->all(), 'id', 'name');
    $provinces = ['' => ''] + $provinces;
    ?>

    <?= $form->field($model, 'pid')->widget(Select2::classname(), [
        'data' => $provinces
]) ?>

    <?= $form->field($model, 'cid')->widget(DepDrop::classname(), [
    'options' => ['placeholder' => '选择...'],
    'type' => DepDrop::TYPE_SELECT2,
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'depends'=>['districts-pid'],
        'initialize' => true,
        'initDepends'=>['districts-pid'],
        'url' => Url::to(['personinfo/province-city', 'selected' => $model->cid]),
        'loadingText' => '加载市...',
    ]
]) ?>

    <?= $form->field($model, 'name')->widget(DepDrop::classname(), [
    'options' => ['placeholder' => '选择...'],
    'type' => DepDrop::TYPE_SELECT2,
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'depends'=>['districts-pid', 'districts-cid'],
        'initialize' => true,
        'initDepends'=>['districts-pid'],
        'url' => Url::to(['personinfo/city-district', 'selected' => $model->name]),
        'loadingText' => '加载县...',
    ]
]) ?>

    <?= $form->field($model, 'day_path')->widget(DepDrop::classname(), [
    'options' => ['placeholder' => '加载...'],
    'type' => DepDrop::TYPE_SELECT2,
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'depends'=>['districts-pid', 'districts-cid', 'districts-name'],
        'initialize' => true,
        'initDepends'=>['districts-pid'],
        'url' => Url::to(['personinfo/district-path', 'selected' => $model->day_path]),
        'loadingText' => '加载天数...',
    ]
]) ?>

    <?php ActiveForm::end(); ?>

</div>
