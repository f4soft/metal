<?php
    use kartik\helpers\Html;

    $title = Yii::t('app', 'Каталог продукции');
    /*$this->title = $blockSettings->catalog_page_seo_title;
    $this->registerMetaTag([
        'name' => 'description',
        'content' => $blockSettings->catalog_page_seo_description
    ]);*/
    $this->params['breadcrumbs'][] = ['label' => $title, 'template' => "<li class='breadcrumbs-i' itemtype = 'http://schema.org/ListItem'>
            <span class='breadcrumbs-title' itemprop = 'name'>{link}</span>
            </li>"];
?>
<div class="container-fluid page-title-block margin-top-0 margin-bottom-0">
    <div class="thumb" style="background: url('<?= $head_img->getImageBg(); ?>') no-repeat center center"></div>
    <div class="container-fluid page-title-content">
        <div class="container">
            <img src="<?= $head_img->getImageCircle(); ?>" alt="" title="" class="page-icon">
            <h1 class="h1 page-title"><?= $title?></h1>
            <h5 class="h5 page-sub-title"><span><i class="i-holder prev"></i><?= Yii::t('app', 'Самый большой выбор металлопроката')?><i class="i-holder next"></i></span></h5>
        </div>
    </div>
</div>

<?= $this->render('@app/views/layouts/inc/breadcrumbs'); ?>

<div class="container page-name-block margin-top-0 margin-bottom-0">
    <span class="h2"><?= $title?></span>
</div>

<div class="container-fluid catalog-main-block margin-top-0">
    <div class="container">
        <div class="row">
            <?php foreach (\app\models\ProductsCategories::getCategoriesRoots() as $rootCategory):?>
                <div class="cat-top5-col">
                    <div class="cat-title">
                        <h4 class="h4"><span><?= $rootCategory->title?></span></h4>
                        <?php $image = '/' . $rootCategory->getImageUrl(Yii::$app->params['imagePresets']['categories']['main'], \app\models\ProductsCategories::tableName(), 'image');?>
                        <a href="<?= \yii\helpers\Url::to(["/{$selectedCity}/catalog/{$rootCategory->alias}"]) ?>">
                            <?= \yii\helpers\Html::img($image, ['alt' => $rootCategory->image_alt, 'title' =>
                            $rootCategory->image_title, 'class' => 'img']);?></a>
                    </div>
                    <div class="top5-list">
                        <?php foreach (\app\models\ProductsCategories::getCategoriesChildren($rootCategory, 5) as $child): ?>
                            <?php $image = '/' . $child->getImageUrl(Yii::$app->params['imagePresets']['categories']['small'], \app\models\ProductsCategories::tableName(), 'image');?>
                            <?= Html::a("<span class=\"img-holder\">" . Html::img($image, ['class' => 'img', 'alt'=> $child->image_alt, 'title' => $child->image_title ]) . "</span><span class=\"title\">{$child->title}</span>",
                                \yii\helpers\Url::to(["/{$selectedCity}/catalog/{$rootCategory->alias}/{$child->alias}"]), ['class' => 'item']); ?>
                        <?php endforeach; ?>
                    </div>
                    <a href="<?= \yii\helpers\Url::to(["/{$selectedCity}/catalog/{$rootCategory->alias}"])?>" class="view-all"><?= Yii::t('app', 'Смотреть всё')?></a>
                </div>
            <?php endforeach;?>
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
                    <a href="<?= \yii\helpers\Url::to(["/$selectedCity/sales/{$root->alias}/{$sale->alias}"])?>">                         
                        <?php $imageSale = '/' . $sale->getImageUrl(Yii::$app->params['imagePresets']['categories']['sub'], \app\models\ProductsCategories::tableName(), 'image'); ?>
                        <?= \kartik\helpers\Html::img($imageSale, ['class' => "img", 'alt' => $sale->image_alt, 'title' => $sale->image_title]); ?>
                        <span class="title"><?= $sale->title?></span>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif;?>

<?= $this->render('inc/seo-text', ['blockSettings' => $blockSettings]); ?>

<?= $this->render('@app/views/layouts/inc/contact', ['model' => $modelContact])?>
<?= $this->render('@app/views/layouts/inc/popup_contact')?>