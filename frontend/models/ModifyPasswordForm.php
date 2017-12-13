<?php
namespace frontend\models;

use common\models\User;
use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;

/**
 * Password reset form
 */
class ModifyPasswordForm extends Model
{
    public $password_old;
    public $password_new;
    public $password_new_check;
    public $id;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password_old','password_new','password_new_check'], 'required'],
            ['password_old', 'string'],
            ['password_old', 'verifyright'],
            [['password_new','password_new_check'], 'string', 'min' => 6],
            ['password_new_check', 'compare', 'compareAttribute' => 'password_new'],
        ];
    }

    /**
     * Modify password.
     *
     * @return boolean if password was Modified.
     */
    public function modifyPassword()
    {
        $user = \Yii::$app->user->identity;
        $user->setPassword($this->password_new);

        return $user->save(false);
    }

    /**
     * Verify password is right
     *
     * @return boolean if verify passed
     */
    public function verifyright()
    {
        if (!\Yii::$app->user->identity->validatePassword($this->password_old)) {
            $this->addError('password_old', '旧密码错误！');
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'password_old' => '旧密码',
            'password_new' => '新密码',
            'password_new_check' => '新密码确认',
        ];
    }
}
