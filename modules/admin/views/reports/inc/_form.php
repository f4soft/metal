<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>

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
        <div class="col-xs-8">
            <?= $form->field($model, 'status')->checkbox() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-8">
            <?php if(!$model->isNewRecord):?>
                <?= 'Загруженный отчет: ' . $fileName?>
            <?php endif;?>
            <?= $form->field($model, 'file')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
                'options' => ['accept' => ['application/pdf', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']],
                'pluginOptions' => [
                    'showRemove' => true,
                    'showUpload' => false,
                    'showCaption' => true,
                ]
            ]); ?>
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
        <?= Html::a('Отменить', '/admin/reports', ['class' => 'btn btn-default'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
