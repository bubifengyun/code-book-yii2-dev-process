<?php

namespace frontend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property string $id
 * @property string $username
 * @property string $auth_key
 * @property string $access_token
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $created_at
 * @property string $updated_at
 * @property string $last_login_at
 * @property string $this_login_at
 * @property string $last_login_ip4
 * @property string $this_login_ip4
 * @property string $email
 * @property integer $role
 * @property string $job
 * @property integer $see_unit
 * @property string $profile
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'username', 'auth_key', 'password_hash', 'role', 'status'], 'required'],
            [['created_at', 'updated_at', 'last_login_at', 'this_login_at'], 'safe'],
            [['role', 'see_unit', 'status'], 'integer'],
            [['id', 'profile'], 'string', 'max' => 18],
            [['username', 'access_token', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key', 'job'], 'string', 'max' => 32],
            [['last_login_ip4', 'this_login_ip4'], 'string', 'max' => 15],
            [['avatar'], 'string', 'max' => 24],
            [['access_token'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '证件号码',
            'username' => '昵称',
            'auth_key' => '授权密钥',
            'access_token' => '访问令牌',
            'password_hash' => '密码',
            'password_reset_token' => '密码重置令牌',
            'created_at' => '创建时间',
            'updated_at' => '更改时间',
            'last_login_at' => '上次登录时间',
            'this_login_at' => '本次登录时间',
            'last_login_ip4' => '上次登录IP地址',
            'this_login_ip4' => '本次登录IP地址',
            'email' => '邮箱',
            'role' => '角色',
            'job' => '职务',
            'see_unit' => '查看单位',
            'profile' => '个人简介',
            'status' => '状态',
            'avatar' => '照片',
        ];
    }
}
