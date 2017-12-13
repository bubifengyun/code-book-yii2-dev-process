<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use common\models\Follow;
use common\models\UserSearch;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\BaseYii;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * change avatar for current user.
     * @param string $avatar
     * @return mixed
     */
    public function actionChangeAvatar($avatar = null)
    {
        if ($avatar != null) {
            $me = Yii::$app->user->identity;
            $me->avatar = $avatar;
            if ($me->save()) {
                Yii::$app->session->setFlash('success', '您成功设置这张图片为头像！');
            } else {
                Yii::$app->session->setFlash('error', '您头像设置失败！');
            }

            return $this->render('_avatar', [
                'model' => $avatar,
            ]);
        }
        $id = Yii::$app->user->id;
        $dir = "@vendor/almasaeed2010/adminlte/dist/img/";
        $files = scandir(BaseYii::getAlias($dir));
        $dataProvider = new ArrayDataProvider([
            'allModels' => $files,
        ]);

        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('_changeavatar', [
                'dataProvider' => $dataProvider,
                'onlyItems' => true,
            ]);
        }
        return $this->render('changeavatar', [
            'dataProvider' => $dataProvider,
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single User model.
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
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionUpdate()
    {
        $model = $this->findModel(Yii::$app->user->id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->this_login_ip4 !== $model->last_login_ip4) {
                Yii::$app->user->logout();
                return $this->goHome();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionFriends()
    {
        $uid=Yii::$app->user->id;

        $friend_follows = Follow::findAll(['uid' => $uid]);
        $friendIDs = [];
        foreach ($friend_follows as $follow) {
            array_push($friendIDs, $follow->fid);
        }
        $friends = User::findAll($friendIDs);

        return $this->render('friends', [
            'friends' => $friends,
        ]);
    }

    public function actionFans()
    {
        $uid=Yii::$app->user->id;

        $fan_follows = Follow::findAll(['fid' => $uid]);
        $fanIDs = [];
        foreach ($fan_follows as $follow) {
            array_push($fanIDs, $follow->uid);
        }
        $fans = User::findAll($fanIDs);

        return $this->render('fans', [
            'fans' => $fans,
        ]);
    }

    /**
     * @return string 读取用户列表
     */
    public function actionIndex()
    {
        $uid=Yii::$app->user->id;

        $fan_follows = Follow::findAll(['fid' => $uid]);
        $fanIDs = [];
        foreach ($fan_follows as $follow) {
            array_push($fanIDs, $follow->uid);
        }
        $fans = User::findAll($fanIDs);

        $friend_follows = Follow::findAll(['uid' => $uid]);
        $friendIDs = [];
        foreach ($friend_follows as $follow) {
            array_push($friendIDs, $follow->fid);
        }
        $friends = User::findAll($friendIDs);

        array_push($friendIDs, $uid);
        $users = User::find()->where(['not in','id', $friendIDs])->all();

        return $this->render('index', ['users'=>$users,'fans'=>$fans,'friends'=>$friends,'friendIDs'=>$friendIDs]);
    }

    /**
     * @添加关注动作
     */
    public function actionFollow($fid)
    {
        $uid = Yii::$app->user->id;

        //检查是否已经关注了
        $obj = new Follow();
        $num = $obj->find()->Where(['uid'=>$uid,'fid'=>$fid])->count();
        if ($num == 0) {
            $obj->uid=$uid;
            $obj->fid=$fid;
            if ($obj->save()) {
                Yii::$app->session->setFlash('success', '关注成功！');
            } else {
                Yii::$app->session->setFlash('error', '关注失败！');
            }
        } else {
            Yii::$app->session->setFlash('error', '已经关注！');
        }
        return $this->redirect(['index']);
    }

    /**
     * @取消关注
     */
    public function actionNofollow($fid)
    {
        $uid=Yii::$app->user->getId();
        //检查是否已经关注了
        $user=Follow::find()->andWhere(['uid'=>$uid,'fid'=>$fid])->one();

        if (count($user)>0) {
            //$user->delete() 失败，提示没有定义主键
            $user->deleteAll('uid=:uid and fid=:fid', [':uid'=>$uid,':fid'=>$fid]);
            Yii::$app->session->setFlash('success', '取消关注成功！');
        } else {
            Yii::$app->session->setFlash('error', '取消关注失败！');
        }
        return $this->redirect(['index']);
    }

    /**
     * 选择系统头像
     */
    public function actionAvatar($name = null)
	{
        if (Yii::$app->request->isAjax) {
            if (($name = intval($name))) {
                if ($name >= 1 && $name <= 40) {
                    //删除旧头像
                    $avatar = Yii::$app->user->identity->avatar;
                    $path = Yii::getAlias('@webroot/uploads/user/avatar/') . $avatar;
                    if (file_exists($path) && (strpos($avatar, 'default') === false))
                        @unlink($path); 
                    return Yii::$app->db->createCommand()->update('{{%user}}', [
                        'avatar' => 'default/' . $name . '.jpg',
                    ], 'id=:id', [':id' => Yii::$app->user->id])->execute();
                } else {
                    throw new NotFoundHttpException('The requested page does not exist.');
                }
            } else {
                return $this->renderAjax('avatar');
            }
        } else {
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
	}
}
