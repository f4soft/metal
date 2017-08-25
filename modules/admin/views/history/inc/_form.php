<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\History */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="history-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if(!$model->isNewRecord):?>
        <?= Html::img("@web/$preset_100", ['width' => '100'])?>
    <?php endif;?>

    <div class="row">
        <div class="col-xs-6">
            <?= $form->field($model, 'image')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
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
        <div class="col-xs-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

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

    <div class="row">
        <div class="col-xs-6">
            <?= \kartik\tabs\TabsX::widget([
                'items' => $items,
                'position' => \kartik\tabs\TabsX::POS_ABOVE,
                'encodeLabels' => false
            ])?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app/admin', 'Создать') : Yii::t('app/admin', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Отменить', '/admin/history', ['class' => 'btn btn-default']);?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
