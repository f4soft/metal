<?php
use kartik\helpers\Html;
$this->title = Yii::t('app', 'Новости');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Пресс-центр'), 'url' => '/presscenter'];
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
    <h2 class="h2"><?= $this->title?></h2>
</div>

<div class="container-fluid news-preview-block margin-top-0">
    <div class="container">
        <div class="col-lg-12 news-preview">
            <?php \yii\widgets\Pjax::begin([
                'enablePushState' => true,
                'enableReplaceState' => false,
            ])?>
            <?= \yii\widgets\ListView::widget([
                'dataProvider' => $news,
                'layout' => "{items}<div class='col-lg-12 pagination-wrapper'><nav aria-label='Page navigation'>{pager}</nav></div>",
                'summary' => '',
                'itemView' => function($model, $key, $index, $widget){
                    $imageModel = new \app\models\ImageUpload(\app\models\News::tableName());
                    $image = $imageModel->getImage($model, Yii::$app->params['imagePresets']['news']['small'], 'view', 'image');
                    $city = isset(Yii::$app->request->get()['city']) ? Yii::$app->request->get()['city'] : '';
                    return $this->render("_post", ['model'=>$model, 'image' => $image, 'city' => $city]);
                },
                'pager' => [
                    'activePageCssClass' => 'current',
                ]
            ]);?>
            <?php \yii\widgets\Pjax::end();?>
        </div>
        <div class="col-lg-12 subscribe-to-news-wrapper">
            <div class="row">
                <?= $this->render('inc/_news_subscribe', ['model' => $model])?>
            </div>
        </div>
        <?= $this->render('inc/popup')?>
    </div>
</div>

<?php if($sales):?>
    <div class="container special-offer-block double-banners-block">
        <h2 class="h2 stripped-title"><span><?= Yii::t('app', 'Специальные предложения')?></span></h2>
        <div class="row">
            <?php foreach ($sales as $sale):?>
                <div class="col-lg-6">
                    <?= Html::a(Html::img('/'.$sale->getImageUrl(Yii::$app->params['imagePresets']['sales']['small'],
                            \app\models\Sales::tableName()),['alt' => $sale->image_alt, 'title' => $sale->image_title]),
                        \yii\helpers\Url::to(["/$selectedCity/sales/{$sale->alias}"]))?>
                </div>
            <?php endforeach;?>
        </div>
    </div>
<?php endif;?>

<!--<div class="container-fluid banner-large-block margin-top-0 margin-bottom-0">-->
<!--    <img src="/img/banner-big.jpg">-->
<!--</div>-->

<?= $this->render('@app/views/catalog/inc/catalog-block', ['selectedCity' => $selectedCity, 'blockSettings' => $blockSettings]);?>

<?= $this->render('@app/views/layouts/inc/contact', ['model' => $modelContact])?>
<?= $this->render('@app/views/layouts/inc/popup_contact')?>