<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\ProductsCategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-categories-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php $preset_100 = $model->isNewRecord ? false : $preset_100; ?>
    <?php $preset_price_100 = $model->isNewRecord ? false : $preset_price_100; ?>
    <?= $form->field($model, 'status')->checkbox() ?>

    <?= $form->field($model, 'parent_id')->dropDownList($rootCategories) ?>

    <?php if(!$model->isNewRecord):?>
        <?= Html::img("@web/$preset_100", ['width' => '100'])?>
    <?php endif;?>

    <?= $form->field($model, 'image')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => 'image/*'],

            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]);
    ?>
    <?php if($model->parent_id == 1):/*показываем только для категорий*/?>
        <?= $form->field($model, 'show_price')->checkbox() ?>
    <?php endif; ?>
    <?php if ($model->parent_id == 1): /*показываем только для категорий*/?>
        <?= $form->field($model, 'show_catalog')->checkbox() ?>
    <?php endif; ?>
    
    <?= $form->field($model, 'alias')->textInput(['value' => $model->getFullAlias(), 'disabled' => true])->label(Yii::t('app', 'Путь (alias)'));?>
    
    <?php
    $items = [
        [
            'label' => 'Русский',
            'content' => $this->render('_form_ru', [
                'form' => $form,
                'model' => $model,
                'preset_price_100' => $preset_price_100,
                'priceName' => $priceName,
                'preset_catalog_100' => $preset_catalog_100,
                'catalogName' => $catalogName,
            ]),
            'active' => true
        ],
        [
            'label' => 'Украинский',
            'content' => $this->render('_form_ua', [
                'form' => $form,
                'model' => $model,
                'preset_price_100' => $preset_price_100,
                'priceName' => $priceName,
                'preset_catalog_100' => $preset_catalog_100,
                'catalogName' => $catalogName,
            ]),
        ],
        [
            'label' => 'Английский',
            'content' => $this->render('_form_en', [
                'form' => $form,
                'model' => $model,
                'preset_price_100' => $preset_price_100,
                'priceName' => $priceName,
                'preset_catalog_100' => $preset_catalog_100,
                'catalogName' => $catalogName,
            ]),
        ]
    ];
    ?>

    <div class="row">
        <div class="col-xs-12">
            <?= \kartik\tabs\TabsX::widget([
                'items' => $items,
                'position' => \kartik\tabs\TabsX::POS_ABOVE,
                'encodeLabels' => false
            ])?>
        </div>
    </div>

        <?= Html::submitButton($model->isNewRecord ? Yii::t('app/admin', 'Создать') : Yii::t('app/admin', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Отмена', '/admin/products-categories', ['class' => 'btn btn-default', 'role' => 'button']);?>

    <?php ActiveForm::end(); ?>

</div>
