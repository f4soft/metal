<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PagesImages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-images-form">
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'] // important
    ]); ?>
    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    <?php if (!$model->isNewRecord) {
      echo  Html::img($model->getImageCircle(), [
            'class' => 'img-thumbnail',
            'width' => '100px',
            'height' => '100px'
        ]);
    }
     ?>
    <?= $form->field($model, 'c_image')->fileInput()->label('Круглая картинка в хедере')->widget
    (\kartik\widgets\FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'showRemove' => true,
            'showUpload' => false,
            'showCaption' => true,
        ]
    ]); ?>
    <?php if (!$model->isNewRecord) {
        echo Html::img($model->getImageBg(), [
            'class' => 'img-thumbnail',
            'width' => '500px',
            'height' => '100px'
        ]);
    }
    ?>
    <?= $form->field($model, 'b_image')->fileInput()->label('Фоновая картинка в хедере')->widget
    (\kartik\widgets\FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'showRemove' => true,
            'showUpload' => false,
            'showCaption' => true,
        ]
    ]); ?>
    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Создать') : Yii::t('app', 'Обновить'), ['class' =>
        $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>
</div>
