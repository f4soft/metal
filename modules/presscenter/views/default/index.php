<?php
use kartik\helpers\Html;
$this->title = Yii::t('app', 'Пресс-центр');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'template' => "<li class='breadcrumbs-i' itemtype = 'http://schema.org/ListItem'>
            <span class='breadcrumbs-title' itemprop = 'name'>{link}</span>
            </li>"];
?>
<div class="container-fluid page-title-block margin-top-0 margin-bottom-0">
    <div class="thumb" style="background: url('<?= $head_img->getImageBg(); ?>') no-repeat center center"></div>
    <div class="container-fluid page-title-content">
        <div class="container">
            <img src="<?= $head_img->getImageCircle(); ?>" alt="" title="" class="page-icon">
            <h1 class="h1 page-title"><?= $this->title?></h1>
            <h5 class="h5 page-sub-title"><span><i class="i-holder prev"></i><?= Yii::t('app', 'Самый большой выбор металлопроката')?><i class="i-holder next"></i></span></h5>
        </div>
    </div>
</div>

<?= $this->render('@app/views/layouts/inc/breadcrumbs'); ?>

<div class="container page-name-block margin-top-0 margin-bottom-0">
    <h2 class="h2"><?= Yii::t('app', 'Пресс-центр')?></h2>
</div>

<div class="container-fluid news-presscenter-preview-block margin-top-0 margin-bottom-0">
    <div class="container">
        <h2 class="h2"><?= Yii::t('app', 'Новости')?></h2>
        <div class="col-lg-6 large-news-preview">
            <?= Html::a(
                Html::img("/".$news['first']->getImageUrl(Yii::$app->params['imagePresets']['news']['oneNewsBig'],
                \app\models\News::tableName()), ['alt' => $news['first']->image_alt, 'title' => $news['first']->image_title, 'class' => 'img-responsive']),
                \yii\helpers\Url::to(["/$city/presscenter/news/{$news['first']->alias}"])
            );?>
            <?= Html::a(\yii\helpers\StringHelper::truncate($news['first']->title, 50), \yii\helpers\Url::to(["/presscenter/news/{$news['first']->alias}"]), ['class' => 'preview-title']);?>
            <span class="preview-date"><?= Yii::$app->formatter->asDate($news['first']->date_show)?></span>
            <p class="preview-text">
                <?= \yii\helpers\StringHelper::truncate(strip_tags($news['first']->description), 200);?>
                <?= Html::a(Yii::t('app', 'Подробнее') . '<i class="i-holder read-more-i"></i>', \yii\helpers\Url::to(["/presscenter/news/{$news['first']->alias}"]), ['class' => 'read-more']);?>
            </p>
        </div>

        <div class="col-lg-6 news-preview">
            <?php foreach ($news['other'] as $item):?>
                <div class="news-item">
                    <?= Html::a(Html::img('/'.$item->getImageUrl(Yii::$app->params['imagePresets']['news']['small'],
                        \app\models\News::tableName()), ['alt' => $item->image_alt, 'title' => $item->image_title, 'class' => 'news-preview-img']), \yii\helpers\Url::to(["/$city/presscenter/news/{$item->alias}"])); ?>
                    <?= Html::a(\yii\helpers\StringHelper::truncate($item->title, 50), \yii\helpers\Url::to(["/$city/presscenter/news/{$item->alias}"]), ['class' => 'preview-title']);?>
                    <span class="preview-date"><?= Yii::$app->formatter->asDate($item->date_show)?></span>
                    <p class="preview-text"><?= \yii\helpers\StringHelper::truncate(strip_tags($item->description), 100);?></p>
                </div>
            <?php endforeach;?>
        </div>
        <div class="col-lg-12 preview-show-more-wrapper">
            <div class="row">
                <a href="<?= \yii\helpers\Url::to(["/$city/presscenter/news"])?>" class="preview-show-more-lg"><?= Yii::t('app', 'Смотреть все Новости')?><i
                class="i-holder read-more-i"></i></a>
            </div>
        </div>
    </div>
</div>

<?php if($sales):?>
    <div class="container special-offer-car-block">
        <h2 class="h2 stripped-title"><span><?= Yii::t('app', 'Специальные предложения')?></span></h2>
        <div class="special-offer-carousel" >
            <?php foreach ($sales as $sale) :?>
                <div class="item col-xs-2">
                    <?php $root = \app\models\ProductsCategories::getRootCategory($sale->id); ?>
                    <a href="<?= \yii\helpers\Url::to(["/$city/sales/{$root->alias}/{$sale->alias}"])?>">                         
                        <?php $imageSale = '/' . $sale->getImageUrl(Yii::$app->params['imagePresets']['categories']['sub'], \app\models\ProductsCategories::tableName(), 'image'); ?>
                        <?= \kartik\helpers\Html::img($imageSale, ['class' => "img", 'alt' => $sale->image_alt, 'title' => $sale->image_title]); ?>
                        <span class="title"><?= $sale->title?></span>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif;?>

<!--<div class="container-fluid banner-large-block margin-top-0 margin-bottom-0">-->
<!--    <img src="/img/banner-big.jpg">-->
<!--</div>-->

<?php if($articles):?>
    <div class="container articles-block" id="articles-block">
        <h2 class="h2 stripped-title"><span><?= Yii::t('app', 'Статьи')?></span></h2>
        <div class="row ">
            <div class="col-lg-8">
                <div class="article-list">
                    <?php foreach ($articles as $article):?>
                        <div class="article-item">
                            <h3 class="h3"><?= \yii\helpers\StringHelper::truncate($article->title, 50);?></h3>
                            <?= Html::a(Html::img('/'.$article->getImageUrl(Yii::$app->params['imagePresets']['articles']['smallArticle'],
                                \app\models\Articles::tableName()), ['alt' => $article->image_alt, 'title' => $article->image_title]), \yii\helpers\Url::to(["/$city/presscenter/articles/{$article->alias}"]))?>
                            <span class="preview-date"><?= Yii::$app->formatter->asDate($article->date_show)?></span>
                            <p class="preview-text">
                                <?= \yii\helpers\StringHelper::truncate(strip_tags($article->description), 350);?>
                                <a href="<?= \yii\helpers\Url::to(["/$city/presscenter/articles/{$article->alias}"])?>" class="read-more"><?= Yii::t('app', 'Подробнее')?><i class="i-holder read-more-i"></i></a>
                            </p>
                        </div>
                    <?php endforeach;?>
                    <a href="<?= \yii\helpers\Url::to(["/presscenter/articles"]) ?>" class="preview-show-more-lg"><?= Yii::t('app', 'Читать все статьи')?><i class="i-holder read-more-i"></i></a>
                </div>
            </div>
            <?= $this->render('@app/views/site/inc/news-subscribe', ['model' => $modelSubscribe])?>
        </div>
    </div>
<?php endif;?>
<?php if($blockSettings->presscenter_price && $blockSettings->presscenter_price_image):?>
<?php endif;?>
<div class="container banner-small-block">
    <?= Html::a(Html::img(\app\models\BlockSettings::getBlockSettingsImage($blockSettings->presscenter_price_image, 1140, 160),
        ['alt' => $blockSettings->presscenter_price_image_alt,
            'title' => $blockSettings->presscenter_price_image_title
        ]), \app\models\BlockSettings::getUploadedFilePath($blockSettings->presscenter_price), ['target'=>'_blank']);?>
</div>

<?= $this->render('@app/views/layouts/inc/contact', ['model' => $modelContact])?>
<?= $this->render('@app/views/layouts/inc/popup_contact')?>