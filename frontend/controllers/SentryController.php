<?php

namespace frontend\controllers;

use Yii;
use common\models\Sentry;
use common\models\Gate;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SentryController implements the CRUD actions for Sentry model.
 */
class SentryController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Sentry models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Sentry::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sentry model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Sentry model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sentry();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * record person who had passed the gate
     * @param integer $id
     * @return mixed
     */
    public function actionGateRecord($id)
    {
        $model = $this->findModel($id);
        $gate = new Gate();
        if ($gate->load(Yii::$app->request->post())) {
            $message = $gate->checkAndRecord($model);
            Yii::$app->session->setFlash('success', $message);
            return $this->refresh();
        } else {
            return $this->render('gaterecord', [
                'model' => $model,
                'gate' => $gate,
            ]);
        }
    }

    /**
     * Updates an existing Sentry model.
     * Sentry's host was changed, nothing else can be updated.
     * @param integer $id
     * @return mixed
     */
    public function actionHandover($id = null)
    {
        if ($id === null) {
            $id = \Yii::$app->user->identity->sentry->id;
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['gate-record', 'id' => $model->id]);
        } else {
            return $this->render('handover', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Sentry model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Sentry model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * when persons leave out, record time.
     * @param string $id
     * @return mixed
     */
    public function actionReadQrcode()
    {
        if (isset($_POST['qrresult'])) {
            $qrresult = ($_POST['qrresult']);
            if (!is_string($qrresult)) {
                echo Json::encode([
                    'status' => 'error',
                ]);
            } else {
                return $this->redirect(['/personinfo/index', 'id' => 0]);
            }
        } else {
            echo Json::encode([
                'status' => 'error',
            ]);
        }
    }

    /**
     * Finds the Sentry model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sentry the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sentry::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
