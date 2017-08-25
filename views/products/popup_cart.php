<?php
    use kartik\helpers\Html;
?>
<div id="cart-popup" class="modal fade cart-popup centered" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <?= $this->render('@app/views/products/cart', ['selectedCity' => $selectedCity, 'total' => \app\models\CartProducts::getTotal()]); ?>
        </div>
    </div>
</div>
<?= $this->render('@app/views/products/popup_success'); ?>
