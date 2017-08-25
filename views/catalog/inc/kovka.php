
<div class="container-fluid catalog-categories-block margin-top-0">
    <div class="container">
        <div class="row">
            <span class="h2"><?= $subcategory->title ?></span>
            <ul class="subcats-list kovka">
                <?php foreach ($products as $key => $product): ?>
                    <?php if ($product->status): ?>
                        <?php $product->city_id = $city->id ?>
                        <?php if ($productAddInfo = $product->cityProducts): ?>
                            <li class="col-lg-4 col-md-4 col-sm-6">
                                <a class="item" href="<?= \yii\helpers\Url::
                                to(["/{$selectedCity}/catalog/{$category->alias}/{$subcategory->alias}/{$product->alias}"]) ?>">
                                    <?php $image = $product->getImageUrl(Yii::$app->params['imagePresets']['categories']['sub'],
                                        \app\models\Products::tableName(), 'image'); ?>
                                    <span class="img-holder">
                                    <?php if (strpos($image, '.') !== false): ?>
                                        <?= \kartik\helpers\Html::img('/' . $image, ['class' => "img",
                                            'alt' => $product->image_alt, 'title' => $product->image_title]); ?>
                                    <?php else: ?>
                                        <img src="https://placehold.it/236" alt="" class="img">
                                    <?php endif; ?>
                                    </span>
                                    <span class="title">
                                        <span class="kovka-subtitle"><?= $product->sku ?></span><br>
                                        <span class="kovka-title">
                                            <?= str_replace('\n', ' ', $productAddInfo[0]->description)?>
                                        </span>
                                        <span class="kovka-price"><?= $productAddInfo[0]->price ?>
                                            <?= Yii::t('app', 'грн')?></span>
                                    </span>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>