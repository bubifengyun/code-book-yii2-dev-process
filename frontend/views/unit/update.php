<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $models common\models\Setting */
/* @var $form yii\widgets\ActiveForm */
?>

<pre>
<strong>友情提醒</strong>
<li>1、编号为<strong> １ </strong>的单位，其编号建议<strong>不更改</strong>。后果较为严重。
<li>2、编号从上到下，请按照从小到大的顺序编号。
<li>3、编号最好不要 <strong>1000</strong> 。
<li>4、编号最好不要连续，以便对新添加的单位进行编号。
<li>5、编号一旦确定，最好不要随便更改，以便造成错乱。
</pre>

<div class="unit-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="model">

<?php

$i=0;
for (; $i< count($models); $i++) {
?>    
        <?= $form->field($models[$i], "[$i]name")->textInput(['readonly'=>'readonly']) ?>

        <?= $form->field($models[$i], "[$i]id")->textInput() ?>

        <hr/>

        <hr/>
<?php }?>

    </div>

    <hr/>

    <div class="form-group">

        <?= Html::submitButton('设置', ['class' => 'btn btn-primary']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
