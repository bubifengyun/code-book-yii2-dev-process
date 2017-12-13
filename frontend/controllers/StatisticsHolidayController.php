<?php

namespace frontend\controllers;

use Yii;
use common\models\StatisticsHoliday;
use frontend\models\AddHolidayForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StatisticsHolidayController implements the CRUD actions for StatisticsHoliday model.
 */
class StatisticsHolidayController extends Controller
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
     * Lists all StatisticsHoliday models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => StatisticsHoliday::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StatisticsHoliday model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StatisticsHoliday model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StatisticsHoliday();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StatisticsHoliday model.
     * only day_total, day_path were updated.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdateDayPathTotal($id)
    {
        $model = $this->findModel($id);

        $model->type = $model->typearray;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->recoverType();
            $model->save();
            return $this->redirect(['personinfo/view', 'id' => $model->id]);
        } else {
            return $this->render('updatedaypathtotal', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StatisticsHoliday model.
     * only day_add, day_add_ps were updated.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdateDayAdd($id)
    {
        $model = $this->findModel($id);
        $addHoliday = new AddHolidayForm;

        if ($addHoliday->load(Yii::$app->request->post()) && $addHoliday->validate()) {
            $model->day_total += $addHoliday->day_add;
            $model->day_left += $addHoliday->day_add;
            if ($addHoliday->day_add_is_nextyear) {
                $model->day_lend_nextyear += $addHoliday->day_add;
                $model->day_lend_nextyear_ps .= $addHoliday->day_add_ps . '('.$addHoliday->day_add.')';
            } else {
                $model->day_add += $addHoliday->day_add;
                $model->day_add_ps .= $addHoliday->day_add_ps . '('.$addHoliday->day_add.')';
            }
            $model->loadType($addHoliday->type);
            $model->save();
            return $this->redirect(['personinfo/view', 'id' => $model->id]);
        } else {
            return $this->render('updatedayadd', [
                'model' => $model,
                'addHoliday' => $addHoliday,
            ]);
        }
    }

    /**
     * Deletes an existing StatisticsHoliday model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StatisticsHoliday model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return StatisticsHoliday the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StatisticsHoliday::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
