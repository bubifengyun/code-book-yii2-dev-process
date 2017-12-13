<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => '朋友圈', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?php
        if ($model->id === Yii::$app->user->id) {
            echo Html::a('修改资料', ['update'], ['class' => 'btn btn-primary']);

            echo Html::a('修改密码', ['site/modify-password'], ['class' => 'btn btn-danger']);
        }
        ?>

    </p>

    <?= kartik\detail\DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'last_login_ip4',
            'job',
        ],
    ]) ?>

</div>
