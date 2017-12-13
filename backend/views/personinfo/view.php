<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Personinfo */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Personinfos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personinfo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'namepinyin',
            'sex',
            'is_married',
            'property',
            'photo',
            'can_home_weekend',
            'birthdate',
            'armydate',
            'current_mil_rank_date',
            'next_mil_rank_date',
            'current_techgrade_date',
            'next_techgrade_date',
            'current_other_date',
            'next_other_date',
            'status',
            'mil_rank',
            'unit_code',
            'tech_grade',
            'job',
            'tel',
            'myhome_province',
            'myhome_city',
            'myhome_district',
            'parentshome_province',
            'parentshome_city',
            'parentshome_district',
        ],
    ]) ?>

</div>
