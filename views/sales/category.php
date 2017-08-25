<?php
use kartik\helpers\Html;

$title = $category->title;
/*$this->registerMetaTag([
    'name' => 'description',
    'content' => $category->meta_description,
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $category->meta_keywords,
]);*/
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Специальные предложения'), 'url' =>'/sales'];
$this->params['breadcrumbs'][] = ['label' => $title, 'template' => "<li class='breadcrumbs-i' itemtype = 'http://schema.org/ListItem'>
            <span class='breadcrumbs-title' itemprop = 'name'>{link}</span>
            </li>"];
//$categoryImg = $category ->getImageUrl(null, \app\models\ProductsCategories::tableName(), 'image');
?>
<div class="container-fluid page-title-block margin-top-0 margin-bottom-0">
    <div class="thumb" style="background: url('<?= $head_img->getImageBg(); ?>') no-repeat center center"></div>
    <div class="container-fluid page-title-content">
        <div class="container">
            <?php if ($head_img->getImageCircle()):?>
<!--                <img height="160px" width="160px" src="" alt="" title="" class="page-icon">-->
                <span class="image page-icon"
                      style="background: url('<?= $head_img->getImageCircle(); ?>') no-repeat center center"></span>
            <?php else: ?>
            <img src="/img/katalog_krug.png" alt="" title="" class="page-icon">
            <?php endif;?>
            <h1 class="h1 page-title"><?= Yii::t('app', 'Специальные предложения')?></h1>
            <h5 class="h5 page-sub-title"><span><i class="i-holder prev"></i><?= Yii::t('app', 'Самый большой выбор металлопроката')?><i class="i-holder next"></i></span></h5>
        </div>
    </div>
</div>


<?= $this->render('@app/views/layouts/inc/breadcrumbs'); ?>

<div class="container page-name-block margin-top-0 margin-bottom-0">
    <span class="h2"><?= $title?></span>
</div>

<div class="container-fluid catalog-categories-block margin-top-0">
    <div class="container">
        <div class="row">
            <ul class="subcats-list">
                <?php foreach (\app\models\ProductsCategories::getCategoriesSaleChildren($category) as $itemChild):?>
                    <?php $image = '/' . $itemChild->getImageUrl(Yii::$app->params['imagePresets']['categories']['sub'], \app\models\ProductsCategories::tableName(), 'image');?>
                    <li class="col-lg-4 col-md-4 col-sm-6">
                        <a href="<?= \yii\helpers\Url::to(["/{$selectedCity}/sales/{$category->alias}/{$itemChild->alias}"])?>" class="item">
                            <span class="img-holder">
                                <?php if(strpos($image, '.') !== false):?>
                                    <?= \kartik\helpers\Html::img($image,
                                        ['alt' => $itemChild->image_alt, 'title' => $itemChild->image_title, 'class' => 'img'])?>
                                <?php else:?>
                                    <img src="https://placehold.it/236" alt="" class="img">
                                <?php endif;?>
                            </span>
                            <span class="title"><?= $itemChild->title?></span>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
</div>

<!--
<php if ($files['filePrice']&& $files['priceImage']): ?>
    <div class="container banner-small-block">
        <a href="//<= $files['filePrice'] ?>">
            <img src="//<= $files['priceImage'] ?>" alt="">
        </a>
    </div>
<php endif; ?>
-->
<!--
<php if($category->article_description && $category->article_title):?>
<div class="container seo-text-block">
    <div class="seo-content">
        <h2 class="h2"><= $category->article_title?></h2>

        <div class="text">
            <= $category->article_description?>
        </div>
        <a href="" class="show-more"><= Yii::t('app', 'Читать подробнее')?></a>

    </div>
</div>
<php endif;?>
-->
<?= $this->render('@app/views/layouts/inc/contact', ['model' => $modelContact])?>
<?= $this->render('@app/views/layouts/inc/popup_contact')?>

