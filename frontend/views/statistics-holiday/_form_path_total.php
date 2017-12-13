<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Status;
use common\models\Lookup;

/* @var $this yii\web\View */
/* @var $model common\models\StatisticsHoliday */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="statistics-holiday-form">

    <?php $form = ActiveForm::begin(); ?>

    <pre>
<strong>友情提醒：</strong>
    今年假期需要增加：<span style="color: rgb(0, 255, 0);font-size: 24px;"><strong><?= $model->day_add?></strong></span> 天，增加原因：<span style="color: rgb(0, 0, 255);"><?= $model->day_add_ps?></span>。
    可以通过如下方式计算总天数：<pre> 总天数=路途天数+今年增加天数+应休天数</pre></pre>
    <?= $form->field($model, 'day_path')->textInput() ?>

    <?= $form->field($model, 'type')->checkboxList(Lookup::itemsQuery(Status::tableName()), ['separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;']) ?>

    <?= $form->field($model, 'day_total')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('设置', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
