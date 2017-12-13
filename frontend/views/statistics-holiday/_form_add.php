<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Status;
use common\models\Lookup;

/* @var $this yii\web\View */
/* @var $model common\models\StatisticsHoliday */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="add-holiday-form">

    <?php $form = ActiveForm::begin(); ?>

    <pre>
<strong>友情提醒：</strong>
    天数直接写，备注只需要写原因，不需要添加天数。
    该同志今年休假增加假期：<?= $model->day_add_ps ?>
    
    </pre>
    <?= $form->field($addHoliday, 'day_add')->textInput() ?>

    <?= $form->field($addHoliday, 'day_add_is_nextyear')->checkbox() ?>

    <?= $form->field($addHoliday, 'type')->checkboxList(Lookup::itemsQuery(Status::tableName()), ['separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;']) ?>

    <?= $form->field($addHoliday, 'day_add_ps')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('添加', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
