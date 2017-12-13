<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Lookup;
use common\models\Unit;

$this->title = '注册';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>请填写下面资料，完成注册。</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'role')->dropDownList(Lookup::Roles(), ['prompt' => '']) ?>

                <?= $form->field($model, 'see_unit')->dropDownList(Lookup::itemsQuery(Unit::tableName()), ['prompt' => '']) ?>

                <?= $form->field($model, 'own_unit')->dropDownList(Lookup::itemsQuery(Unit::tableName()), ['prompt' => '']) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
