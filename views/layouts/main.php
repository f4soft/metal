<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;
use app\models\Cities;
use \app\models\SeoTags;
use app\components\SeoTagsUtility;

AppAsset::register($this);
$cartId = \app\models\Cart::getCartId();
$baseUrl = $url = Yii::$app->request->url;
/*canonical page*/
$cities = Cities::find()->select(['alias'])->where(['status'=>1,'is_default'=>0])->asArray('alias')->all();
foreach ($cities as $city) {
    $cList[]= $city['alias'];
    if (strpos($url, $city['alias']) !== false) {
        $url = str_replace($city['alias'], '', $url);
        if (strpos($url, '//') !== false) {
            $url = str_replace('//', '/', $url);
        }
        $canonical = false;
        $url = Yii::$app->request->hostInfo.$url;
        break;
    }
}
/*alternate links*/
$altLinks = [];
$langList = Yii::$app->params['langs'];
$curLang = Yii::$app->language;
$baseUrl = Yii::$app->request->pathInfo;
$host = Yii::$app->request->hostInfo;
foreach ($langList as $k=>$lang) {
    $tempAlt = ['link' => '', 'lang' => ''];
    if ($k == 'ru-RU') {
        $tempAlt['link'] = $baseUrl? $host .'/'. $baseUrl: $host;
        $tempAlt['lang'] = 'ru-UA';
    } else {
        $tempAlt['link'] = $host . Url::to(['/' .$baseUrl, 'language' => $lang]);
        $tempAlt['lang'] = $k;
    }
    $altLinks[] = $tempAlt;
}

if (SeoTagsUtility::$active) {
    $this->title = SeoTagsUtility::$title;
    $this->registerMetaTag([
        'name' => 'description',
        'content' => SeoTagsUtility::$description,
    ]);
} else {
    $meta = SeoTags::getMetaTags(\Yii::$app->request->getUrl());
    if ($meta) {
        $this->title = $meta->title;
        $this->registerMetaTag([
            'name' => 'description',
            'content' => $meta->description,
        ], 'description');
    }
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= Html::encode($this->title) ?></title>
    <?php if (!empty($altLinks) && count($altLinks)): ?>
    <?php foreach ($altLinks as $altLink): ?>
    <link rel="alternate" hreflang="<?= $altLink['lang']?>" href="<?= $altLink['link']?>"/>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php if (!empty($url)): ?>
    <link <?= !empty($canonical) ? 'rel="canonical"' : ''; ?>  href="<?= $url?>">
    <?php endif;?>
    <?php $this->head() ?>
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5PVBFZ');</script>
    <!-- End Google Tag Manager -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5PVBFZ" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<?php $this->beginBody() ?>

<?php $city = isset(Yii::$app->request->get()['city']) ? Yii::$app->request->get()['city'] : '' ?>

<?= $this->render('header', ['currentСity' => $city, 'cartId' => $cartId])?>


<?= $this->render('content', ['content' => $content])?>
<?php $total = \app\models\CartProducts::getTotal();?>

<?= $this->render('@app/views/products/popup_cart', ['selectedCity' => $city]);?>

<?= $this->render('footer')?>
<?php if(Yii::$app->params['langs'][Yii::$app->language] != 'ru'):?>
<input type="hidden" id="siteLang" value="<?=Yii::$app->params['langs'][Yii::$app->language]?>">
<?php endif;?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
