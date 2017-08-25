<?php
$title = Yii::t('app','Дилерам');
$this->params['breadcrumbs'][] = ['label' => $title, 'template' => "<li class='breadcrumbs-i' itemtype = 'http://schema.org/ListItem'>
            <span class='breadcrumbs-title' itemprop = 'name'>{link}</span>
            </li>"];
?>
<div class="container-fluid page-title-block margin-top-0 margin-bottom-0">
    <div class="thumb" style="background: url('<?= $head_img->getImageBg(); ?>') no-repeat center center"></div>
    <div class="container-fluid page-title-content">
        <div class="container">
            <img src="<?= $head_img->getImageCircle(); ?>" alt="" title="" class="page-icon">
            <h1 class="h1 page-title"><?= Yii::t('app', 'Дилерам') ?></h1>
            <h5 class="h5 page-sub-title"><span><i
                            class="i-holder prev"></i><?= Yii::t('app', 'Самый большой выбор металлопроката') ?><i
                            class="i-holder next"></i></span></h5>
        </div>
    </div>
</div>
<?= $this->render('@app/views/layouts/inc/breadcrumbs'); ?>

<div class="container page-name-block margin-top-0 margin-bottom-0">
    <h2 class="h2"><?= $dealersSettings->dealers_title?></h2>
</div>

<div class="container-fluid current-dillers-block margin-top-0">
    <div class="container-fluid news-body-block row">
        <?= $dealersSettings->dealers_page_description ?>
    </div>
</div>