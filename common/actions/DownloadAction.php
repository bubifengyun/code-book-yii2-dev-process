<?php

namespace common\actions;

use yii\base\Action;
use Yii;
use yii\web\NotFoundHttpException;

class DownloadAction extends Action
{
    /**
     * Download file for everyone.
     *
     * @param string $filename
     * @return mixed
     */
    public function run($filename)
    {
        $_filename = Yii::$app->basePath.'/../data/downloads/'.$filename;
        if (!file_exists($_filename)) {
            // for windows
            $_filename_gb2312=iconv('UTF-8', 'gb2312', $_filename);
            if (!file_exists($_filename_gb2312)) {
                throw new NotFoundHttpException('对不起，《'.$filename . '》已经不存在了。');
            }
            $_filename=$_filename_gb2312;
        }

        Yii::$app->response->sendFile($_filename, $filename);
    }
}
