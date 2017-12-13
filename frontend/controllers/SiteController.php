<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use common\models\Follow;
use common\models\User;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\ContactForm;
use frontend\models\ModifyPasswordForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
                        'actions' => ['login', 'error', 'download', 'request-password-reset'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
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

    public function actionModifyPassword()
    {
        $model = new ModifyPasswordForm();

        if ($model->load(Yii::$app->request->post())) {
            /**
             * Because firefox pop notify whose
             * password need modify, so set id=0
             */
            $model->id = 0;
            if ($model->validate()) {
                $model->modifyPassword();
                return $this->goBack();
            }
        }

        return $this->render('modifypassword', [
            'model' => $model,
        ]);
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'download' => [
                'class' => 'common\actions\DownloadAction',
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionProcessIp()
    {
        if (isset($_POST['localip'])) {
            $client_local_ip = $_POST['localip'];
            Yii::$app->session->set('client_local_ip', $client_local_ip);
            if (!is_array($client_local_ip)) {
                echo Json::encode([
                    'status' => 'error',
                ]);
            } else {
                echo Json::encode([
                    'status' => 'success',
                ]);
            }
        } else {
            echo Json::encode([
                'status' => 'none',
            ]);
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $browser = $this->getBrowser();
            $isIE = (strpos($browser, 'Internet Explorer') !== false);
            if ($isIE) {
                return $this->render('downloadbrowser');
            }
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', '感谢您的反馈，我们将尽快答复您。');
            } else {
                Yii::$app->session->setFlash('error', '发送失败！');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays test page.
     *
     * @return mixed
     */
    public function actionTest()
    {
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    protected function getBrowser()
    {
        if (empty($_SERVER['HTTP_USER_AGENT'])) {
            return '命令行，机器人来了！';
        }
        if (false!==strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) {
            return 'Internet Explorer';
        }
        if (false!==strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox')) {
            return 'Firefox';
        }
        if (false!==strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome')) {
            return 'Chrome';
        }
        if (false!==strpos($_SERVER['HTTP_USER_AGENT'], 'Safari')) {
            return 'Safari';
        }
        if (false!==strpos($_SERVER['HTTP_USER_AGENT'], 'Opera')) {
            return 'Opera';
        }
        if (false!==strpos($_SERVER['HTTP_USER_AGENT'], '360SE')) {
            return '360SE';
        }

        return 'Unknown';
    }
}
