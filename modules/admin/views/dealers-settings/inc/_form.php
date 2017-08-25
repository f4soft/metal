<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BlockSettings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="block-settings-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    $items = [
        [
            'label' => 'Русский',
            'content' => $this->render('_form_ru', [
                'form' => $form,
                'model' => $model,
            ]),
            'active' => true
        ],
        [
            'label' => 'Украинский',
            'content' => $this->render('_form_ua', [
                'form' => $form,
                'model' => $model,
            ]),
        ],
        [
            'label' => 'Английский',
            'content' => $this->render('_form_en', [
                'form' => $form,
                'model' => $model,
            ]),
        ]
    ];
    ?>

    <div class="row">
        <div class="col-xs-8">
            <?= \kartik\tabs\TabsX::widget([
                'items' => $items,
                'position' => \kartik\tabs\TabsX::POS_ABOVE,
                'encodeLabels' => false
            ])?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app/admin', 'Создать') : Yii::t('app/admin', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
