<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii2tech\crontab\CronJob;
use yii2tech\crontab\CronTab;
use yii\web\NotFoundHttpException;
use common\models\CronjobSearch;

class CronjobController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create', 'index', 'update', 'view', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionCreate($line = null)
    {
        $model = new CronJob();
        if ($line!==null) {
            $model->setLine($line);
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $line = $model->getLine();
                $isReLine = \common\models\Cronjob::isReLine($line);
                if ($isReLine) {
                    Yii::$app->session->setFlash('error', '已经存在该命令了！');
                    return $this->refresh();
                }
                $id = \common\models\Cronjob::saveToSQL($line);
                \common\models\Cronjob::refreshCronjob();

                return $this->redirect(['view', 'id' => $id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        \common\models\Cronjob::refreshCronjob();
        return $this->redirect(['index']);
    }

    public function actionIndex()
    {
        \common\models\Cronjob::refreshCronjob();
        $searchModel = new CronjobSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id)
    {
        $cronjob = $this->findModel($id);
        $line = $cronjob->line;
        $cronjob->delete();
        \common\models\Cronjob::refreshCronjob();
        return $this->redirect(['create', 'line' => $line]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = \common\models\Cronjob::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
