<?php

namespace frontend\controllers;

use Yii;
use common\models\Out;
use common\models\Outs;
use common\models\OutSearch;
use common\models\Personinfo;
use common\models\Status;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\MethodNotAllowedHttpException;
use yii\helpers\Json;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * OutController implements the CRUD actions for Out model.
 */
class OutController extends Controller
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
     * Lists all Out models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OutSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Out model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id, $isSerialized = false)
    {
        if ($isSerialized) {
            $person_ids = unserialize($id);
            $model = $this->findModel($person_ids[0]) ;
            $name = Personinfo::getEtcNames($person_ids);
        } else {
            $model = $this->findModel($id);
            $name = $model->owner->name;
        }
        return $this->render('view', [
            'model' => $model,
            'name' => $name,
            'id' => $id,
            'isSerialized' => $isSerialized,
        ]);
    }

    /**
     * when person leave out, need update time back.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id, $isSerialized = false)
    {
        if ($isSerialized) {
            $person_ids = unserialize($id);
            $model = $this->findModel($person_ids[0]) ;
            $name = Personinfo::getEtcNames($person_ids);
            if (!Personinfo::checkTheySameStatus($person_ids, Status::OUT)) {
                throw new MethodNotAllowedHttpException('有人没有外出，无法外出续假！');
            }
        } else {
            $model = $this->findModel($id);
            $name = $model->owner->name;
            if (!$model->owner->isOut) {
                throw new MethodNotAllowedHttpException('该同志不在外出，无法外出续假！');
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($isSerialized) {
                $model->cloneToOthers($person_ids);
            }
            return $this->redirect(['view', 'id' => $id, 'isSerialized' => $isSerialized]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'name' => $name,
            ]);
        }
    }

    /**
     * when persons cancel out, record time.
     * @param string $id
     * @return mixed
     */
    public function actionManyCancel()
    {
        if (isset($_POST['keylist'])) {
            $persons = ($_POST['keylist']);
            if (!is_array($persons)) {
                echo Json::encode([
                    'status' => 'error',
                ]);
            } else {
                if (!Personinfo::checkTheySameStatus($persons, Status::OUT)) {
                    echo Json::encode([
                        'status' => 'mixed',
                    ]);
                } else {
                    return $this->redirect(['cancel', 'id' => serialize($persons), 'isSerialized' => true]);
                }
            }
        } else {
            echo Json::encode([
                'status' => 'none',
            ]);
        }
    }

    /**
     * when persons leave out, record time.
     * @return mixed
     */
    public function actionManyLeave()
    {
        if (isset($_POST['keylist'])) {
            $persons = ($_POST['keylist']);
            if (!is_array($persons)) {
                echo Json::encode([
                    'status' => 'error',
                ]);
            } else {
                if (!Personinfo::checkTheySameStatus($persons, Status::HERE)) {
                    echo Json::encode([
                        'status' => 'mixed',
                    ]);
                } elseif (($status = Personinfo::checkOverOutProportion($persons))!= false) {
                    echo Json::encode([
                        'status' => $status,
                    ]);
                } else {
                    return $this->redirect(['leave', 'id' => serialize($persons), 'isSerialized' => true]);
                }
            }
        } else {
            echo Json::encode([
                'status' => 'none',
            ]);
        }
    }

    /**
     * when person leave out, record time.
     * @param string $id
     * @return mixed
     */
    public function actionLeave($id, $isSerialized = false)
    {
        if ($isSerialized) {
            $person_ids = unserialize($id);
            $model = $this->findModel($person_ids[0]) ;
            $name = Personinfo::getEtcNames($person_ids);
            if (!Personinfo::checkTheySameStatus($person_ids, Status::HERE)) {
                throw new MethodNotAllowedHttpException('有人没有不在队，无法外出！');
            }
        } else {
            $model = $this->findModel($id);
            $name = $model->owner->name;
            if (!$model->owner->isHere) {
                throw new MethodNotAllowedHttpException('该同志不在队，无法外出！');
            }
        }

        $model->time_leave = date('Y-m-d H:i:s');
        $model->time_come = date('Y-m-d H:i:s', strtotime('+4 hour'));
        $model->tel = $model->owner->tel;
        $model->time_cancel = null;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($isSerialized) {
                if (Personinfo::isOutOverProportion($person_ids)) {
                    throw new MethodNotAllowedHttpException('超出比例了！');
                }
                $model->cloneToOthers($person_ids);
                //Personinfo::setStatusForAll(Status::OUT, $person_ids);
                Outs::records($model, $person_ids);
            } else {
                if (Personinfo::isOutOverProportion($id)) {
                    throw new MethodNotAllowedHttpException('超出比例了！');
                }
                //$model->owner->setStatus(Status::OUT);
                Outs::record($model);
            }
            return $this->redirect(['view', 'id' => $id, 'isSerialized' => $isSerialized]);
        } else {
            return $this->render('leave', [
                'model' => $model,
                'name' => $name,
            ]);
        }
    }

    /**
     * when person cancel out, record time.
     * @param string $id
     * @return mixed
     */
    public function actionCancel($id, $isSerialized = false)
    {
        if ($isSerialized) {
            $person_ids = unserialize($id);
            $model = $this->findModel($person_ids[0]) ;
            $name = Personinfo::getEtcNames($person_ids);
            if (!Personinfo::checkTheySameStatus($person_ids, Status::OUT)) {
                throw new MethodNotAllowedHttpException('有人没有外出，无法外出销假！');
            }
        } else {
            $model = $this->findModel($id);
            $name = $model->owner->name;
            if (!$model->owner->isOut) {
                throw new MethodNotAllowedHttpException('该同志不在外出，无法外出销假！');
            }
        }

        $model->time_cancel = date('Y-m-d H:i:s');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($isSerialized) {
                $model->cloneToOthers($person_ids);
                //Personinfo::setStatusForAll(Status::HERE, $person_ids);
            } else {
                //$model->owner->setStatus(Status::HERE);
            }
            return $this->redirect(['view', 'id' => $id, 'isSerialized' => $isSerialized]);
        } else {
            return $this->render('cancel', [
                'model' => $model,
                'name' => $name,
                'id' => $id,
                'isSerialized' => $isSerialized,
            ]);
        }
    }

    /**
     * Finds the Out model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Out the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $owner = Personinfo::findOne($id);
        if ($owner === null) {
            throw new NotFoundHttpException('没有找到要外出的人。');
        }
        if (($model = Out::findOne($id)) === null) {
            $model = new Out;
            $model->id = $id;
            $model->loadDefault();
            $model->save();
        }
        return $model;
    }
}
