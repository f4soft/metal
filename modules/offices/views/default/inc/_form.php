<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VacancyForm */
/* @var $form ActiveForm */
?>
    <?php $form = ActiveForm::begin([
        'id' => 'offices-form',
        'action' => ['/offices/send'],
        'options' => [
            'class' => 'feedback-form',
        ],
]); ?>

        <?= $form->field($model, 'name',
            [
                'template' => "<label for=\"input-name\" class=\"label\">{input}</label>{error}"
            ])
            ->textInput(['maxlength' => true, 'class' => 'input-text', 'id' => 'input-name', 'placeholder' => Yii::t('app', 'Ваше имя...')])
            ->label(false)->hint('') ?>

        <?= $form->field($model, 'email_from',
            [
                'template' => "<label for=\"input-email\" class=\"label\">{input}</label>{error}"
            ])
            ->textInput(['maxlength' => true, 'class' => 'input-text', 'id' => 'input-email', 'placeholder' => Yii::t('app', 'Эл. почта...')])
            ->label(false)->hint('') ?>

        <?= $form->field($model, 'phone',
            [
                'template' => "<label for=\"input-phone\" class=\"label\">{input}</label>{error}"
            ])
            ->textInput(['maxlength' => true, 'id' => 'input-phone', 'placeholder' => Yii::t('app', 'Номер телефона...')])
            ->label(false)->hint('')->widget(
                \yii\widgets\MaskedInput::className(), ['mask' => '999 99 99 999', 'options' => ['class' => 'input-text']]
            ); ?>

        <?= $form->field($model, 'message',
            [
                'template' => "<label for=\"input-message\" class=\"label\">{input}</label>{error}"
            ])
            ->textarea(['maxlength' => true, 'class' => 'textarea', 'id' => 'input-message', 'placeholder' => Yii::t('app', 'Текстовое сообщение...')])
            ->label(false)->hint('') ?>

        <?= $form->field($model, 'reCaptcha')->widget(
            \himiklab\yii2\recaptcha\ReCaptcha::className(),
            ['siteKey' => Yii::$app->params['recaptchaSiteKey']]
        )->label(false) ?>
        <?= $form->field($model, 'email_to')->hiddenInput()->label(false)->hint('')?>
    <?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'submit']) ?>
    <?php ActiveForm::end(); ?>
<?php $script = <<< JS
$('form#offices-form').on('beforeSubmit', function(e) {
  var form = $(this);
     if (form.find('.has-error').length) {
          return false;
     }
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               if(response.success) {
                   $('#success-offices').modal('toggle');
               }
               form.find("input[type=text], textarea").val("");
               grecaptcha.reset();
          }
     });
  return false;
});
JS;
$this->registerJS($script);
?>
