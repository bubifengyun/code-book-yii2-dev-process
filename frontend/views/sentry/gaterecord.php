<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\components\Html5CamQrcodeWidget;

/* @var $this yii\web\View */
/* @var $model common\models\Sentry */

$this->title = '岗哨登记：' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '全部岗哨', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '岗哨登记';
?>
<div class="gate-update">

<?php /*
    <?= Html5CamQrcodeWidget::widget([
        'callback' => Url::to(['read-qrcode']),
    ]);?>
 */ ?>

    <?= $this->render('_form_gaterecord', [
        'model' => $model,
        'gate' => $gate,
    ]) ?>

</div>
