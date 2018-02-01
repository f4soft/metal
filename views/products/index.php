<?php
use kartik\helpers\Html;
use app\models\ProductsCategories;
use app\components\Calculator;
$title = $product->title;
/*$this->registerMetaTag([
    'name' => 'description',
    'content' => $product->meta_description,
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $product->meta_keywords,
]);*/
$parent = ProductsCategories::getRootCategory($product->category_id);
$category = ProductsCategories::findOne(['id' => $product->category_id]);

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Каталог продукции'), 'url' => '/catalog'];
$this->params['breadcrumbs'][] = ['label' => $parent->title, 'url' => '/catalog/' . $parent->alias];
$this->params['breadcrumbs'][] = ['label' => $category->title, 'url' => '/catalog/'.$parent->alias.'/'. $category->alias];
$this->params['breadcrumbs'][] = ['label' => $product->title, 'template' => "<li class='breadcrumbs-i' itemtype = 'http://schema.org/ListItem'>
            <span class='breadcrumbs-title' itemprop = 'name'>{link}</span>
            </li>"];
$user_id = false;
$image = '/' . $category->getImageUrl(false, \app\models\ProductsCategories::tableName(), 'image')
?>
    <div class="container-fluid page-title-block margin-top-0 margin-bottom-0">
        <div class="thumb" style="background: url('/img/big_images/vacancies.png') no-repeat center center"></div>
        <div class="container-fluid page-title-content">
            <div class="container">
                <span class="image page-icon"
                      style="background: url('<?= $image ?>') no-repeat center center"></span>
                <h1 class="h1 page-title"><?= $title?></h1>
                <h5 class="h5 page-sub-title"><span><i class="i-holder prev"></i><?= Yii::t('app', 'Самый большой выбор металлопроката')?><i class="i-holder next"></i></span></h5>
            </div>
        </div>
    </div>

<?= $this->render('@app/views/layouts/inc/breadcrumbs'); ?>



<div class="container page-name-block margin-top-0 margin-bottom-0">
    <div class="col-lg-9 col-md-9">
        <span class="h2"><?= $product->title?></span>
    </div>
    <div class="col-lg-3 col-md-3 padding-left-0 padding-right-0">
        <?= Html::submitButton(Yii::t('app', 'Оформить заказ').($product->stock ? '<span>'.Yii::t('app', 'Акция').'</span>' : ''), ['name' => 'order', 'class' => 'add-to-cart'])?>
    </div>
</div>

<div class="container product-card-block margin-top-0 margin-bottom-0">
    
    <div class="col-lg-9 col-md-9 product-description-block">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 prod-image">
                <?php if ($parent->alias != 'kovanye-izdelia'): ?>
                    <?php $image =  $category->getImageUrl(Yii::$app->params['imagePresets']['categories']['product'], \app\models\ProductsCategories::tableName(), 'image'); ?>
                <?php else: ?>
                    <?php $image = $product->getImageUrl(Yii::$app->params['imagePresets']['products']['main'], \app\models\Products::tableName(), 'image'); ?>
                <?php endif; ?>
                <?php if($image): ?>
                <?= Html::img('/' .$image, ['class' => "prod-image img", 'alt' => $product->image_alt, 'title' => $product->image_title]); ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 text-description">
                <span class="h3"><?= Yii::t('app', 'Технические характеристики товара')?></span>
                <?php $product->city_id = $city->id?>
                <?= str_replace('\n', '<br>', $product->cityProducts[0]->description)?>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 table-description">
                <?= Html::beginForm(\yii\helpers\Url::to(['cart/add-to-cart']), 'post', ['class' => 'add-to-cart-form']);?>
                    <table class="table table-calc">
                        <tbody>
                        <tr>
                            <th><?= Yii::t('app', 'Артикул') ?></th>
                            <th><?= Yii::t('app', 'Кол-во') ?></th>
                            <th><?= Yii::t('app', 'Ед.') ?></th>
                            <th><?= Yii::t('app', 'кг') ?></th>
                            <th><?= Yii::t('app', 'шт') ?></th>
                            <th><?= Yii::t('app', 'п.м/кв.м') ?></th>
                            <th><?= Yii::t('app', 'м2') ?></th>
                            <th><?= Yii::t('app', 'лист') ?></th>
                            <th colspan="2">
                                <?= Yii::t('app', 'Розничная<br>стоимость') ?>
                            </th>
                        </tr>
                        <?php $productAddInfo = $product->cityProducts; ?>
                        <?php if ($productAddInfo): ?>
                        <tr class="product-row">
                            <?php if (Calculator::isRecalculate($product)): ?>
                            <?php $options = Calculator::getOptions($product);?>
                            <?php endif; ?>
                            <td><?= $product->sku?></td>
                            <td><?= Html::input('text', 'CartProducts[count]', 1, ['class' => 'count']);?></td>
                            <td>
                                <?php if (Calculator::isRecalculate($product) && !empty($options)): ?>
                                    <?= Html::dropDownList('unit', $product->unit, $options[1], [
                                        'options' => $options[0],
                                        'class' => 'unit',
                                        'data-units' => implode(',', array_keys($options[1])),
                                        'data-unit' => $product->unit_key,
                                        //'data-coefficient' => $product->cityProducts[0]->coefficient,
                                    ]) ?>
                                <?php else: ?>
                                    <span class="unit" data-price="<?= $productAddInfo[0]->price ?>"
                                          data-unit="<?= $product->unit_key ?>">
                                    <?= Yii::t('app', $product->unit) ?>
                                </span>
                                <?php endif; ?>
                            </td>
                            <td class="kg"></td>
                            <td class="sht"></td>
                            <td class="m"></td>
                            <td class="m2"></td>
                            <td class="list"></td>
                            <td class="price"><?= $product->cityProducts[0]->price?></td>
                        </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    <?= Html::input('hidden', 'CartProducts[user_id]', $user_id)?>
                    <?= Html::input('hidden', 'CartProducts[weight]', 0)?>
                    <?= Html::input('hidden', 'CartProducts[product_id]', $product->id);?>
                    <?= Html::input('hidden', 'CartProducts[unit]', $product->unit);?>
                    <?= Html::input('hidden', 'CartProducts[price]', $product->cityProducts[0]->price);?>                    
                <?= Html::endForm();?>
            </div> 
            
        </div>
    </div>
    <div class="col-lg-3 col-md-3 vertical-services-block">
        <div class="row">                                    
            <span class="h3"><?= Yii::t('app', 'Дополнительные услуги')?></span>
            <div class="service-item item1">
                <span class="icon"><i class="i-holder"></i></span>
                <span class="text"><span class="inner-text"><?= Yii::t('app', 'Доставка продукции')?></span></span>
            </div>
            <div class="service-item item2">
                <span class="icon"><i class="i-holder"></i></span>
                <span class="text"><span class="inner-text"><?= Yii::t('app', 'Порезка металла') ?></span></span>
            </div>
            <div class="service-item item3" >
                <span class="icon"><i class="i-holder"></i></span>
                <span class="text"><span class="inner-text"><?= Yii::t('app', 'Механическая<br>обработка металла')?></span></span>
            </div>
            <div class="service-item item5">
                <span class="icon"><i class="i-holder"></i></span>
                <span class="text"><span class="inner-text"><?= Yii::t('app', 'Комплектация<br>и упаковка')?></span></span>
            </div>
        </div>
        </div>
    </div>
    
    
    
</div>
<?php if($relatedCategories): ?>
<div class="container-fluid related-products-block">
    <div class="container">
        <span class="h2"><?= Yii::t('app', 'Сопуствующая продукция')?></span>
        <div class="related-product-carousel" >
            <?php foreach ($relatedCategories as $item):?>
                <?php
                    $root = \app\models\ProductsCategories::getRootCategory($item->id);
                ?>
                <div class="item">
                    <a href="<?= \yii\helpers\Url::to(["/$selectedCity/catalog/{$root->alias}/{$item->alias}"])?>">
                        <?php $image = '/' . $item->getImageUrl(Yii::$app->params['imagePresets']['categories']['related'], \app\models\ProductsCategories::tableName(), 'image');?>
                        <?= Html::img($image, ['class' => "img", 'alt' => $item->image_alt, 'title' => $item->image_title]);?>
                        <span class="title"><?= $item->title?></span>
                    </a>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
<?php endif;?>

<?php if($popularProducts = \app\models\Products::getPopular($product->category_id)):?>
    <div class="container popular-products-block">
        <span class="h2 stripped-title"><span><?= Yii::t('app', 'Популярная продукция')?></span></span>
        <div class="popular-product-carousel" >
            <?php foreach ($popularProducts as $item) :?>
            <div class="item col-xs-2">
                <?php $url = \app\models\Products::getUrl($item);?>
                <a href="<?= \yii\helpers\Url::to(["/{$selectedCity}/{$url}"])?>">
                    <?php $root = \app\models\ProductsCategories::getRootCategory($item->category_id); ?>
                    <?php if ($root->alias != 'kovanye-izdelia'):?>
                        <?php $catTemp = \app\models\ProductsCategories::findOne(['id' => $item->category_id]) ?>
                        <?php $image = '/' . $catTemp->getImageUrl(Yii::$app->params['imagePresets']['products']['popular'], \app\models\ProductsCategories::tableName(), 'image'); ?>
                    <?php else: ?>
                        <?php $image = '/' . $item->getImageUrl(Yii::$app->params['imagePresets']['products']['popular'], \app\models\Products::tableName(), 'image'); ?>
                    <?php endif; ?>
                    <?= Html::img($image, ['class' => "img", 'alt' => $item->image_alt, 'title' => $item->image_title]);?>
                    <span class="title"><?= $item->title?></span>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif;?>

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

<?php if($selectedCity == ''):?>
    <?php if($product->article_description && $product->article_title):?>
        <div class="container seo-text-block">
            <div class="seo-content">
                <h2 class="h2"><?= $product->article_title?></h2>

                <div class="text">
                    <?= $product->article_description?>
                    <?php if($city->product_description):?>
                        <p><?= $city->product_description ?></p>
                    <?php endif;?>
                </div>
                <a href="" class="show-more"><?= Yii::t('app', 'Читать подробнее')?></a>

            </div>
        </div>
    <?php endif;?>
<?php else:?>
    <?php if($seoTags && $seoTags->article_description && $seoTags->article_title):?>
        <div class="container seo-text-block">
            <div class="seo-content">
                <h2 class="h2"><?= $seoTags->article_title?></h2>
                <div class="text">                
                    <?= $seoTags->article_description ?>
                </div>
                <a href="" class="show-more"><?= Yii::t('app', 'Читать подробнее')?></a>
            </div>
        </div>
    <?php endif;?>
<?php endif;?>

<?= $this->render('@app/views/layouts/inc/contact', ['model' => $modelContact])?>
<?= $this->render('@app/views/layouts/inc/popup_contact')?>

<?= $this->render('@app/views/products/popup_success');?>
