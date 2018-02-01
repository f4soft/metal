<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if(!$model->isNewRecord):?>
        <?= Html::img("@web/$preset_100", ['width' => '100'])?>
    <?php endif;?>
    <?= $form->field($model, 'small_image')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'showRemove' => true,
            'showUpload' => false,
            'showCaption' => true,
        ]
    ]); ?>
    <?php if(!$model->isNewRecord):?>
        <?= Html::img("@web/$preset_big_100", ['width' => '100'])?>
    <?php endif;?>
    <?= $form->field($model, 'big_image')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'showRemove' => true,
            'showUpload' => false,
            'showCaption' => true,
        ]
    ]); ?>
    
    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->checkbox() ?>

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

    <?= \kartik\tabs\TabsX::widget([
        'items' => $items,
        'position' => \kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false
    ])?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app/admin', 'Создать') : Yii::t('app/admin', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Отменить', '/admin/services', ['class' => 'btn btn-default']);?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
