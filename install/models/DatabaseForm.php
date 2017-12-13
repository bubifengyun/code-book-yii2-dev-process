<?php
namespace install\models;

use yii\base\Model;
use Yii;
use yii\db\Connection;
use yii\db\Exception;
use common\helpers\Dsn;

class DatabaseForm extends Model
{
    public $username;

    public $password;

    public $database = 'db_wuzhishan';

    public $hostname = "127.0.0.1";

    public $port = "3306";
    
    public $prefix = "tbl_";

    public function rules()
    {
        return [
            [['hostname', 'username', 'database', "hostname", "port"], 'required'],
            [['hostname'], 'checkDb'],
            [['database'], 'match', 'pattern' => '/^[a-zA-Z][a-zA-Z0-9_]{1,}$/', 'message' => '只可以包含字母数字下划线，且数字下划线不可以开头'],
            [['password', "prefix"], 'safe']
        ];
    }
    
    public function checkDb($attribute, $params)
    {
        $link = mysqli_connect($this->hostname, $this->username, $this->password);
        if (mysqli_connect_errno()) {
            $this->addError("database", mysqli_connect_error());
            return false;
        }
        if (mysqli_select_db($link, $this->database) === false) {
            // 有 SQL 注入风险，建议提高权限
            mysqli_query($link, "CREATE DATABASE IF NOT EXISTS {$this->database} DEFAULT CHARSET utf8 COLLATE utf8_general_ci;");
        } else {
            $query = mysqli_query($link, "SHOW TABLES;");
            if ($query->num_rows > 0) {
                $this->addError("database", "您选择的数据库不为空，为避免冲突，请换个名字！");
                return false;
            }
        }
        mysqli_close($link);
    }

    public function loadDefaultValues()
    {
        $definitions = \Yii::$app->getComponents();
        
        if (isset($definitions["db"])&&isset($definitions["db"]['dsn'])) {
            $dsn = Dsn::parse($definitions["db"]['dsn']);
            $this->hostname = $dsn->host;
            $this->database = $dsn->database;
            $this->port = $dsn->port;
            $this->username = $definitions["db"]['username'];
            $this->password = $definitions["db"]['password'];
            $this->prefix =  $definitions["db"]['tablePrefix'];
        }
    }
    
    public function attributeLabels()
    {
        return [
            'hostname' => '数据库地址',
            'username' => '数据库用户名',
            'password' => '数据库密码',
            'database' => '数据库名称',
            "port" => "端口",
            "prefix" => "前缀"
        ];
    }

    public function save()
    {
        Yii::$app->setEnv('DB_USERNAME', $this->username);
        Yii::$app->setEnv('DB_PASSWORD', $this->password);
        Yii::$app->setEnv('DB_TABLE_PREFIX', $this->prefix);
        Yii::$app->setEnv('DB_DSN', "mysql:host=$this->hostname;dbname=$this->database;port=$this->port");
        Yii::$app->set('db', Yii::createObject([
            'class' => 'yii\db\Connection',
            'dsn' => "mysql:host=$this->hostname;dbname=$this->database;port=$this->port",
            'username' => $this->username,
            'password' => $this->password,
            'charset' => 'utf8',
            "tablePrefix" => $this->prefix
        ]));
        return true;
    }
}
