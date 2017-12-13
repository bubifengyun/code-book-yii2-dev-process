通过 Webrtc 获得客户端本地 IP
=============================
Get Client Local Ip by Webrtc
=============================

博客原文：http://my.oschina.net/bubifengyun/blog/690253

示例代码，**请勿用于生产环境!**

Just a demo, **Do not use in production envrionment!**

由于网站只可以运行在局域网，随想获取本地 IP 地址，作为一个验证项。虽然可以通过设置假的 IP 来欺骗服务器，但也能在一定程度上做到仅限于特定IP的电脑访问。

适用于支持 WebRTC 的浏览器，比如火狐、谷歌等。且这些浏览器没有关闭 WebRTC 获得本地 IP 的功能。

using webrtc, get client local ip by javascript in some browser, such as firefox, chrome and opera.

安装
----

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist bubifengyun/yii2-webrtc-get-client-local-ip "*"
```

or add

```
"bubifengyun/yii2-webrtc-get-client-local-ip": "*"
```

to the require section of your `composer.json` file.

用法
----

Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
        <?= $form
            ->field($model, 'ip')
            ->widget(\bubifengyun\WebrtcGetClientLocalIp\WebRTCLocalIPWidget::className(), [
                'id' => 'loginform-ip',
                'hidden' => true,
            ]) ?>

```

**Note**
+ `'id' => 'loginform-ip',` id was seen from source code.
+ `id` 是从浏览器查看源码看到的，暂时不会设置该 `id`


参考
----

Ref
---

+ http://stackoverflow.com/questions/391979/how-to-get-clients-ip-address-using-javascript-only
+ https://github.com/diafygi/webrtc-ips
+ http://www.yiichina.com/tutorial/459
+ http://www.html-js.com/article/Learn-JavaScript-every-day-to-understand-what-JavaScript-Promises
