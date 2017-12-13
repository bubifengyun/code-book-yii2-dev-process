<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\NotFoundHttpException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\imagine\Image;

/**
 * User model
 *
 * @property integer $id
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
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const CONSOLE_CRON_USER = '00000000@00.00';

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
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => date('Y-m-d H:i:s', time()),
            ],
        ];
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
            [['id', 'profile'], 'string', 'max' => 64],
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
            'username' => '用户昵称',
            'auth_key' => '授权密钥',
            'access_token' => '访问令牌',
            'password_hash' => '密码',
            'password_reset_token' => '密码重置令牌',
            'created_at' => '创建时间',
            'updated_at' => '更改时间',
            'last_login_at' => '上次登录时间',
            'this_login_at' => '本次登录时间',
            'last_login_ip4' => '下次登录IP地址',
            'this_login_ip4' => '本次登录IP地址',
            'email' => '邮箱',
            'role' => '角色',
            'job' => '职务',
            'see_unit' => '查看单位',
            'own_unit' => '自己单位',
            'profile' => '个人简介',
            'status' => '状态',
            'avatar' => '照片',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        if (strpos($username, '@')) {
            $param = 'id';
        } else {
            $param = 'username';
        }
        return static::findOne([$param => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates IP
     * @param string $ip client local ip
     *
     * @return boolean if ip provided is valid for current user
     */
    public function validateIP($ip)
    {
        $this->this_login_ip4 = $ip;
        $this->save();
        if ($this->last_login_ip4 === null || $this->last_login_ip4 == '') {
            $this->last_login_ip4 = $ip;
            $this->save();
            return true;
        }
        if ($this->last_login_ip4 == $ip) {
            return true;
        }
        return false;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Validates user is backend
     *
     * @return boolean if user is backend user.
     */
    public function validateBackend()
    {
        return $this->is_backend;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * get unread message count
     * @return integer
     */
    public function getMessageUnreadCount()
    {
        $messageUnreadCount = (new \yii\db\Query())
            ->from(Message::tableName())
            ->where([
                'receiver' => $this->id,
                'status' => Message::UNREAD,
            ])
            ->count();
        return $messageUnreadCount;
    }

    /**
     * get total message count
     * @return integer
     */
    public function getMessageCount()
    {
        $messageCount = (new \yii\db\Query())
            ->from(Message::tableName())
            ->where([
                'receiver' => $this->id,
            ])
            ->count();
        return $messageCount;
    }

    /**
     * @return \yii\db\Query
     */
    public function getMessagesUnreadLimited()
    {
        return $this->hasMany(Message::className(), ['receiver' => 'id'])
            ->where([
                'status' => Message::UNREAD,
            ])
            ->orderBy([
                'create_time' => SORT_DESC,
                'sender' => SORT_ASC,
            ])
            ->limit(Message::COUNT_LIMITED);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['receiver' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSentry()
    {
        $result = $this->hasOne(Sentry::className(), ['user_id' => 'id']);
        if ($result->count() == 0) {
            throw new NotFoundHttpException('请先到左边栏岗哨管理，修改或添加某个岗哨的用户为本用户！');
        }
        return $result;
    }

    /**
     * 保存用户头像
     * @return bool
     */
    public function saveAvatar()
    {
        Yii::setAlias('@upload', '@root/web/storage/uploads/user/avatar/');
        $extension =  strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
        $fileName = $this->id . '_' . time() . rand(1, 10000) . '.' . $extension;
        $fileName = rand(1, 10000) . '.' . $extension;

        Image::thumbnail($_FILES['file']['tmp_name'], 160, 160)->save(Yii::getAlias('@upload') . $fileName, ['quality' => 80]);

        //删除旧头像
        if (file_exists(Yii::getAlias('@upload').$this->avatar) && (strpos($this->avatar, 'default') === false))
            @unlink(Yii::getAlias('@upload').$this->avatar);

        $this->avatar = $fileName;
        return $this->save();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['author_id' => 'id']);
    }
}
