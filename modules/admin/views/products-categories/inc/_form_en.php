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
        <?php if ( ! $model->isNewRecord && ! empty($preset_price_100['en'])): ?>
            <?= Html::img("@web/{$preset_price_100['en']}", ['width' => '100']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'image_price_en')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]);
        ?>
    
        <?php if ( ! $model->isNewRecord && ! empty($priceName['en'])): ?>
            <?= \kartik\helpers\Html::a('Загруженный прайс', "@web/" . $priceName['en'], ['target' => '_blank']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'file_price_en')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => ['application/pdf']],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>
		
        <?php if ( ! $model->isNewRecord && ! empty($priceName['vinnitsa_en'])): ?>
            <?= \kartik\helpers\Html::a('Загруженный прайс', "@web/" . $priceName['vinnitsa_en'], ['target' => '_blank']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'file_price_vinnitsa_en')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => ['application/pdf']],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>
    
    
        <?php if ( ! $model->isNewRecord && ! empty($priceName['dnepr_en'])): ?>
            <?= \kartik\helpers\Html::a('Загруженный прайс', "@web/" . $priceName['dnepr_en'], ['target' => '_blank']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'file_price_dnepr_en')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => ['application/pdf']],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>
    
        <?php if ( ! $model->isNewRecord && ! empty($priceName['lvov_en'])): ?>
            <?= \kartik\helpers\Html::a('Загруженный прайс', "@web/" . $priceName['lvov_en'], ['target' => '_blank']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'file_price_lvov_en')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => ['application/pdf']],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>
    
        <?php if ( ! $model->isNewRecord && ! empty($priceName['odessa_en'])): ?>
            <?= \kartik\helpers\Html::a('Загруженный прайс', "@web/" . $priceName['odessa_en'], ['target' => '_blank']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'file_price_odessa_en')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => ['application/pdf']],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>
    
        <?php if ( ! $model->isNewRecord && ! empty($priceName['kharkov_en'])): ?>
            <?= \kartik\helpers\Html::a('Загруженный прайс', "@web/" . $priceName['kharkov_en'], ['target' => '_blank']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'file_price_kharkov_en')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => ['application/pdf']],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>
    
        <?php if ( ! $model->isNewRecord && ! empty($priceName['chernihiv_en'])): ?>
            <?= \kartik\helpers\Html::a('Загруженный прайс', "@web/" . $priceName['chernihiv_en'], ['target' => '_blank']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'file_price_chernihiv_en')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => ['application/pdf']],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>
    
        <?php if ( ! $model->isNewRecord && ! empty($priceName['khmelnytskyi_en'])): ?>
            <?= \kartik\helpers\Html::a('Загруженный прайс', "@web/" . $priceName['khmelnytskyi_en'], ['target' => '_blank']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'file_price_khmelnytskyi_en')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => ['application/pdf']],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>
    
        <?php if ( ! $model->isNewRecord && ! empty($priceName['poltava_en'])): ?>
            <?= \kartik\helpers\Html::a('Загруженный прайс', "@web/" . $priceName['poltava_en'], ['target' => '_blank']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'file_price_poltava_en')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => ['application/pdf']],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>   

        <?php if ( ! $model->isNewRecord && ! empty($preset_catalog_100['en'])): ?>
            <?= Html::img("@web/{$preset_catalog_100['en']}", ['width' => '100']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'image_catalog_en')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]);
        ?>
        <?php if ( ! $model->isNewRecord && ! empty($catalogName['en'])): ?>
            <?= \kartik\helpers\Html::a('Загруженный каталог', "@web/" . $catalogName['en'], ['target' =>
                '_blank']) ?>
        <?php endif; ?>
        <?= $form->field($model, 'file_catalog_en')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
            'options' => ['accept' => ['application/pdf']],
            'pluginOptions' => [
                'showRemove' => true,
                'showUpload' => false,
                'showCaption' => true,
            ]
        ]); ?>
    <?php endif; ?>
    <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'title_price_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'article_title_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'article_description_en')->textarea()->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full',
        'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
    ]) ?>

    <?= $form->field($model, 'image_alt_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_title_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_keywords_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description_en')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'page_description_en')->textarea(['rows' => 3]) ?>

</div>