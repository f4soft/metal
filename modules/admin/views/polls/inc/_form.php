<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Polls */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="polls-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php /*$form->field($model, 'is_multiple')->checkbox();*/ ?>

    <?= $form->field($model, 'status')->checkbox(); ?>

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
        <?= Html::a(Yii::t('app/admin', 'Отменить'), '/admin/polls', ['class' => 'btn btn-default']);?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
