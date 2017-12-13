<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $models common\models\Setting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="model">

<?php

$i=0;
for (; $i<count($models); $i++) {
?>    
        <?= $form->field($models[$i], "[$i]key")->textInput(['readonly'=>'readonly']) ?>

        <?= $form->field($models[$i], "[$i]value")->textInput() ?>

        <hr/>
<?php }?>

    </div>

    <hr/>

    <div class="form-group">

        <?= Html::submitButton('设置', ['class' => 'btn btn-primary']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
