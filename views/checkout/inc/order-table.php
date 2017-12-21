<?php
use app\models\Cart;
use app\components\Helper;
$unitsList = Yii::$app->params["units"]
?>
<h5 class="h5 title"><?= Yii::t('app', 'Ваш заказ') ?></h5>
<a href="" class="order-counter"><i class="i-holder"></i><span class="qty"><?= $data['count']?></span> <?= Helper::getWord($data['count'],
        [Yii::t('app', 'товар'), Yii::t('app', 'товара'), Yii::t('app', 'товаров')]) ?></a>
<div class="order-table">
    <table class="table has-custom-checkboxes">
        <tbody>
        <tr>
            <th colspan="3"><?= Yii::t('app', 'Наименование') ?></th>
            <th><?= Yii::t('app', 'Кол-во') ?></th>
            <th colspan="2"><?= Yii::t('app', 'Стоимость (грн)') ?></th>
        </tr>
        <?php foreach ($data['products'] as $product): ?>
        <tr>
            <td colspan="3"><?= $product->product->title ?></td>
            <td><?= $product->count ?>&nbsp;<?= isset($unitsList[$product->unit])? Yii::t('app/units', $unitsList[$product->unit]): Yii::t('app/units', $unitsList['sht']) ?></td>
            <td colspan="2"><?= $product->price ?> <?= Yii::t('app', 'грн') ?></td>
        </tr>
        <?php endforeach; ?>
        <tr class="delivery-option">
            <td colspan="2">
                <input type="checkbox" name="delivery-cart" id="delivery" <?= Cart::isDelivery() ? ' checked' : '' ?>>
                <label for="delivery"><?= Yii::t('app', 'Доставка') ?></label>
            </td>
            <td>
                <input type="checkbox" name="cutting-cart" id="cutting" <?= Cart::isCutting() ? ' checked' : '' ?>>
                <label for="cutting"><?= Yii::t('app', 'Порезка') ?></label>
            </td>
            <td colspan="2"></td>
        </tr>
        <tr class="delivery-info">
            <td colspan="5"><?= Yii::t('app', 'Стоимость данных услуг не входит в сумму заказа') ?></td>
        </tr>
        <tr class="summary-money">
            <td colspan="3"><?= Yii::t('app', 'Общая стоимость заказа:') ?></td>
            <td><?= $data['total-money'] ?> <?= Yii::t('app', 'грн') ?></td>
            <td colspan="2"></td>
        </tr>
        <tr class="summary-weight">
            <td colspan="3"><?= Yii::t('app', 'Общий вес заказа:') ?></td>
            <td><?=$data['total-weight']?> <?= Yii::t('app', 'кг') ?></td>
            <td colspan="2"></td>
        </tr>
        </tbody>
    </table>
</div>
<div class="link-wrapper">
    <a href="#" class="edit-order" data-toggle="modal" data-target="#cart-popup"><?= Yii::t('app', 'Редактировать заказ') ?></a>
</div>