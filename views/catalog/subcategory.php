<?php
use kartik\helpers\Html;
use app\components\Calculator;
$title = $subcategory->title;
/*$this->registerMetaTag([
    'name' => 'description',
    'content' => $subcategory->meta_description,
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $subcategory->meta_keywords,
]);*/
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Каталог продукции'), 'url' => '/catalog'];
$this->params['breadcrumbs'][] = ['label' => $category->title, 'url' => '/catalog/'. $category->alias];
$this->params['breadcrumbs'][] = ['label' => $subcategory->title, 'template' => "<li class='breadcrumbs-i' itemtype = 'http://schema.org/ListItem'>
            <span class='breadcrumbs-title' itemprop = 'name'>{link}</span>
            </li>"];
$user_id = false;
$image = '/' . $subcategory->getImageUrl(Yii::$app->params['imagePresets']['categories']['page'], \app\models\ProductsCategories::tableName(), 'image');
//$image = '/' . $subcategory->getImageUrl(false, \app\models\ProductsCategories::tableName(), 'image');
?>
<div class="container-fluid page-title-block margin-top-0 margin-bottom-0">
    <div class="thumb" style="background: url('<?= $head_img->getImageBg(); ?>') no-repeat center center"></div>
    <div class="container-fluid page-title-content">
        <div class="container">
            <span class="image page-icon"
                  style="background: url('<?= $image; ?>') no-repeat center center"></span>
            <h1 class="h1 page-title"><?= $title?></h1>
            <?php if($subcategory->page_description):?>
                <div class="page-sub-description"><span><?= $subcategory->page_description ?></span></div>
            <?php else:?>
                <h5 class="h5 page-sub-title"><span><i class="i-holder prev"></i><?= Yii::t('app', 'Самый большой выбор металлопроката')?><i class="i-holder next"></i></span></h5>
            <?php endif;?>
        </div>
    </div>
</div>

    <?php if($subcategoryLink):?>
        <div class="container subcategory-link-block margin-bottom-0">
            <div class="link-block">
                <?php $linkNumBlock = 4; $linkCount = count($subcategoryLink);  ?>
                <?php foreach($subcategoryLink as $link): $linkNumBlock-- ; $linkCount-- ;
                    $linkCategory = $link->productCategory; ?>
                    <?= Html::a($linkCategory->title, ['/catalog' . $linkCategory->getFullAlias()], ['target' => '_blank']); ?>
                <?php endforeach;?>      
            </div>
            <div class="line-block">
                <div class="line-border"></div>
            </div>
        </div>
    <?php endif;?>

<?= $this->render('@app/views/layouts/inc/breadcrumbs'); ?>

<?php if ($category->id !=91 ): /*if this not kovka*/?>

    <div class="container page-name-block margin-top-0 margin-bottom-0">
        <!--<span class="h2"><= $subcategory->title ?></span>-->
        <h2 class="table-sub-title"><?= $subcategory->title_price ?></h2>
    </div>    

    <div class="container product-list-by-category margin-top-0">        
        
        <!--<php \yii\bootstrap\ActiveForm::begin(); ?>
        <= \kartik\helpers\Html::dropDownList('category', $subcategory->id,
            \yii\helpers\ArrayHelper::map($allSubcategories, 'id', 'title'), ['class' => 'select-category select',
                'onchange' => 'this.form.submit()']); ?>
        <php \yii\bootstrap\ActiveForm::end(); ?>-->     
       
        <table class="table table-calc margin-top-0">
            <tbody>
            <tr>
                <th><?= Yii::t('app', 'Наименование товара') ?></th>
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
            <?php $count = 0 ?>
            <?php foreach ($products as $key => $product): ?>
                <?php if ($product->status): ?>
                    <?php $product->city_id = $city->id ?>
                    <?php if ($productAddInfo = $product->cityProducts): ?>
                        <?php $count ++; ?>
                        <tr class="product-row <?php if ($count > current(array_keys($rowShow))) {
                            echo 'hidden';
                        } ?>">
                            <?php if (Calculator::isRecalculate($product)): ?>
                                <?php
                                $options = Calculator::getOptions($product);
                                ?>
                            <?php endif; ?>

                            <td <?= $product->stock ? ' class="icon-stock-percent" ' : '' ?>>
                                <?= \kartik\helpers\Html::a($product->title, \yii\helpers\Url::to(["/{$selectedCity}/catalog/{$category->alias}/{$subcategory->alias}/{$product->alias}"])) ?>
                            </td>
                            <td><?= $product->sku ?></td>
                            <td>
                                <?= Html::input('text', 'CartProducts[units_count]', 1, ['class' => 'count']) ?>
                            </td>
                            <td>
                                <?php if (Calculator::isRecalculate($product) && ! empty($options)): ?>
                                    <?= Html::dropDownList('unit', $product->unit, $options[1], [
                                        'options' => $options[0],
                                        'class' => 'unit',
                                        'data-units' => implode(',', array_keys($options[1])),
                                        'data-unit' => $product->unit_key,
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
                            <td class="price"><?= $productAddInfo[0]->price ?></td>
                            <td>
                                <?= Html::beginForm(\yii\helpers\Url::to(['cart/add-to-cart']), 'post', ['class' => 'add-to-cart-form', 'id' => 'add_' . $product->id]); ?>
                                <?= Html::input('hidden', 'CartProducts[weight]', 0); ?>
                                <?= Html::input('hidden', 'CartProducts[count]', 1); ?>
                                <?= Html::input('hidden', 'CartProducts[user_id]', $user_id) ?>
                                <?= Html::input('hidden', 'CartProducts[product_id]', $product->id); ?>
                                <?= Html::input('hidden', 'CartProducts[unit]', $product->unit); ?>
                                <?= Html::input('hidden', 'CartProducts[price]', $product->cityProducts[0]->price); ?>
                                <?= Html::submitButton(Yii::t('app', 'Купить').($product->stock ? '<span>'.Yii::t('app', 'Акция').'</span>' : ''), ['name' => 'order', 'class' => 'add-to-cart', 'data-selector' => 'add_' . $product->id]) ?>
                                <?= Html::endForm(); ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
            </tbody>
        </table>

        <div class="col-xs-12 col-lg-offset-4 col-lg-4">
            <div class="btn-holder">
                <button class="btn show-more-items">
                    <?= Yii::t('app', 'Посмотреть другие позиции') ?> <span></span>
                </button>
            </div>
        </div>
        <div class="col-xs-12 col-lg-4 padding-right-0">
            <?php \yii\bootstrap\ActiveForm::begin(['action' => null]); ?>
            <?= \kartik\helpers\Html::dropDownList('show-row', '', $rowShow, ['class' => 'select-show-row select', 'onchange' => 'reshowRow(this)'] );?>
            <?php \yii\bootstrap\ActiveForm::end()?>
        </div>
                        
        <span class="arrow-page-up glyphicon glyphicon-arrow-up"></span>        
        
        <div class="col-xs-12 col-lg-12 padding-right-0 padding-left-0">
        <?= $this->render('@app/views/layouts/inc/contact_under_table', ['model' => $modelContact])?>
        </div>    
        <?= $this->render('@app/views/layouts/inc/popup_contact')?>
        
    </div>
<?php else: ?>
    <?= $this->render('@app/views/catalog/inc/kovka',['subcategory'=>$subcategory, 'selectedCity'=> $selectedCity,
        'category'=> $category, 'products'=>$products, 'city'=>$city])
    ; ?>
<?php endif;?>

<div class="container double-download-block">
    <?php if ($files['fileCatalog'] && $files['fileImage']) : ?>
        <div class="col-lg-6 img-holder">
            <a href="<?= $files['fileCatalog'] ?>">
                <img width="570px" height="80px" src="<?= $files['fileImage'] ?>" alt="">
            </a>
        </div>
    <?php endif; ?>
    <?php if ($files['filePrice'] && $files['priceImage']) :?>
        <div class="col-lg-6 img-holder">
            <a href="<?= $files['filePrice'] ?>">
                <img width="570px" height="80px" src="<?= $files['priceImage'] ?>" alt="">
            </a>
        </div>
    <?php endif;?>
</div>

<!--<div class="container-fluid banner-large-block margin-top-0 margin-bottom-0">-->
<!--    <img src="/img/banner-big.jpg">-->
<!--</div>-->

<?php if($services):?>
    <div class="container-fluid our-services-block margin-top-0 margin-bottom-0">
        <div class="container">
            <span class="h2"><?= Yii::t('app', 'Наши услуги')?></span>
            <?php foreach ($services as $key => $service):?>
                <?php $image = '/' . $service->getImageUrl(Yii::$app->params['imagePresets']['services-small']['main'], \app\models\Services::tableName(), 'small_image');?>
                <div class="service-item item<?=$service->id?> active">
                    <a href="<?= \yii\helpers\Url::to(["/{$selectedCity}/services#service{$service->id}"])?>">
                            <span class="icon">
                                <?= \kartik\helpers\Html::img($image, ['alt' => $service->small_image_alt, 'title' => $service->small_image_title]);?>
                            </span>
                        <span class="text"><span class="inner-text"><?= $service->title?></span></span>
                    </a>
                </div>
            <?php endforeach;?>
        </div>
    </div>
<?php endif;?>

<?php if($selectedCity == ''):?>
    <?php if($subcategory->article_description && $subcategory->article_title):?>
        <div class="container seo-text-block">
            <div class="seo-content">
                <h2 class="h2"><?= $subcategory->article_title?></h2>
                <div class="text">                
                    <?= $subcategory->article_description ?>
                </div>
                <a href="" class="show-more"><?= Yii::t('app', 'Читать подробнее')?></a>
            </div>
        </div>
    <?php endif;?>
<?php else :?>
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

<?php $this->registerJsFile("@web/js/show_row.js",['depends' => [\yii\web\JqueryAsset::className()]]); ?>