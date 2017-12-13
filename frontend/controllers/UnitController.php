<?php

namespace frontend\controllers;

use Yii;
use common\models\Unit;
use common\models\MilRank;
use common\models\Status;
use common\models\UnitSearch;
use common\models\Holiday;
use common\models\HolidaySearch;
use common\models\Personinfo;
use common\models\PersoninfoSearch;
use common\models\UploadForm;
use yii\web\UploadedFile;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UnitController implements the CRUD actions for Unit model.
 */
class UnitController extends Controller
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
     * Lists all Unit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UnitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * produce officer report monthly
     * @return mixed
     */
    public function actionMonthOfficerReport()
    {
        $searchModel = new HolidaySearch();
        Holiday::setRecordedForUnrecord();
        $query = Holiday::find()
            ->where([
                'which_year' => date('Y'),
                'report_month' => date('m'),
            ])
            ->joinWith('owner')
            ->where([
                '>=', 'mil_rank',
                MilRank::LOWESTMOFFICER
            ])
            ->orderBy([
                'unit_code' => SORT_ASC,
                'CONVERT(name USING gbk)' => SORT_ASC,
            ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('monthofficerreport', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * produce soldier report monthly
     * @return mixed
     */
    public function actionMonthSoldierReport()
    {
        $searchModel = new UnitSearch();
        $query = Unit::find()
            ->where([
                'base_level' => 0,
            ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('monthsoldierreport', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Weekend homer is back.
     * @return mixed
     */
    public function actionWeekendHome()
    {
        $unit_code = Yii::$app->user->identity->own_unit;
        if ($unit_code == '' || $unit_code == null) {
            throw new NotFoundHttpException('找不到您负责的单位');
        }

        $model = $this->findModel($unit_code);

        $searchModel = new PersoninfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query
            ->andWhere([
                'unit_code' => $model->selfAndChildrenIds,
                'can_home_weekend' => '是',
                'status' => [Status::HERE, Status::WEEKENDHOME],
            ]);


        return $this->render('weekendhome', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Arrange week.
     * @return mixed
     */
    public function actionWeekArrangement()
    {
        $unit_code = Yii::$app->user->identity->own_unit;
        $model = $this->findModel($unit_code);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['personinfo/roster', 'id' => $model->id]);
        } else {
            return $this->render('weekarrange', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Upload persoinfos from Excel file
     * @return mixed
     */
    public function actionUploadExcel()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            $data = \moonland\phpexcel\Excel::import($model->file->tempName, [
                'setIndexSheetByName' => true,
            ]);

            $save_result = Unit::saveFromExcel($data);
            if ($save_result === true) {
                Yii::$app->session->setFlash('success', '恭喜！您已经成功导入Excel文件：”' . $model->file->name . '” ！');
            } else {
                // put array to string
                ob_start();
                echo "<h2>错误提醒</h2>";
                var_dump($save_result);
                $errors = ob_get_clean();

                Yii::$app->session->setFlash('error', $errors);
            }
            return $this->refresh();
        }

        return $this->render('uploadexcel', ['model' => $model]);
    }

    /**
     * Updates an existing Unit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionUpdate()
    {
        $models = Unit::find()
            ->addOrderBy('root, lft')
            ->all();

        if (isset($_POST['Unit'])) {
            /*
             * 设置先加上　$diff　的原因，以免出现保存错误的情况。
             * 如果设置的编号过大，则该　$diff　可能失效。
             */
            $diff = 10000;
            $tmp_units = $_POST['Unit'];
            $i = 0;
            $transaction = Yii::$app->db->beginTransaction();
            foreach ($tmp_units as $tmp_unit) {
                $models[$i]->id = $tmp_unit['id'] + $diff;
                $models[$i]->save();
                $i++;
            }
            $transaction->commit();

            $i = 0;
            $transaction = Yii::$app->db->beginTransaction();
            foreach ($tmp_units as $tmp_unit) {
                $models[$i]->id = $tmp_unit['id'];
                $models[$i]->save();
                $i++;
            }
            $transaction->commit();
            Yii::$app->session->setFlash('success', '您重新设置成功啦!');
            return $this->refresh();
        }

        return $this->render('update', [
            'models' => $models,
        ]);
    }

    /**
     * Finds the Unit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Unit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Unit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
