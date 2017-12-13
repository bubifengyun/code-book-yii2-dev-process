<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'last_login_ip4',
            'this_login_ip4',
            'job',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}--{forcepassword}',
                'buttons' => [
                    'forcepassword' => function ($url, $model, $key) {
                        $label = '<span style="color:red" class="glyphicon glyphicon-edit"></span>';
                        $url = Url::to(['user/force-password', 'id' => $key]);

                        $options = [
                            'title' => '强设密码为00000000',
                            'data-confirm' => '确定强设密码为 00000000 （八个0）？',
                            'data-method' => 'post',
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
