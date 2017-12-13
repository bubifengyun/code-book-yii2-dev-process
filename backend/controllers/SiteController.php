<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use backend\models\LoginForm;
use common\models\Setting;
use backend\models\SignupForm;
use yii\filters\VerbFilter;
use yii2tech\crontab\CronJob;
use yii2tech\crontab\CronTab;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'setting', 'download', 'cron-job', 'signup'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'download' => [
                'class' => 'common\actions\DownloadAction',
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSetting()
    {
        $models = Setting::find()
            ->where(1)
            ->orderBy('key')
            ->all();
        if (isset($_POST['Setting'])) {
            foreach ($_POST['Setting'] as $postObj) {
                Yii::$app->setting->set([
                    $postObj['key'] => $postObj['value']
                ]);
            }
            $models = Setting::find()
                ->where(1)
                ->orderBy('key')
                ->all();
        }
        return $this->render('setting', [
            'models' => $models,
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                $url = "<a href='http://localhost/index.php'>前端</a>";
                Yii::$app->session->setFlash('success', "非常感谢您的注册，您可以到 $url 登录！<br>
                    账号：$user->username 或 $user->id");
                return $this->refresh();
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionCronJob()
    {
        $model = new CronJob();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $cronTab = new CronTab();
                $cronTab->setJobs([
                    $model,
                ]);
                $cronTab->apply();
                exec('crontab -l', $outputLines, $exitCode);
                if ($exitCode === 0) {
                    return var_dump($outputLines);
                }
                return;
            }
        }

        return $this->render('cron-job', [
            'model' => $model,
        ]);
    }
}
