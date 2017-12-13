<?php

namespace frontend\controllers;

use Yii;
use common\models\HolidayOriginal;
use common\models\Lookup;
use common\models\Personinfo;
use common\models\MilRank;
use Overtrue\Pinyin\Pinyin;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HolidayOriginalController implements the CRUD actions for HolidayOriginal model.
 */
class HolidayOriginalController extends Controller
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
     * Lists all HolidayOriginal models.
     * @return mixed
     */
    public function actionIndex($run = 0)
    {
        if ($run == 0) {
            return 'You go wrong!';
        }

        if ($run == 2) {
            return 'TestHoliday';
        }

        $models = HolidayOriginal::find()
            ->where(1)
            ->all();

        $pinyin = new Pinyin();
        $login_id = [];
        foreach ($models as $model) {
            $doubleName = $model->name . $model->ParentLocation;
            if (empty($login_id[$doubleName]) or
                $login_id[$doubleName] < $model->id) {
                $login_id[$doubleName] = $model->id;
            }
        }

        $models = HolidayOriginal::find()
            ->where([
                'id' => $login_id,
            ])
            ->all();

        $check_name = [];
        $transaction = Yii::$app->db->beginTransaction();
        foreach ($models as $model) {
            $unit_code = $model->unit->id;
            $person_pinyin = implode('', $pinyin->name($model->name));
            if (empty($check_name[$unit_code])) {
                $check_name[$person_pinyin] = 0;
                $check_name[$unit_code][]
                    = $person_pinyin;
            } elseif (in_array($person_pinyin, $check_name[$unit_code])) {
                $check_name[$person_pinyin]++;
                $person_pinyin .= $check_name[$person_pinyin];
                $check_name[$unit_code][]
                    = $person_pinyin;
            } else {
                $check_name[$person_pinyin] = 0;
                $check_name[$unit_code][]
                    = $person_pinyin;
            }

            $person = new Personinfo;
            $person->birthdate = '2000-01-01';
            $person_id = $person_pinyin . '.' . $unit_code
                . date('Y', strtotime($person->birthdate)) . '@'
                . Yii::$app->setting->get('email.hostname');

            $person->id = $person_id;
            $person->name = $model->name;
            $person->namepinyin = $person_pinyin;
            $person->sex = '男';//没办法，无法获得，只有后续更改了。
            $person->unit_code = $unit_code;
            $person->is_married = $model->hunfou == '已婚' ? '是' : '否';
            $person->can_home_weekend = '否'; // unknown.
            $person->birthdate = '2000-01-01';
            $person->armydate = '2000-01-01';
            $person->status = 0;
            $person->mil_rank = Lookup::id(MilRank::tableName(), $model->grade);
            $person->job = '不需要知道';
            $person->save();
        }
        $transaction->commit();
        // 这里我们认为 $login_id 里已经是唯一的 id 了，
        $dataProvider = new ActiveDataProvider([
            'query' => HolidayOriginal::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HolidayOriginal model.
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
     * Creates a new HolidayOriginal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HolidayOriginal();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing HolidayOriginal model.
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
     * Deletes an existing HolidayOriginal model.
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
     * Finds the HolidayOriginal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HolidayOriginal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HolidayOriginal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
