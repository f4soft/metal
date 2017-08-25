<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BlockSettings */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">

    <?php if ($vacanciesImage['ua']): ?>
        <?= Html::img($vacanciesImage['ua']) ?>
    <?php endif; ?>
    <?= $form->field($model, 'vacancies_banner_ua')->fileInput()->widget
    (\kartik\widgets\FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'showRemove' => true,
            'showUpload' => false,
            'showCaption' => true,
        ]
    ]); ?>
    <?php if ($servicesImage['ua']): ?>
        <?= Html::img($servicesImage['ua']) ?>
    <?php endif; ?>
    <?= $form->field($model, 'services_banner_ua')->fileInput()->widget
    (\kartik\widgets\FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'showRemove' => true,
            'showUpload' => false,
            'showCaption' => true,
        ]
    ]); ?>
    <?php if ($bannerImage['ua']): ?>
        <?= Html::img($bannerImage['ua']) ?>
    <?php endif; ?>
    <?= $form->field($model, 'cart_banner_ua')->fileInput()->widget
    (\kartik\widgets\FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'showRemove' => true,
            'showUpload' => false,
            'showCaption' => true,
        ]
    ]); ?>
    <?php if ($fileName['ua']):  ?>
            <?= \kartik\helpers\Html::a('Справочник для прессцентра', $fileName['ua'], ['target' => '_blank']) ?>
       <?php endif;  ?>
    <?= $form->field($model, 'presscenter_price_ua')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
        'options' => ['accept' => ['application/pdf']],
        'pluginOptions' => [
            'showRemove' => true,
            'showUpload' => false,
            'showCaption' => true,
        ]
    ]); ?>

    <?php if ($presscenterImage['ua']):  ?>
            <?= Html::img($presscenterImage['ua'])  ?>
        <?php endif;  ?>
    <?= $form->field($model, 'presscenter_price_image_ua')->fileInput()->widget
    (\kartik\widgets\FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'showRemove' => true,
            'showUpload' => false,
            'showCaption' => true,
        ]
    ]); ?>
    <?= $form->field($model, 'presscenter_price_image_alt_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'presscenter_price_image_title_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vacancy_description_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vacancy_offer_description_ua')->textarea()
        ->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>

    <?= $form->field($model, 'services_description_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'services_offer_description_ua')->textarea()
        ->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>

    <?= $form->field($model, 'about_main_description_ua')->textarea()
        ->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>

    <?= $form->field($model, 'about_mission_description_ua')->textarea()
        ->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>

    <?= $form->field($model, 'about_strategy_description_ua')->textarea()
        ->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>

    <?= $form->field($model, 'our_goal_description_ua')->textarea()
        ->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>

    <?= $form->field($model, 'offices_description_ua')->textarea()
        ->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>

    <?= $form->field($model, 'catalog_page_seo_title_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'catalog_page_seo_description_ua')->textarea()
        ->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>
    <?= $form->field($model, 'sales_image_alt_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sales_image_title_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'about_image_title_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'about_image_alt_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'about_main_page_description_ua')->textarea()
        ->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>
</div>

