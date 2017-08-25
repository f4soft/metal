<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{    
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700',
        'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&subset=cyrillic',
        'css/slick.css',
        'css/styles.css',
        'css/media.css',
        'css/select2.min.css'
    ];
    public $js = [
        'js/slick.min.js',
        'js/select2.min.js',
        'js/jquery.maskedinput.min.js',
        'js/main.js',
        //'js/jivosite.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
