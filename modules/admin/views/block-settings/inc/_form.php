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
                'fileName' => $fileName,
                'presscenterImage' => $presscenterImage,
                'bannerImage' => $bannerImage,
                'servicesImage'=> $servicesImage,
                'vacanciesImage'=> $vacanciesImage
            ]),
            'active' => true
        ],
        [
            'label' => 'Украинский',
            'content' => $this->render('_form_ua', [
                'form' => $form,
                'model' => $model,
                'fileName' => $fileName,
                'presscenterImage' => $presscenterImage,
                'bannerImage' => $bannerImage,
                'servicesImage'=> $servicesImage,
                'vacanciesImage'=> $vacanciesImage
            ]),
        ],
        [
            'label' => 'Английский',
            'content' => $this->render('_form_en', [
                'form' => $form,
                'model' => $model,
                'fileName' => $fileName,
                'presscenterImage' => $presscenterImage,
                'bannerImage' => $bannerImage,
                'servicesImage'=> $servicesImage,
                'vacanciesImage'=> $vacanciesImage
            ]),
        ]
    ];
    ?>
    <div class="row">
        <div class="col-xs-4">
            <?php if($salesImage): ?>
                <?= Html::img($salesImage)?>
            <?php endif;?>
            <?= $form->field($model, 'sales_image')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'showRemove' => true,
                    'showUpload' => false,
                    'showCaption' => true,
                ]
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4">
            <?php if($aboutImage): ?>
                <?= Html::img($aboutImage)?>
            <?php endif;?>
            <?= $form->field($model, 'about_image')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'showRemove' => true,
                    'showUpload' => false,
                    'showCaption' => true,
                ]
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4">
            <?= $form->field($model, 'newsletter_enable')->checkbox()?>
        </div>
    </div>

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
