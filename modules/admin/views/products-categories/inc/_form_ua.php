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
    
        <?php if ( ! $model->isNewRecord && ! empty($priceName['vinnitsa_ua'])): ?>
            <?= \kartik\helpers\Html::a('Загруженный прайс', "@web/" . $priceName['vinnitsa_ua'], ['target' => '_blank']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'file_price_vinnitsa_ua')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => ['application/pdf']],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>
    
        <?php if ( ! $model->isNewRecord && ! empty($priceName['dnepr_ua'])): ?>
            <?= \kartik\helpers\Html::a('Загруженный прайс', "@web/" . $priceName['dnepr_ua'], ['target' => '_blank']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'file_price_dnepr_ua')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => ['application/pdf']],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>
    
        <?php if ( ! $model->isNewRecord && ! empty($priceName['lvov_ua'])): ?>
            <?= \kartik\helpers\Html::a('Загруженный прайс', "@web/" . $priceName['lvov_ua'], ['target' => '_blank']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'file_price_lvov_ua')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => ['application/pdf']],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>
    
        <?php if ( ! $model->isNewRecord && ! empty($priceName['odessa_ua'])): ?>
            <?= \kartik\helpers\Html::a('Загруженный прайс', "@web/" . $priceName['odessa_ua'], ['target' => '_blank']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'file_price_odessa_ua')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => ['application/pdf']],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>
    
        <?php if ( ! $model->isNewRecord && ! empty($priceName['kharkov_ua'])): ?>
            <?= \kartik\helpers\Html::a('Загруженный прайс', "@web/" . $priceName['kharkov_ua'], ['target' => '_blank']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'file_price_kharkov_ua')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => ['application/pdf']],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>
   
		
        <?php if ( ! $model->isNewRecord && ! empty($priceName['chernihiv_ua'])): ?>
            <?= \kartik\helpers\Html::a('Загруженный прайс', "@web/" . $priceName['chernihiv_ua'], ['target' => '_blank']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'file_price_chernihiv_ua')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => ['application/pdf']],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>
    
    
        <?php if ( ! $model->isNewRecord && ! empty($priceName['khmelnytskyi_ua'])): ?>
            <?= \kartik\helpers\Html::a('Загруженный прайс', "@web/" . $priceName['khmelnytskyi_ua'], ['target' => '_blank']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'file_price_khmelnytskyi_ua')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => ['application/pdf']],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>
    
        <?php if ( ! $model->isNewRecord && ! empty($priceName['poltava_ua'])): ?>
            <?= \kartik\helpers\Html::a('Загруженный прайс', "@web/" . $priceName['poltava_ua'], ['target' => '_blank']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'file_price_poltava_ua')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
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
    <?= $form->field($model, 'title_price_ua')->textInput(['maxlength' => true]) ?>

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
    
    <?= $form->field($model, 'page_description_ua')->textarea(['rows' => 3]) ?>

</div>