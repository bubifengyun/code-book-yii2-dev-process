<?php

namespace frontend\controllers;

use Yii;
use common\models\Message;
use common\models\MessageSearch;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * MessageController implements the CRUD actions for Message model.
 */
class MessageController extends Controller
{
    public $added=0;//当有新回复时，变为1。为1时，view会展示待审核信息。
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

        // add upload action for this controller
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
                'config' => [
                    "imagePathFormat" => "images/{yyyy}{mm}{dd}/{time}{rand:6}",
                    "imageRoot" => Yii::getAlias("@webroot"),
                    "filePathFormat" => "file/{yyyy}{mm}{dd}/{time}{rand:6}",
                    "fileMaxSize"             => 51200000000000,
                ],
            ],
        ];
    }

    /**
     * Lists all Message models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Message model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->setIHaveRead();
        $replyMessage = new Message();

        if ($replyMessage->load(Yii::$app->request->post())) {
            $replyMessage->sender = Yii::$app->user->identity->id;
            $replyMessage->receiver = $model->sender;
            $replyMessage->status = Message::UNREAD;
            if ($replyMessage->save()) {
                $this->added=1;
            }
        }

        return $this->render('view', [
            'model' => $model,
            'replyMessage'=>$replyMessage,
            'added'=>$this->added,
        ]);
    }

    /**
     * View all messages
     * @return mixed
     */
    public function actionViewAllMessages()
    {
        $id = Yii::$app->user->identity->id;

        // array
        $allMessages = Message::find()
            ->where([
                'sender' => $id,
            ])
            ->orWhere([
                'receiver' => $id,
            ])
            ->orderBy('status ASC, create_time DESC')
            ->all();
        Message::setIHaveReadAll($allMessages);

        return $this->render('viewallmessages', [
            'allMessages' => $allMessages,
        ]);
    }

    /**
     * View all message about sender
     * @param $id sender's id.
     * @return mixed
     */
    public function actionViewAboutUser($id)
    {
        $myid = Yii::$app->user->identity->id;
        $myname = Yii::$app->user->identity->username;
        $othername = User::findOne($id)->username;

        // array
        $allMessages = Message::find()
            ->where([
                'sender' => $id,
                'receiver' => $myid,
            ])
            ->orWhere([
                'sender' => $myid,
                'receiver' => $id,
            ])
            ->orderBy('create_time ASC')
            ->all();

        Message::setIHaveReadAll($allMessages);

        $replyMessage = new Message();

        if ($replyMessage->load(Yii::$app->request->post())) {
            $replyMessage->sender = $myid;
            $replyMessage->receiver = $id;
            $replyMessage->status = Message::UNREAD;
            if ($replyMessage->save()) {
                $this->added=1;
            }
        }

        return $this->render('viewaboutuser', [
            'allMessages' => $allMessages,
            'myname' => $myname,
            'othername' => $othername,
            'replyMessage'=>$replyMessage,
            'added'=>$this->added,
        ]);
    }

    /**
     * Creates a new Message model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionWrite()
    {
        $model = new Message();

        if ($model->load(Yii::$app->request->post())) {
            $model->sender = Yii::$app->user->identity->id;
            $model->status = Message::UNREAD;

            if ($model->save()) {
                return $this->redirect(['view-about-user', 'id' => $model->receiver]);
            }
        } else {
            return $this->render('write', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Message model.
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
     * Deletes an existing Message model.
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
     * Finds the Message model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Message the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Message::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
