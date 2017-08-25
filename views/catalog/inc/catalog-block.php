<div class="container catalog-grid-block">
    <div class="row">
        <h2 class="h2 stripped-title"><span><?= Yii::t('app', 'каталог продукции')?></span></h2>
        <?php foreach (\app\models\ProductsCategories::getCategoriesRoots() as $category):?>
            <?php $image = '/' . $category->getImageUrl(Yii::$app->params['imagePresets']['categories']['catalog'], \app\models\ProductsCategories::tableName(), 'image');?>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="img">
                    <a href="<?= \yii\helpers\Url::to(["{$selectedCity}/catalog/{$category->alias}"])?>">
                        <?= \kartik\helpers\Html::img($image, ['alt' => $category->image_alt, 'title' =>
                            $category->image_title]) ?>
                    </a>
                </div>
                <div class="cat-title">
                    <span><?= $category->title?></span>
                </div>
                <div class="show-more">
                    <?= \kartik\helpers\Html::a(Yii::t('app', 'Смотреть продукцию'), \yii\helpers\Url::to(["{$selectedCity}/catalog/{$category->alias}"]))?>
                </div>
            </div>
        <?php endforeach;?>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="special-offer">
                <a href="<?= \yii\helpers\Url::to(["/$selectedCity/sales"])?>">
                    <?= \kartik\helpers\Html::img(\app\models\BlockSettings::getBlockSettingsImage($blockSettings->sales_image, 360, 395),
                        ['alt' => $blockSettings->sales_image_alt,
                            'title' => $blockSettings->sales_image_title
                        ]) ?>
                    <span class="special-offer-title"><?= Yii::t('app', 'Специальные предложения и новинки') ?></span>
                    <span href="#" class="special-offer-show-more"><?= Yii::t('app', 'Смотреть все предложения') ?></span>
                    <span href="#" class="special-offer-link"></span>
                </a>
            </div>
        </div>
    </div>
</div>