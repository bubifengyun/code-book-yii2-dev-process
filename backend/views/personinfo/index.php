<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PersoninfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personinfos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personinfo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Personinfo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'namepinyin',
            'sex',
            'is_married',
            // 'property',
            // 'photo',
            // 'can_home_weekend',
            // 'birthdate',
            // 'armydate',
            // 'current_mil_rank_date',
            // 'next_mil_rank_date',
            // 'current_techgrade_date',
            // 'next_techgrade_date',
            // 'current_other_date',
            // 'next_other_date',
            // 'status',
            // 'mil_rank',
            // 'unit_code',
            // 'tech_grade',
            // 'job',
            // 'tel',
            // 'myhome_province',
            // 'myhome_city',
            // 'myhome_district',
            // 'parentshome_province',
            // 'parentshome_city',
            // 'parentshome_district',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
