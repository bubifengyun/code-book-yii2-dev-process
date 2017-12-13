<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = '更改: ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => '朋友圈', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更改';
?>
<div class="user-update">
    <pre>
    请谨慎更改<strong style='color:rgb(255,0,0)'>下次登录IP地址</strong>，更改后，本次登录将会退出，下次只有对应的 IP 地址才可以登录该用户。
    </pre>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
