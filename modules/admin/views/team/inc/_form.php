<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Team */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="team-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <?php if(!$model->isNewRecord):?>
        <?= Html::img("@web/$preset_100")?>
    <?php endif;?>

    <?= $form->field($model, 'image')->fileInput()->widget(\kartik\widgets\FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'showRemove' => true,
            'showUpload' => false,
            'showCaption' => true,
        ]
    ]); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_phone')->textInput(['maxlength' => true])->widget(
        MaskedInput::className(), ['mask' => '(999) 99 99 999']);
    ?>

    <?= $form->field($model, 'mobile_phone')->textInput(['maxlength' => true])->widget(
        MaskedInput::className(), ['mask' => '999 99 99 999']
    ); ?>

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
        <?= Html::a('Отмена', '/admin/team', ['class' => 'btn btn-default', 'role' => 'button']);?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
