<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BlockSettings */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">


        <?php if ($vacanciesImage['ru']): ?>
            <?= Html::img($vacanciesImage['ru']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'vacancies_banner_ru')->fileInput()->widget
        (\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>

        <?php if ($servicesImage['ru']): ?>
            <?= Html::img($servicesImage['ru']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'services_banner_ru')->fileInput()->widget
        (\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>
        <?php if ($bannerImage['ru']): ?>
            <?= Html::img($bannerImage['ru']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'cart_banner_ru')->fileInput()->widget
        (\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>

        <?php if ($fileName['ru']): ?>
            <?= \kartik\helpers\Html::a('Справочник для прессцентра', $fileName['ru'], ['target' => '_blank']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'presscenter_price_ru')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => ['application/pdf']],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>

        <?php if ($presscenterImage['ru']): ?>
            <?= Html::img($presscenterImage['ru']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'presscenter_price_image_ru')->fileInput()->widget
        (\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>

    <?= $form->field($model, 'presscenter_price_image_alt_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'presscenter_price_image_title_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vacancy_description_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vacancy_offer_description_ru')->textarea()
        ->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full',
        'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
    ]) ?>

    <?= $form->field($model, 'services_description_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'services_offer_description_ru')->textarea()
        ->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>

    <?= $form->field($model, 'about_main_description_ru')->textarea()
        ->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>

    <?= $form->field($model, 'about_mission_description_ru')->textarea()
        ->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>

    <?= $form->field($model, 'about_strategy_description_ru')->textarea()
        ->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>

    <?= $form->field($model, 'our_goal_description_ru')->textarea()
        ->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>

    <?= $form->field($model, 'offices_description_ru')->textarea()
        ->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>

    <?= $form->field($model, 'catalog_page_seo_title_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'catalog_page_seo_description_ru')->textarea()
        ->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>

    <?= $form->field($model, 'sales_image_alt_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sales_image_title_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'about_image_title_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'about_image_alt_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'about_main_page_description_ru')->textarea()
        ->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>
</div>

