<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Out */

$this->title = '外出销假:   ' . $name;
?>
<div class="out-update">
    
    <p>
        <?= Html::a('续假', ['update', 'id' => $id, 'isSerialized' => $isSerialized], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= $this->render('_cancelform', [
        'model' => $model,
    ]) ?>

</div>
