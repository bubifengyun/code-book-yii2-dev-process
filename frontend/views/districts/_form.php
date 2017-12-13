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
?>

<div class="districts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pid')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Provinces::find()
        ->orderBy('CONVERT(name USING gbk) ASC')
        ->asArray()
        ->all(), 'id', 'name')
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

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'day_path')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
