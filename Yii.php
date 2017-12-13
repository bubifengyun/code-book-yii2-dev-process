<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

//require __DIR__ . '/vendor/yiisoft/yii2/BaseYii.php';
if (is_file(__DIR__ . '/.env')) {
    (new \Dotenv\Dotenv(__DIR__))->load();
}

defined('YII_DEBUG') or define('YII_DEBUG', env('YII_DEBUG'));
defined('YII_ENV') or define('YII_ENV', env('YII_ENV', 'prod'));

/**
 * Yii is a helper class serving common framework functionalities.
 *
 * It extends from [[\yii\BaseYii]] which provides the actual implementation.
 * By writing your own Yii class, you can customize some functionalities of [[\yii\BaseYii]].
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Yii extends \yii\BaseYii
{
    public static function getVersion()
    {
        return '0.0.1';
    }

    public static function powered()
    {
        return parent::powered() . ' & <a href="http://github.com/bubifengyun/book-yii2-dev-process" rel="external">网站说明</a>';
    }
}

spl_autoload_register(['Yii', 'autoload'], true, true);
Yii::$classMap = require __DIR__ . '/vendor/yiisoft/yii2/classes.php';
Yii::$container = new yii\di\Container();

function checkInstalled()
{
    return file_exists(Yii::getAlias('@root/web/storage/install.txt'));
}
