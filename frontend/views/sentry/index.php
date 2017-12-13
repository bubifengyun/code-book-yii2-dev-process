<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '全部岗哨';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sentry-index">

    <p>
        <?= Html::a('创建岗哨', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'user.username',
            'name',
            'host',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}---{handover}{see_traffic}',
                'buttons' => [
                    'handover' => function ($url, $model, $key) {
                        $label = '<span style="color:green" class="fa fa-paw fa-fw"></span>';
                        $url = Url::to(['handover', 'id' => $key]);
                        $options = [
                            'title' => '值勤',
                            'data-pjax' => '0',
                        ];
                        return Html::a(
                            $label,
                            $url,
                            $options
                        );
                    },
                    'see_traffic' => function ($url, $model, $key) {
                        $label = '<span style="color:green" class="fa fa-users fa-fw"></span>';
                        $url = Url::to(['gate/sentry-traffic', 'sentry_id' => $key]);
                        $options = [
                            'title' => '过往人员',
                            'data-pjax' => '0',
                        ];
                        return Html::a(
                            $label,
                            $url,
                            $options
                        );
                    },
                ],
            ],

        ],
    ]); ?>
<?php Pjax::end(); ?></div>
