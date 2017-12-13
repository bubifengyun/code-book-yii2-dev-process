<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\UploadForm */
/* @var $form yii\widgets\ActiveForm */
?>




<div class="uploadform-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'file')->widget(FileInput::classname(), [
        'pluginOptions' => [
            'options'=>[
                'accept'=>'text/*',
            ],
            'allowedFileExtensions'=>['xls','xlsx','et','dzb'],
        ],
    ]) ?>

    <?php ActiveForm::end(); ?>

</div>
<hr>
<pre>
<strong>附件</strong>
<strong>
<?= Html::a('人员批量录入模板(Excel2003).xls', ['site/download', 'filename' => '人员批量录入模板.xls'], ['class' => 'profile-link']) ?>
<br>
<?= Html::a('人员批量录入模板(Excel2007).xlsx', ['site/download', 'filename' => '人员批量录入模板.xlsx'], ['class' => 'profile-link']) ?>
</strong>
</pre>
