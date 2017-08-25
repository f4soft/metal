<?php
$title = Yii::t('app', 'Услуги');
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
    <h2 class="h2"><?= $title?></h2>
</div>

<div class="container services-title-block margin-top-0 margin-bottom-0">
    <h4 class="h4"><?= $block_settings->services_description?></h4>
</div>


<?php if($block_settings->services_offer_description):?>
    <?= $block_settings->services_offer_description?>
<?php endif;?>

<div class="container-fluid our-services-tabs-block margin-top-0 margin-bottom-0">
    <div class="container-fluid our-services-tabs-wrapper">
        <div class="container wrapper-mask">
            <div class="mask left"></div>
            <div class="mask right"></div>
            <h2 class="h2"><?= Yii::t('app', 'Наши услуги')?></h2>
            <?php foreach ($services as $key => $service):?>
                <?php $image = '/' . $service->getImageUrl(Yii::$app->params['imagePresets']['services-small']['main'], \app\models\Services::tableName(), 'small_image');?>
                <?php if(!$key):?>
                    <div class="service-item item<?=$service->id?> active">
                        <a data-toggle="tab" href="#service<?=$service->id?>">
                            <span class="icon">
                                <?= \kartik\helpers\Html::img($image, ['alt' => $service->small_image_alt, 'title' => $service->small_image_title]);?>
                            </span>
                            <span class="text"><span class="inner-text"><?= $service->title?></span></span>
                        </a>
                    </div>
                <?php else:?>
                    <div class="service-item item<?=$key+1?>">
                        <a data-toggle="tab" href="#service<?=$key+1?>">
                            <span class="icon"><?= \kartik\helpers\Html::img($image, ['alt' => $service->small_image_alt, 'title' => $service->small_image_title]);?></span>
                            <span class="text"><span class="inner-text"><?= $service->title ?></span></span>
                        </a>
                    </div>
                <?php endif;?>

            <?php endforeach;?>
        </div>
    </div>
    <div class="container-fluid row our-services-tabs-description">
        <div class="row tab-content">
            <?php foreach ($services as $key => $service):?>
                <?php $image = $service->getImageUrl(Yii::$app->params['imagePresets']['services-big']['main'],
                    \app\models\Services::tableName(), 'big_image')?>
                <?php if(!$key):?>
                    <div id="service<?=$key+1?>" class="tab-pane fade service<?=$key+1?> in active" style="background-image: url(<?= '/' . $service->getImageUrl(Yii::$app->params['imagePresets']['services-big']['main'],
                        \app\models\Services::tableName(), 'big_image')?>);">
                        <div class="container">
                            <div class="col-lg-6">
                                <h3 class="h3 title"><?= $service->title?></h3>
                                <p class="text"><?= $service->description?></p>
                            </div>
                        </div>
                    </div>
                <?php else:?>
                    <div id="service<?=$key+1?>" class="tab-pane fade service<?=$key+1?>" style="background: url(<?= '/' . $service->getImageUrl(Yii::$app->params['imagePresets']['services-big']['main'],
                        \app\models\Services::tableName(), 'big_image')?>) no-repeat;">
                        <div class="container">
                            <div class="col-lg-6">
                                <h3 class="h3 title"><?= $service->title?></h3>
                                <p class="text"><?= $service->description ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif;?>

            <?php endforeach;?>
        </div>
    </div>
</div>

<div class="container-fluid banner-small-block">
    <img src="<?= $block_settings::getBlockSettingsImage($block_settings->services_banner, 1141, 141) ?>">
</div>
<?= $this->render('@app/views/layouts/inc/contact', ['model' => $modelContact])?>

<?= $this->render('@app/views/catalog/inc/catalog-block', ['selectedCity' => $selectedCity, 'blockSettings' => $block_settings]);?>

<!--<div class="container-fluid banner-large-block margin-top-0 margin-bottom-0">-->
<!--    <img src="/img/banner-big.jpg">-->
<!--</div>-->

<?= $this->render('@app/views/layouts/inc/popup_contact')?>
