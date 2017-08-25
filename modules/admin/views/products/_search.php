<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Filters\ProductsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title_ru') ?>

    <?= $form->field($model, 'title_ua') ?>

    <?= $form->field($model, 'title_en') ?>

    <?= $form->field($model, 'sku') ?>

    <?php // echo $form->field($model, 'count') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'category_id') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'image_alt_ru') ?>

    <?php // echo $form->field($model, 'image_alt_ua') ?>

    <?php // echo $form->field($model, 'image_alt_en') ?>

    <?php // echo $form->field($model, 'image_title_ru') ?>

    <?php // echo $form->field($model, 'image_title_ua') ?>

    <?php // echo $form->field($model, 'image_title_en') ?>

    <?php // echo $form->field($model, 'meta_keywords_ru') ?>

    <?php // echo $form->field($model, 'meta_keywords_ua') ?>

    <?php // echo $form->field($model, 'meta_keywords_en') ?>

    <?php // echo $form->field($model, 'meta_description_ru') ?>

    <?php // echo $form->field($model, 'meta_description_ua') ?>

    <?php // echo $form->field($model, 'meta_description_en') ?>

    <?php // echo $form->field($model, 'article_title_ru') ?>

    <?php // echo $form->field($model, 'article_title_ua') ?>

    <?php // echo $form->field($model, 'article_title_en') ?>

    <?php // echo $form->field($model, 'article_description_ru') ?>

    <?php // echo $form->field($model, 'article_description_ua') ?>

    <?php // echo $form->field($model, 'article_description_en') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app/admin', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app/admin', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
