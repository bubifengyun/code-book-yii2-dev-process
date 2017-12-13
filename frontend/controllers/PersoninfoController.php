<?php

namespace frontend\controllers;

use Yii;
use common\models\Personinfo;
use common\models\PersoninfoSearch;
use common\models\Unit;
use common\models\Status;
use common\models\Cities;
use common\models\Districts;
use common\models\UploadForm;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Event;
use kartik\tree\TreeView;
use kartik\tree\controllers\NodeController;
use yii\filters\AccessControl;
use yii\helpers\Json;
use Overtrue\Pinyin\Pinyin;

/**
 * PersoninfoController implements the CRUD actions for Personinfo model.
 */
class PersoninfoController extends Controller
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
     * Every User take control of Holiday in special unit.
     * @param $id Personinfo's id
     * @return mixed
     */
    public function actionViewMyHolidays($id)
    {
        return $this->render('viewmyholidays', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionDistrictPath($selected = null)
    {
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = Districts::find()->Where(['id'=>$id])->orderBy('CONVERT(name USING gbk) ASC')->asArray()->all();
            $isSelectedIn = false;
            if ($id != null && count($list) > 0) {
                foreach ($list as $i => $account) {
                    $out[] = ['id' => $account['id'], 'name' => $account['day_path']];
                    if ($i == 0) {
                        $first = $account['id'];
                    }
                    if ($account['id'] == $selected) {
                        $isSelectedIn = true;
                    }
                }
                if (!$isSelectedIn) {
                    $selected = $first;
                }
                echo Json::encode(['output' => $out, 'selected'=>$selected]);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected'=>'']);
    }

    public function actionCityDistrict($selected = null)
    {
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = Districts::find()->andWhere(['cid'=>$id])->orderBy('CONVERT(name USING gbk) ASC')->asArray()->all();
            $isSelectedIn = false;
            if ($id != null && count($list) > 0) {
                foreach ($list as $i => $account) {
                    $out[] = ['id' => $account['id'], 'name' => $account['name']];
                    if ($i == 0) {
                        $first = $account['id'];
                    }
                    if ($account['id'] == $selected) {
                        $isSelectedIn = true;
                    }
                }
                if (!$isSelectedIn) {
                    $selected = $first;
                }
                echo Json::encode(['output' => $out, 'selected'=>$selected]);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected'=>'']);
    }

    public function actionProvinceCity($selected = null)
    {
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = Cities::find()->andWhere(['pid'=>$id])->orderBy('CONVERT(name USING gbk) ASC')->asArray()->all();
            $isSelectedIn = false;
            if ($id != null && count($list) > 0) {
                foreach ($list as $i => $account) {
                    $out[] = ['id' => $account['id'], 'name' => $account['name']];
                    if ($i == 0) {
                        $first = $account['id'];
                    }
                    if ($account['id'] == $selected) {
                        $isSelectedIn = true;
                    }
                }
                if (!$isSelectedIn) {
                    $selected = $first;
                }
                echo Json::encode(['output' => $out, 'selected'=>$selected]);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected'=>'']);
    }

    /**
     * every year report of officer holiday
     * @return mixed
     */
    public function actionYearOfficerHolidayReport()
    {
        $see_unit = Yii::$app->user->identity->see_unit;
        $current_unit = Yii::$app->session->get('current_unit', 0);
        if ($current_unit === 0) {
            $current_unit = $see_unit;
        }
        if (Unit::findOne($see_unit) == null) {
            throw new NotFoundHttpException('请检查你可以查看的单位范围');
        }
        // add children and itself.
        $query = Unit::findOne($see_unit)
            ->children()
            ->orWhere(['id' => $see_unit])
            ->addOrderBy('root, lft');

        return $this->render('yearofficerholidayreport', [
            'query' => $query,
            'current_unit' => $current_unit,
        ]);
    }

    public function actionTreemanagerRouter($router)
    {
        extract(static::getPostData());
        if (isset($id) && !empty($id)) {
            Yii::$app->session->set('current_unit', $id);
        }
        return $this->redirect([$router]);
    }

    protected static function getPostData()
    {
        if (empty($_POST)) {
            return [];
        }
        $out = [];
        foreach ($_POST as $key => $value) {
            $out[$key] = in_array($key, NodeController::$boolKeys) ? filter_var($value, FILTER_VALIDATE_BOOLEAN) : $value;
        }
        return $out;
    }

    /**
     * Every User take control of Holiday in special unit.
     * @return mixed
     */
    public function actionHoliday()
    {
        $see_unit = Yii::$app->user->identity->see_unit;
        $current_unit = Yii::$app->session->get('current_unit', 0);
        if ($current_unit === 0) {
            $current_unit = $see_unit;
        }
        if (Unit::findOne($see_unit) == null) {
            throw new NotFoundHttpException('请检查你可以查看的单位范围');
        }
        // add children and itself.
        $query = Unit::findOne($see_unit)
            ->children()
            ->orWhere(['id' => $see_unit])
            ->addOrderBy('root, lft');

        return $this->render('holiday', [
            'query' => $query,
            'current_unit' => $current_unit,
        ]);
    }

    /**
     * Every User take control of Roster in special unit.
     * @return mixed
     */
    public function actionRoster()
    {
        $see_unit = Yii::$app->user->identity->see_unit;
        $current_unit = Yii::$app->session->get('current_unit', 0);
        if ($current_unit === 0) {
            $current_unit = $see_unit;
        }
        if (Unit::findOne($see_unit) == null) {
            throw new NotFoundHttpException('请检查你可以查看的单位范围');
        }
        // add children and itself.
        $query = Unit::findOne($see_unit)
            ->children()
            ->orWhere(['id' => $see_unit])
            ->addOrderBy('root, lft');

        return $this->render('roster', [
            'query' => $query,
            'current_unit' => $current_unit,
        ]);
    }

    /**
     * Every User take control of Roster in special unit.
     * @return mixed
     */
    public function actionSelfRoster()
    {
        $see_unit = Yii::$app->user->identity->see_unit;
        $current_unit = Yii::$app->session->get('current_unit', 0);
        if ($current_unit === 0) {
            $current_unit = $see_unit;
        }
        if (Unit::findOne($see_unit) == null) {
            throw new NotFoundHttpException('请检查你可以查看的单位范围');
        }
        // add children and itself.
        $query = Unit::findOne($see_unit)
            ->children()
            ->orWhere(['id' => $see_unit])
            ->addOrderBy('root, lft');

        return $this->render('selfroster', [
            'query' => $query,
            'current_unit' => $current_unit,
        ]);
    }

    /**
     * Every User take control of Bye in special unit.
     * @return mixed
     */
    public function actionBye()
    {
        $see_unit = Yii::$app->user->identity->see_unit;
        $current_unit = Yii::$app->session->get('current_unit', 0);
        if ($current_unit === 0) {
            $current_unit = $see_unit;
        }
        if (Unit::findOne($see_unit) == null) {
            throw new NotFoundHttpException('请检查你可以查看的单位范围');
        }
        // add children and itself.
        $query = Unit::findOne($see_unit)
            ->children()
            ->orWhere(['id' => $see_unit])
            ->addOrderBy('root, lft');

        return $this->render('bye', [
            'query' => $query,
            'current_unit' => $current_unit,
        ]);
    }

    /**
     * Modify anyone in its see_unit
     * @return mixed
     */
    public function actionIndex()
    {
        $see_unit = Yii::$app->user->identity->see_unit;
        $current_unit = Yii::$app->session->get('current_unit', 0);
        if ($current_unit === 0) {
            $current_unit = $see_unit;
        }
        if (Unit::findOne($see_unit) == null) {
            throw new NotFoundHttpException('请检查你可以查看的单位范围');
        }
        // add children and itself.
        $query = Unit::findOne($see_unit)
            ->children()
            ->orWhere(['id' => $see_unit])
            ->addOrderBy('root, lft');

        return $this->render('index', [
            'query' => $query,
            'current_unit' => $current_unit,
        ]);
    }

    /**
     * View Upgrade
     * @param $kind string 'job', 'tech', 'rank' 分别表示晋职晋级晋衔
     * @return mixed
     */
    public function actionUpgrade($kind = 'job')
    {
        $see_unit = Yii::$app->user->identity->see_unit;
        $current_unit = Yii::$app->session->get('current_unit', 0);
        if ($current_unit === 0) {
            $current_unit = $see_unit;
        }
        if (Unit::findOne($see_unit) == null) {
            throw new NotFoundHttpException('请检查你可以查看的单位范围');
        }
        // add children and itself.
        $query = Unit::findOne($see_unit)
            ->children()
            ->orWhere(['id' => $see_unit])
            ->addOrderBy('root, lft');

        return $this->render('upgrade', [
            'query' => $query,
            'current_unit' => $current_unit,
            'kind' => $kind,
        ]);
    }

    /**
     * View Party
     * @return mixed
     */
    public function actionParty()
    {
        $see_unit = Yii::$app->user->identity->see_unit;
        $current_unit = Yii::$app->session->get('current_unit', 0);
        if ($current_unit === 0) {
            $current_unit = $see_unit;
        }
        if (Unit::findOne($see_unit) == null) {
            throw new NotFoundHttpException('请检查你可以查看的单位范围');
        }
        // add children and itself.
        $query = Unit::findOne($see_unit)
            ->children()
            ->orWhere(['id' => $see_unit])
            ->addOrderBy('root, lft');

        return $this->render('party', [
            'query' => $query,
            'current_unit' => $current_unit,
        ]);
    }

    /**
     * Every User take control of Out in special unit.
     * @return mixed
     */
    public function actionOut()
    {
        $see_unit = Yii::$app->user->identity->see_unit;
        $current_unit = Yii::$app->session->get('current_unit', 0);
        if ($current_unit === 0) {
            $current_unit = $see_unit;
        }
        if (Unit::findOne($see_unit) == null) {
            throw new NotFoundHttpException('请检查你可以查看的单位范围');
        }
        // add children and itself.
        $query = Unit::findOne($see_unit)
            ->children()
            ->orWhere(['id' => $see_unit])
            ->addOrderBy('root, lft');

        return $this->render('out', [
            'query' => $query,
            'current_unit' => $current_unit,
        ]);
    }

    /**
     * Displays a single Personinfo model.
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
     * Creates a new Personinfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Personinfo();

        if ($model->load(Yii::$app->request->post())) {
            $overtrue_pinyin = new Pinyin();
            $model->namepinyin = implode('', $overtrue_pinyin->name($model->name));
            $model->id = $model->namepinyin .'.'. $model->unit_code
                .'.'. date('Ym', strtotime($model->birthdate))
                . '@' . Yii::$app->setting->get('email.hostname');
            $i = 1;
            while (Personinfo::findOne($model->id) != null) {
                $i++;
                $model->id = $model->namepinyin.$i.'.'. $model->unit_code
                    .'.'. date('Ym', strtotime($model->birthdate))
                    . '@' . Yii::$app->setting->get('email.hostname');
            }
            $model->status = Status::HERE;
            if ($model->save()) {
                Unit::refreshCountsALL();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Upload persoinfos from Excel file
     * @return mixed
     */
    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            $data = \moonland\phpexcel\Excel::import($model->file->tempName, [
                'setIndexSheetByName' => true,
            ]);

            $save_result = Personinfo::saveFromExcelSheets($data);
            if ($save_result === true) {
                Unit::refreshCountsALL();
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

        return $this->render('upload', ['model' => $model]);
    }

    /**
     * Upload persoinfos from CSV file
     * @return mixed
     */
    public function actionUploadCsv()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            $save_result = Personinfo::saveFromCSV($model->file->tempName);
            if ($save_result === true) {
                Unit::refreshCountsALL();
                Yii::$app->session->setFlash('success', '恭喜！您已经成功导入CSV文件：”' . $model->file->name . '” ！');
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

        return $this->render('uploadcsv', ['model' => $model]);
    }

    /**
     * import soldier persoinfos from CSV file
     * @return mixed
     */
    public function actionImportSoldierCsv()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            $save_result = Personinfo::saveSoldierFromCSV($model->file->tempName);
            if ($save_result === true) {
                Unit::refreshCountsALL();
                Yii::$app->session->setFlash('success', '恭喜！您已经成功导入CSV文件：”' . $model->file->name . '” ！');
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

        return $this->render('uploadcsv', ['model' => $model]);
    }

    /**
     * Updates an existing Personinfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Unit::refreshCountsALL();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Personinfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionManyBye()
    {
        if (isset($_POST['keylist'])) {
            $persons = ($_POST['keylist']);
            if (!is_array($persons)) {
                echo Json::encode([
                    'status' => 'error',
                ]);
            } else {
                Personinfo::bye($persons);
                Yii::$app->session->setFlash('success', '您已经成功删除这些人。');

                return $this->redirect(['bye', 'id' => serialize($persons)]);
            }
        } else {
            echo Json::encode([
                'status' => 'none',
            ]);
        }
    }

    /**
     * Deletes an existing Personinfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionManyHome()
    {
        if (isset($_POST['keylist'])) {
            $persons = ($_POST['keylist']);
            if (!is_array($persons)) {
                echo Json::encode([
                    'status' => 'error',
                ]);
            } else {
                Personinfo::setLeaveForCanHomers($persons);
                Yii::$app->session->setFlash('success', '您已经成功让这些人回家了。');

                return $this->redirect(['roster', 'id' => serialize($persons)]);
            }
        } else {
            echo Json::encode([
                'status' => 'none',
            ]);
        }
    }

    public function actionManyCancelhome()
    {
        if (isset($_POST['keylist'])) {
            $persons = ($_POST['keylist']);
            if (!is_array($persons)) {
                echo Json::encode([
                    'status' => 'error',
                ]);
            } else {
                Personinfo::setReturnForCanHomers($persons);
                Yii::$app->session->setFlash('success', '您已经成功撤销这些人回家。');

                return $this->redirect(['roster', 'id' => serialize($persons)]);
            }
        } else {
            echo Json::encode([
                'status' => 'none',
            ]);
        }
    }

    /**
     * Assign many people to a new unit.
     * @return mixed
     */
    public function actionManyAssign()
    {
        if (isset($_POST['keylist']) and isset($_POST['unit'])) {
            $persons = $_POST['keylist'];
            $unit = $_POST['unit'];
            if (!is_array($persons)) {
                echo Json::encode([
                    'status' => 'error',
                ]);
            } else {
                Personinfo::assign($persons, $unit);
                Yii::$app->session->setFlash('success', '您已经成功分配了他们。');

                return $this->redirect(['bye', 'id' => serialize($persons)]);
            }
        } else {
            echo Json::encode([
                'status' => 'none',
            ]);
        }
    }

    /**
     * Deletes an existing Personinfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        Personinfo::bye($id);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Personinfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Personinfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Personinfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
