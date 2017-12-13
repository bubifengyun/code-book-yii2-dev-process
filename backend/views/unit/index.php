<?php

use yii\helpers\Html;
use common\models\Unit;
use kartik\tree\TreeView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Units';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= TreeView::widget([
        'query'             => Unit::find()->addOrderBy('root, lft'),
        'headingOptions'    => ['label' => '部别'],
        'nodeAddlViews'     => [
            '2' => '@backend/views/unit/showlimited',
        ],
        'isAdmin'           => true,
        'rootOptions'       => ['label' => '您可以查看的部别'],
]) ?>

</div>
