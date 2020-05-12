<?php

namespace admin\assets;

use yii\web\AssetBundle;

/**
 * Main admin application asset bundle.
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'web/css/site-login.css',
    ];
    public $js = [
    ];
   
}
