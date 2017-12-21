<div id="success-order" class="modal fade info-modal success-modal centered" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content order-success">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-logo"><img src="/img/logo.png" alt=""></h4>
            </div>
            <div class="modal-body">
                <h2 class="title"><?= Yii::t('app', 'Товар добавлен в корзину!')?></h2>
                <br />
                <a class="dialog-close" data-dismiss="modal"><?= Yii::t('app', 'Продолжить покупки')?></a>
                <a href="/checkout/" class="make-order"><?= Yii::t('app', 'Оформить заказ')?></a>
            </div>
        </div>
    </div>
</div>