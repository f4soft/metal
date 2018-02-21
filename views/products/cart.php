<?php
use kartik\helpers\Html;
use app\components\Calculator;
use app\models\Cart;
use app\models\BlockSettings;
$selectedCity = empty($selectedCity) ? 'kiev' : $selectedCity;
$city = \app\models\Cities::find()->where(['alias'=>$selectedCity])->one();
$block_settings = BlockSettings::find()->one();
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="h4 modal-title"><?= Yii::t('app', 'Корзина') ?></h4>
</div>
<div class="modal-body">
    <div class="container product-list-in-cart margin-top-0">

        <table class="table has-custom-checkboxes table-calc">
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
                <th><?= Yii::t('app', "Розничная<br>цена") ?></th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach (\app\models\CartProducts::getCartProducts() as $product): ?>
                    <?php $origProd = $product->product; ?>
                    <?php if (empty($origProd->unit_key) || empty($origProd->unit)) {
                    $origProd->unit_key = 'sht';
                    $origProd->unit = 'шт';
                    } ?>
                    <?php $unit = "units_{$origProd->unit_key}"; ?>
                    <?php $origProd->city_id = $city->id ?>
                    <?php if (Calculator::isRecalculate($origProd)): ?>
                        <?php
                        $options = Calculator::getOptions($origProd);
                        ?>
                    <?php endif; ?>
                    <?php if ($productAddInfo = $origProd->cityProducts): ?>
                        <tr class="product-row">
                            <td><?= $product->product->title ?></td>
                            <td><?= $product->product->sku ?></td>
                            <td>
                                <?= Html::input('text', 'CartProducts[units_count]', $product->count,
                                    ['class' => 'count']) ?>
                            </td>
                            <td>
                                <?php if (Calculator::isRecalculate($origProd) && !empty($options)): ?>
                                    <?= Html::dropDownList('unit', $product->unit, $options[1], [
                                        'options' => $options[0],
                                        'class' => 'unit',
                                        'data-units' => implode(',', array_keys($options[1])),
                                        'data-unit' => $origProd->unit_key,
                                    ]) ?>
                                <?php else: ?>
                                    <span class="unit" data-price="<?= $productAddInfo[0]->price ?>"
                                          data-unit="<?= $origProd->unit_key ?>">
                                    <?= Yii::t('app', $origProd->unit) ?>
                                </span>
                                <?php endif; ?>
                            </td>
                            <td class="kg"></td>
                            <td class="sht">
                            </td>
                            <td class="m">
                            </td>
                            <td class="m2">
                            </td>
                            <td class="list">
                            </td>
                            <td class="price"><?= $product->price ?></td>
                            <td>
                                <a href="#" data-id="<?= $product->id ?>" class="remove-from-cart"><?= Yii::t('app',
                                        'Удалить'); ?></a>
                            </td>
                        </tr>
                    <?php endif; ?>
            <?php endforeach; ?>
            <tr class="summary-row">
                <td>
                    <input type="checkbox" id="delivery-cart-popup" name="delivery-cart-popup"
                        <?= Cart::isDelivery()?' checked':''?>>
                    <label for="delivery-cart-popup"><?= Yii::t('app', 'Доставка')?></label>
                    <input type="checkbox" id="cutting-cart-popup" name="cutting-cart-popup"
                        <?= Cart::isCutting() ? ' checked' : '' ?>>
                    <label for="cutting-cart-popup"><?= Yii::t('app', 'Порезка')?></label>
                    <p class="cart-delivery-info"><?= Yii::t('app', 'Cтоимость данных услуг не входит в сумму заказа') ?></p>
                </td>
                <td colspan="8" class="total-cell">
                    <p class="price"><?= Yii::t('app', 'Общая сумма заказа (с НДС)') ?>:<span
                                class="price-summary">
                            <?php if(!is_array($total)):?>
                                <?= $total;?>
                            <?php endif;?>
                            <?= Yii::t('app', 'грн') ?></span></p>
                    <p class=""><?= Yii::t('app', '<b>По вопросам оптовых покупок</b> - обращайтесь к нашим менеджерам') ?></p>
                </td>
                <td colspan="2">
                    <a href="<?= \yii\helpers\Url::to(["/checkout"]).'/'?>" class="make-order"><?= Yii::t('app', 'Оформить заказ') ?></a>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="link-wrapper">
            <a href="<?= \yii\helpers\Url::to(["/{$city->alias}/catalog"]) ?>" class="back-to-catalog"><i
                        class="i-holder read-more-i"></i><?= Yii::t('app', 'Вернуться в каталог') ?></a>
        </div>
    </div>
</div>
<div class="modal-footer">    
    
    <?php $recommends = \app\models\Products::getRecommendProducts();           
    if($recommends): ?>
        <div class="container recommend-car-block">
            <h2 class="h3 stripped-title"><span><?= Yii::t('app', 'Также рекомендуєм')?></span></h2>
            <div class="recommend-carousel">
                <?php foreach ($recommends as $recommend) :?>
                <?php $recommend->city_id = $city->id; ?>
                <?php $cityRecoment = $recommend->cityProducts; ?>                    
                    <div class="item col-xs-2">
                        <?php $url = \app\models\Products::getUrl($recommend); ?>
                        <a href="<?= \yii\helpers\Url::to(["/$selectedCity/{$url}"])?>"> 
                            <?php $catTemp = \app\models\ProductsCategories::findOne($recommend->category_id); ?>                        
                            <?php $imageRecommend = '/' . $catTemp->getImageUrl(Yii::$app->params['imagePresets']['products']['recommend'], \app\models\ProductsCategories::tableName(), 'image'); ?>
                            <?= \kartik\helpers\Html::img($imageRecommend, ['class' => "img", 'alt' => $recommend->image_alt, 'title' => $recommend->image_title]); ?>
                            <div class="left">
                                <span class="title"><?= $recommend->title?></span>
                                <?php if(isset($cityRecoment[0])):?>
                                    <span class="price"><?= number_format($cityRecoment[0]->price, 2, ".", "") ." / 1".$recommend->unit ?></span>
                                <?php endif;?>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif;?>    

</div>
