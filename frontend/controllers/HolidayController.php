<?php

namespace frontend\controllers;

use Yii;
use common\models\Personinfo;
use common\models\Status;
use common\models\Holiday;
use common\models\MilRank;
use yii\db\Query;
use common\models\HolidaySearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\MethodNotAllowedHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * HolidayController implements the CRUD actions for Holiday model.
 */
class HolidayController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
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

    /**
     * Lists all Holiday models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HolidaySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Holiday model.
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
     * Displays unreturn personinfo
     * @return mixed
     */
    public function actionUnreturnNotify()
    {
        $searchModel = new HolidaySearch();
        $date_bench = date('Y-m-d', strtotime(
            Yii::$app->setting->get('day_unreturn_notify') . ' day'
        ));
        $query = Holiday::find()
            ->where([
                '<=', 'date_come', $date_bench
            ])
            ->andWhere([
                'date_cancel' => null,
            ])
            ->andWhere([
                'in', 'id', (new Query)
                ->select('id')
                ->from(Personinfo::tableName())
                ->where(['<', 'mil_rank', MilRank::LOWESTMOFFICER])
            ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('unreturnnotify', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * When back cancel Holiday model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param string $id Personinfo's id
     * @return mixed
     */
    public function actionCancel($id)
    {
        $owner = Personinfo::findModel($id);
        if (!$owner->isHoliday) {
            throw new MethodNotAllowedHttpException('该同志没有休假，无法销假！');
        }

        $model = $owner->statisticsHoliday->currentHoliday;
        $model->date_cancel = date('Y-m-d');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $owner->statisticsHoliday->completeHoliday($model);
            //$owner->setStatus(Status::HERE);
            $model->save();

            return $this->redirect(['view', 'id' => $model->h_id]);
        } else {
            return $this->render('cancel', [
                'model' => $model,
            ]);
        }
    }

    /**
     * When leave Creates a new Holiday model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param string $id Personinfo's id
     * @return mixed
     */
    public function actionLeave($id)
    {
        $owner = Personinfo::findModel($id);
        if (!$owner->isHere) {
            throw new MethodNotAllowedHttpException('该同志不在连队，无法休假！');
        }

        $model = new Holiday();
        $model->id = $id;
        $model->date_leave = date('Y-m-d');
        $model->which_year = date('Y');
        $model->tel = $owner->tel;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //$owner->setStatus($model->kind);
            $owner->statisticsHoliday->setCurrentHoliday($model->h_id);
            return $this->redirect(['view', 'id' => $model->h_id]);
        } else {
            return $this->render('leave', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Holiday model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (!$model->owner->isHoliday) {
            throw new MethodNotAllowedHttpException('该同志不在休假，无法修改！');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //$model->owner->setStatus($model->kind);
            return $this->redirect(['view', 'id' => $model->h_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Holiday model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Holiday the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Holiday::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
