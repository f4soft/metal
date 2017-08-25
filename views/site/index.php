<?php

/* @var $this yii\web\View */

$ctParam = '';
?>

<div class="container-fluid home-banner-with-map margin-top-0 margin-bottom-0" style="background-image:url(/img/home-banner-top.jpg)">
    <div class="container">

        <div class="text-on-banner left">
            <span class="medium-text"><?= Yii::t('app', 'СЕРВИСНЫЙ МЕТАЛЛОЦЕНТР')?></span>
            <a href="<?= \yii\helpers\Url::to(["/{$selectedCity}/catalog"])?>" class="top-banner-link"><?= Yii::t('app', 'Смотреть каталог продукции')?>
                <span class="glyphicon glyphicon-menu-right"></span>
            </a>
            <a href="<?= \yii\helpers\Url::to(["/{$selectedCity}/sales"])?>" class="top-banner-link baner-backgraund-color-sales"><?= Yii::t('app', 'Спецпредложения')?>
                <span class="glyphicon glyphicon-menu-right"></span>
            </a>
        </div>

        <div class="text-on-banner right">
            <div class="image"><img src="/img/top-home-delivery.png" alt="<?= Yii::t('app', 'Доставка по всей Украине')?>" title="<?= Yii::t('app', 'Доставка по всей Украине')?>"></div>
            <div class="text">
                <p class="small"><?= Yii::t('app', 'Доставка по всей')?></p>
                <p class="large"><?= Yii::t('app', 'Украине')?></p>
                <a href="<?= \yii\helpers\Url::to(["/{$selectedCity}/offices"])?>" class="link"><?= Yii::t('app', 'Смотреть филиалы')?>
                    <span class="glyphicon glyphicon-menu-right"></span>
                </a>
            </div>
        </div>

        <?php if($cities):?>
            <div class="interactive-map scaled">
                <div class="map-content">
                    <a href="<?= \yii\helpers\Url::to(["/$ctParam/offices"])?>">
                        <img src="/img/map-ukraine-home.png" alt="">
                    </a>
                    <?php foreach ($cities as $city): ?>
                        <?php $ctParam = $city->alias != 'kiev' ? $city->alias : ''; ?>

                        <div class="city-item <?=$city->alias?>">
                            <a href="<?= \yii\helpers\Url::to(["/$ctParam/offices#contacts"])?>" class="city-sticker"><i class="i-holder i-plant"></i><i class="i-holder
                            i-marker"></i><?= $city->title?></a>
                            <div class="city-info">
                                <span class="title"><?= $city->title?></span>
                                <div class="contacts">
                                    <?php foreach ($city->officesByCity as $office):?>
                                        <?php if($office->is_main): ?>
                                            <p class="tel"><span><?= Yii::t('app', 'Тел')?>:</span><?= $office->phone?></p>
                                            <p class="adress"><span><?= Yii::t('app', 'Адрес')?>: </span><?= \yii\helpers\StringHelper::truncate($office->address, 35)?>
                                                <?= \kartik\helpers\Html::a(Yii::t('app', 'Подробнее') . "<i class=\"i-holder read-more-i\"></i>", \yii\helpers\Url::to(["/$ctParam/offices"]));?>
                                            </p>
                                        <?php endif;?>
                                    <?php endforeach;?>

                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        <?php endif;?>
    </div>
</div>

<div class="container-fluid our-advantages-block margin-top-0 margin-bottom-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
              <span class="adv-item adv-text1">
                <i class="i-holder"></i><?= Yii::t('app', "Широкий<br/>ассортимент")?>
              </span>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
              <span class="adv-item adv-text2">
                <i class="i-holder"></i><?= Yii::t('app', "Cертифицированная<br/>продукция")?>
              </span>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <span class="adv-item adv-text3">
                  <i class="i-holder"></i><?= Yii::t('app', "Быстрая<br/>Доставка")?>
                </span>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <span class="adv-item adv-text4">
                    <i class="i-holder"></i><?= Yii::t('app', "Индивидуальный<br/>подход")?>
                </span>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <span class="adv-item adv-text5">
                    <i class="i-holder"></i><?= Yii::t('app', "Полный спектр<br/>услуг")?>
                </span>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <span class="adv-item adv-text6">
                    <i class="i-holder"></i><?= Yii::t('app', "Высокая скорость<br/>обслуживания");?>
                </span>
            </div>
        </div>
    </div>
</div>

<?= $this->render('@app/views/catalog/inc/catalog-block', ['selectedCity' => $selectedCity, 'blockSettings' => $blockSettings]);?>

<!--<div class="container-fluid banner-large-block margin-top-0 margin-bottom-0">
    <img src="/img/banner-big.jpg">
</div>-->

<?php if($popularProducts = \app\models\Products::getPopular()):?>
    <div class="container popular-products-block">
        <h2 class="h2 stripped-title"><span><?= Yii::t('app', 'Популярная продукция')?></span></h2>
        <div class="popular-product-carousel" >
            <?php foreach ($popularProducts as $item) :?>
                <div class="item col-xs-2">
                    <?php $url = \app\models\Products::getUrl($item);?>
                    <a href="<?= \yii\helpers\Url::to(["/{$selectedCity}/{$url}"])?>">
                        <?php $root = \app\models\ProductsCategories::getRootCategory($item->category_id); ?>
                        <?php if ($root->alias != 'kovanye-izdelia'): ?>
                            <?php $catTemp = \app\models\ProductsCategories::findOne(['id' => $item->category_id]) ?>
                            <?php $image = '/' . $catTemp->getImageUrl(Yii::$app->params['imagePresets']['products']['popular'], \app\models\ProductsCategories::tableName(), 'image'); ?>
                        <?php else: ?>
                            <?php $image = '/' . $item->getImageUrl(Yii::$app->params['imagePresets']['products']['popular'], \app\models\Products::tableName(), 'image'); ?>
                        <?php endif; ?>
                        <?= \kartik\helpers\Html::img($image, ['class' => "img", 'alt' => $item->image_alt, 'title' => $item->image_title]); ?>
                        <span class="title"><?= $item->title?></span>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif;?>
<?php if($services):?>
    <div class="container-fluid our-services-block margin-top-0 margin-bottom-0">
        <div class="container">
            <span class="h2"><?= Yii::t('app', 'Наши услуги')?></span>
            <?php foreach ($services as $key => $service):?>
                <?php $image = '/' . $service->getImageUrl(Yii::$app->params['imagePresets']['services-small']['main'], \app\models\Services::tableName(), 'small_image');?>
                <div class="service-item item<?=$service->id?> active">
                    <a href="<?= \yii\helpers\Url::to(["/{$selectedCity}/services#service{$service->id}"])?>">
                            <span class="icon">
                                <?= \kartik\helpers\Html::img($image, ['alt' => $service->small_image_alt, 'title' => $service->small_image_title]);?>
                            </span>
                        <span class="text"><span class="inner-text"><?= $service->title?></span></span>
                    </a>
                </div>
            <?php endforeach;?>
        </div>
    </div>
<?php endif;?>

<div class="container-fluid about-news-block margin-top-0 margin-bottom-0">
    <div class="container">
        <h2 class="h2"><?= Yii::t('app', 'О компании + новости')?></h2>
        <div class="col-lg-6 col-md-6 about-company-preview">
            <div class="about-company-preview-inner">
                <h3><?= Yii::t('app', 'О компании')?></h3>
                <?= \kartik\helpers\Html::a(\kartik\helpers\Html::img(\app\models\BlockSettings::getBlockSettingsImage($blockSettings->about_image, 547, 274),
                    [
                        'alt'   => $blockSettings->about_image_alt,
                        'title' => $blockSettings->about_image_title,
                        'class' => "img-responsive"
                    ]), \yii\helpers\Url::to(["{$selectedCity}/about"]));?>
                <?= \yii\helpers\StringHelper::truncate($blockSettings->about_main_page_description, 500)?>
                <a href="<?= \yii\helpers\Url::to(["/$selectedCity/about"])?>" class="preview-show-more-lg"><?= Yii::t('app', 'Смотреть подробнее о компании')?><i class="i-holder read-more-i"></i></a>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 news-preview">
            <div class="news-preview-inner">
                <h3><?= Yii::t('app', 'Новости')?></h3>
                <?php foreach ($news as $item):?>
                <div class="news-item">
                    <?php
                        $imageModel = new \app\models\ImageUpload(\app\models\News::tableName());
                        $image = $imageModel->getImage($item, Yii::$app->params['imagePresets']['news']['small'], 'view', 'image');
                    ?>
                    <?= \kartik\helpers\Html::a(\kartik\helpers\Html::img('/'.$image, ['class'=> 'news-preview-img',
                        'alt'=>$item->image_alt, 'title'=>$item->image_title])
                        , \yii\helpers\Url::to(["/$selectedCity/presscenter/news/{$item->alias}"]))?>
                    <?= \kartik\helpers\Html::a(\yii\helpers\StringHelper::truncate($item->title, 50), \yii\helpers\Url::to(["/$selectedCity/presscenter/news/{$item->alias}"]),
                        ['class' => 'preview-title'])?>
                    <span class="preview-date"><?= Yii::$app->formatter->asDate($item->created_at)?></span>
                    <p class="preview-text"><?= \yii\helpers\StringHelper::truncate(strip_tags($item->description), 80);?></p>
                </div>
                <?php endforeach;?>
                <a href="<?= \yii\helpers\Url::to(["/$selectedCity/presscenter/news"])?>" class="preview-show-more-lg"><?= Yii::t('app', 'Смотреть Все новости')?><i class="i-holder read-more-i"></i></a>
            </div>
        </div>
    </div>
</div>

<?php if($articles):?>
    <div class="container articles-block">
        <h2 class="h2 stripped-title"><span><?= Yii::t('app', 'Статьи')?></span></h2>
        <div class="row">
            <div class="col-lg-8">
                <div class="article-list">
                    <?php foreach ($articles as $article):?>
                        <div class="article-item">
                            <h3 class="h3"><?= \yii\helpers\StringHelper::truncate($article->title, 50);?></h3>
                            <?= \kartik\helpers\Html::a(\kartik\helpers\Html::img('/'.$article->getImageUrl(Yii::$app->params['imagePresets']['articles']['smallArticle'],
                                    \app\models\Articles::tableName()), ['alt' => $article->image_alt, 'title' => $article->image_title]), \yii\helpers\Url::to(["/$selectedCity/presscenter/articles/{$article->alias}"]))?>
                            <span class="preview-date"><?= Yii::$app->formatter->asDate($article->created_at)?></span>
                            <p class="preview-text">
                                <?= \yii\helpers\StringHelper::truncate(strip_tags($article->description), 350);?>
                                <a href="<?= \yii\helpers\Url::to(["/$selectedCity/presscenter/articles/{$article->alias}"])?>" class="read-more"><?= Yii::t('app', 'Подробнее')?><i class="i-holder read-more-i"></i></a>
                            </p>
                        </div>
                    <?php endforeach;?>
                    <a href="<?= \yii\helpers\Url::to(["/$selectedCity/presscenter/articles"]) ?>" class="preview-show-more-lg"><?= Yii::t('app', 'Читать все статьи')?><i class="i-holder read-more-i"></i></a>
                </div>
            </div>
            <?= $this->render('@app/views/site/inc/news-subscribe', ['model' => $modelSubscribe])?>
        </div>
    </div>
<?php endif;?>

<?= $this->render('@app/views/layouts/inc/contact', ['model' => $modelContact])?>
<?= $this->render('@app/views/layouts/inc/popup_contact')?>
