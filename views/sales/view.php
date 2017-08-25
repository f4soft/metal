<?php
    $title = Yii::t('app', 'Спецпредложения');
//    $this->title = $model->title;
/*$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->meta_description,
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $model->meta_keywords,
]);*/
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Спецпредложения'), 'url' => '/sales'];
$this->params['breadcrumbs'][] = ['label' => $title, 'template' => "<li class='breadcrumbs-i' itemtype = 'http://schema.org/ListItem'>
            <span class='breadcrumbs-title' itemprop = 'name'>{link}</span>
            </li>"];
?>

<div class="container-fluid page-title-block margin-top-0 margin-bottom-0">
    <div class="thumb" style="background: url('<?= $head_img->getImageBg(); ?>') no-repeat center center"></div>
    <div class="container-fluid page-title-content">
        <div class="container">
            <img src="<?= $head_img->getImageCircle(); ?>" alt="" title="" class="page-icon">
            <h1 class="h1 page-title"><?= Yii::t('app', 'Спецпредложения')?></h1>
            <h5 class="h5 page-sub-title"><span><i class="i-holder prev"></i><?= Yii::t('app', 'Самый большой выбор металлопроката')?><i class="i-holder next"></i></span></h5>
        </div>
    </div>
</div>

<?= $this->render('@app/views/layouts/inc/breadcrumbs'); ?>

<div class="container page-name-block margin-top-0 margin-bottom-0">
    <h2 class="h2"><?= Yii::t('app', 'Спецпредложения')?></h2>
</div>

<div class="container-fluid current-news-block special margin-top-0">
    <div class="container controls">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 controls-holder">
            <?= \kartik\helpers\Html::a(Yii::t('app', 'Смотреть предыдущие спецпредложение'), \yii\helpers\Url::to
            (["/$city/sales/" . \app\models\Sales::getPrev($model->id)]), ['class' => 'control-btn prev'])?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 controls-holder">
            <?= \kartik\helpers\Html::a(Yii::t('app', 'Смотреть следующие спецпредложение'), \yii\helpers\Url::to(["/$city/sales/" . \app\models\Sales::getNext($model->id)]), ['class' => 'control-btn next'])?>
        </div>
    </div>

    <div class="container-fluid news-body-block row">
        <div class="container">
            <h5 class="h5 title"><?= \yii\helpers\StringHelper::truncate($model->title, 200)?></h5>
            <div class="row">
                <div class="col-lg-5 image">
                    <?= \kartik\helpers\Html::img($image, ['title' => $model->image_title, 'alt' => $model->image_alt])?>
                </div>
                <div class="col-lg-7 text">
                    <?= $model->description?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 link-holder">
        <?= \kartik\helpers\Html::a(Yii::t('app', 'Вернуться на страницу спецпредложений') . '<i class="i-holder read-more-i"></i>', \yii\helpers\Url::to(["/$city/sales"]), ['class' => 'to-news-page-link']);?>
    </div>
</div>

<?= $this->render('@app/views/layouts/inc/contact', ['model' => $modelContact])?>
<?= $this->render('@app/views/layouts/inc/popup_contact')?>