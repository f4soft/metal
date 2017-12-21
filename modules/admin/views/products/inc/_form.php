<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $preset_100 = $model->isNewRecord ? false : $preset_100; ?>

    <?= $form->field($model, 'popular')->checkbox()?>
    
    <?= $form->field($model, 'recommend')->checkbox()?>

    <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropDownList($categories, ["prompt" => Yii::t("app", "Выберете значение")]) ?>

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

    <?= $form->field($model, 'status')->checkbox() ?>
    
    <?= $form->field($model, 'alias')->textInput(['value' => app\models\Products::getUrl($model, ""), 'disabled' => true])->label(Yii::t('app', 'Путь (alias)'));?>

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
        <div class="col-xs-12">
            <?php foreach ($model->productRelatedData as $item): ?>
                <p><?= $item->city->title?>:</p>
                <p>Цена: <?= \kartik\helpers\Html::textInput("Products[price][{$item->city_id}]", $item->price, ['class' => 'form-control'])?></p>
                <p>Описание RU: <?= \kartik\helpers\Html::textInput("Products[description_ru][{$item->city_id}]", $item->description_ru, ['class' => 'form-control']);?></p>
                <p>Описание UA: <?= \kartik\helpers\Html::textInput("Products[description_ua][{$item->city_id}]", $item->description_ua, ['class' => 'form-control']);?></p>
                <p>Описание EN: <?= \kartik\helpers\Html::textInput("Products[description_en][{$item->city_id}]", $item->description_en, ['class' => 'form-control']);?></p>
            <?php endforeach;?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <?= \kartik\tabs\TabsX::widget([
                'items' => $items,
                'position' => \kartik\tabs\TabsX::POS_ABOVE,
                'encodeLabels' => false
            ])?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app/admin', 'Создать') : Yii::t('app/admin', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Отмена', '/admin/products', ['class' => 'btn btn-default', 'role' => 'button']);?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
