<?php
namespace backend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $role;
    public $see_unit;
    public $own_unit;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '这个名字已经被注册了。'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['role', 'required'],
            ['see_unit', 'required'],
            ['own_unit', 'required'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => '这个邮箱已经被注册了。'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->id = $this->email;
            $user->email = $this->email;
            $user->role = 1; // role is useless.
            $user->see_unit = $this->see_unit;
            $user->own_unit = $this->own_unit;
            $user->status = User::STATUS_ACTIVE;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                $auth = Yii::$app->authManager;
                $authorRole = $auth->getRole($this->role);
                $auth->assign($authorRole, $user->id);
                return $user;
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => '邮箱(不验证真实性)',
            'username' => '用户名称',
            'password' => '密码',
            'role' => '角色',
            'see_unit' => '查看单位',
            'own_unit' => '管辖单位',
        ];
    }
}
