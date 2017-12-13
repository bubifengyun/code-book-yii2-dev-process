<?php

namespace backend\controllers;

use Yii;
use common\models\Personinfo;
use common\models\PersoninfoSearch;
use common\models\UploadForm;
use common\models\Unit;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\base\Exception;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

/**
 * PersoninfoController implements the CRUD actions for Personinfo model.
 */
class PersoninfoController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Personinfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersoninfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Upload persoinfos from Excel file
     * @return mixed
     */
    public function actionAddUnitUsers()
    {
        $units = Unit::find()->where(1)->all();

        $transaction = Yii::$app->db->beginTransaction();
        try {
            foreach ($units as $unit) {
                $user = new User();
                $user->username = $unit->name;
                $user->id = $unit->id . '@' . Yii::$app->setting->get('email.hostname');
                $user->email = $user->id;
                $user->role = 1; // role is useless.
                $user->see_unit = $unit->id;
                $user->own_unit = $unit->id;
                $user->status = User::STATUS_ACTIVE;
                $user->setPassword($unit->name);
                $user->generateAuthKey();
                if ($user->save()) {
                    $auth = Yii::$app->authManager;
                    $authorRole = $auth->getRole('Junior');
                    $auth->assign($authorRole, $user->id);
                } else {
                    ob_start();
                    echo "<h2>错误提醒</h2>";
                    var_dump($user->getErrors());
                    $errors = ob_get_clean();
                    
                    throw new Exception($errors);
                }
            }
            $transaction->commit();
            Yii::$app->session->setFlash('success', '恭喜！您已经成功加入单位用户！');
        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
            $transaction->rollback();
        }
        return $this->goBack();
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
     * Updates an existing Personinfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
     * Deletes an existing Personinfo model.
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
