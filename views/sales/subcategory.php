<?php
use kartik\helpers\Html;
use app\components\Calculator;
$title = Yii::t('app', 'Специальные предложения');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Специальные предложения'), 'url' => '/sales'];
$this->params['breadcrumbs'][] = ['label' => $category->title, 'url' => '/sales/'. $category->alias];
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

<?= $this->render('@app/views/layouts/inc/breadcrumbs'); ?>


    <div class="container page-name-block margin-top-0 margin-bottom-0">
        <!--<span class="h2"><= $subcategory->title ?></span>-->
        <h2 class="table-sub-title"><?= $subcategory->title_price ?></h2>
    </div>

    <div class="container product-list-by-category margin-top-0">
        
        <!--<php \yii\bootstrap\ActiveForm::begin(); ?>
        <= \kartik\helpers\Html::dropDownList('category', $subcategory->id,
            \yii\helpers\ArrayHelper::map($allSubcategorySale, 'id', 'title'), ['class' => 'select-category select',
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

<!--
<php if($subcategory->article_description && $subcategory->article_title):?>
    <div class="container seo-text-block">
        <div class="seo-content">
            <h2 class="h2"><= $subcategory->article_title?></h2>

            <div class="text">
                <= $subcategory->article_description ?>
            </div>
            <a href="" class="show-more"><= Yii::t('app', 'Читать подробнее')?></a>

        </div>
    </div>
<php endif;?>
-->

<?= $this->render('@app/views/layouts/inc/contact', ['model' => $modelContact])?>
<?= $this->render('@app/views/layouts/inc/popup_contact')?>

