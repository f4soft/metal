<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app/admin', 'Обновить'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Отмена', '/admin/orders', ['class' => 'btn btn-default', 'role' => 'button']);?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
