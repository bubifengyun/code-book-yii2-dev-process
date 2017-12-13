<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Out */

$this->title = '外出情况:   ' . $name;
?>
<div class="out-view">

    <p>
<?php
if ($model->owner->isOUT) {
    echo Html::a('销假', ['cancel', 'id' => $id, 'isSerialized' => $isSerialized], ['class' => 'btn btn-success']);
    echo Html::a('续假', ['update', 'id' => $id, 'isSerialized' => $isSerialized], ['class' => 'btn btn-primary']);
}?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'time_leave',
            'time_come',
            'time_cancel',
            'tel',
            'note',
        ],
    ]) ?>

    <p>
<?php
if ($model->owner->isOUT) {
    echo Html::a('销假', ['cancel', 'id' => $id, 'isSerialized' => $isSerialized], ['class' => 'btn btn-success']);
    echo Html::a('续假', ['update', 'id' => $id, 'isSerialized' => $isSerialized], ['class' => 'btn btn-primary']);
}?>
    </p>

</div>
