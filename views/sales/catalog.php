<?php
    use kartik\helpers\Html;

    $title = Yii::t('app', 'Специальные предложения');
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
            <?php foreach ($rootCategories as $rootCategory):?>
                <div class="cat-top5-col">
                    <div class="cat-title">
                        <h4 class="h4"><span><?= $rootCategory->title?></span></h4>
                        <?php $image = '/' . $rootCategory->getImageUrl(Yii::$app->params['imagePresets']['categories']['main'], \app\models\ProductsCategories::tableName(), 'image');?>
                        <a href="<?= \yii\helpers\Url::to(["/{$selectedCity}/sales/{$rootCategory->alias}"]) ?>">
                            <?= \yii\helpers\Html::img($image, ['alt' => $rootCategory->image_alt, 'title' =>
                            $rootCategory->image_title, 'class' => 'img']);?></a>
                    </div>
                    <div class="top5-list">
                        <?php $countChild = 0; ?>
                        <?php foreach (\app\models\ProductsCategories::getCategoriesSaleChildren($rootCategory, 5) as $child): ?>
                            <?php $image = '/' . $child->getImageUrl(Yii::$app->params['imagePresets']['categories']['small'], \app\models\ProductsCategories::tableName(), 'image');?>
                            <?= Html::a("<span class=\"img-holder\">" . Html::img($image, ['class' => 'img', 'alt'=> $child->image_alt, 'title' => $child->image_title ]) . "</span><span class=\"title\">{$child->title}</span>",
                                \yii\helpers\Url::to(["/{$selectedCity}/sales/{$rootCategory->alias}/{$child->alias}"]), ['class' => 'item']); ?>
                            <?php $countChild ++;?>
                        <?php endforeach; ?>
                    </div>
                    <?php if($countChild > 4):?>
                        <a href="<?= \yii\helpers\Url::to(["/{$selectedCity}/sales/{$rootCategory->alias}"])?>" class="view-all"><?= Yii::t('app', 'Смотреть всё')?></a>
                    <?php endif;?>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>

<!-- <= $this->render('@app/views/catalog/inc/seo-text', ['blockSettings' => $blockSettings]); ?>-->

<?= $this->render('@app/views/layouts/inc/contact', ['model' => $modelContact])?>
<?= $this->render('@app/views/layouts/inc/popup_contact')?>

