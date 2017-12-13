<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $profile app\modules\user\models\Profile */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label col-md-12">用户头像</label>
            <div class="col-md-6">
              <div class="fileupload fileupload-new">
                <div class="fileupload-new img-preview" style="width: 150px; height: 150px;">
                  <img src="<?= Yii::getAlias('@avatar').\Yii::$app->user->identity->avatar ?>"  style="width: 150px; height: 150px;">
                </div>
              </div>
            </div>
            <div class="col-md-6">
                <div class="fileupload fileupload-new">
                    <div class="img-preview"></div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group">
            <div class="col-md-12">
                <?= \iisns\webuploader\Cropper::widget() ?>
            </div>
            <div class="col-md-12">
                <a id="set-avatar" class="btn btn-success btn-lg" href="<?= Url::toRoute(['/user/avatar']) ?>" onclick="return false;">
                    网站自带头像
                </a>
                <div id="avatar-container"></div><!-- 系统头像容器 -->
            </div>
        </div>
    </div>
</div>
