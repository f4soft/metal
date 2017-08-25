<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\ProductsCategories */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <?php if ($model->parent_id == 1):/*показываем только для категорий*/ ?>
        <?php if ( ! $model->isNewRecord && ! empty($preset_price_100['ua'])): ?>
            <?= Html::img("@web/{$preset_price_100['ua']}", ['width' => '100']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'image_price_ua')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]);
        ?>
        <?php if ( ! $model->isNewRecord && ! empty($priceName['ua'])): ?>
            <?= \kartik\helpers\Html::a('Загруженный прайс', "@web/" . $priceName['ua'], ['target' => '_blank']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'file_price_ua')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => ['application/pdf']],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>

        <?php if ( ! $model->isNewRecord && ! empty($preset_catalog_100['ua'])): ?>
            <?= Html::img("@web/{$preset_catalog_100['ua']}", ['width' => '100']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'image_catalog_ua')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]);
        ?>
        <?php if ( ! $model->isNewRecord && ! empty($catalogName['ua'])): ?>
            <?= \kartik\helpers\Html::a('Загруженный каталог', "@web/" . $catalogName['ua'], ['target' =>
                '_blank']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'file_catalog_ua')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => ['application/pdf']],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>
    <?php endif; ?>
    <?= $form->field($model, 'title_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'article_title_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'article_description_ua')->textarea()->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full',
        'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
    ]) ?>

    <?= $form->field($model, 'image_alt_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_title_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_keywords_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description_ua')->textInput(['maxlength' => true]) ?>

</div>