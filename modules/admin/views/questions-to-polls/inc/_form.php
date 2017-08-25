<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\QuestionsToPolls */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="questions-to-polls-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->checkbox(); ?>

    <?= $form->field($model, 'poll_id')->dropDownList($polls)?>

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
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app/admin', 'Создать') :
            Yii::t('app/admin', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app/admin', 'Отменить'), '/admin/questions-to-polls', ['class' => 'btn btn-default']);?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
