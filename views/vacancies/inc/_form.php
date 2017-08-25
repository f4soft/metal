<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $model app\models\VacancyForm */
/* @var $form ActiveForm */
?>
<div class="resume-form">
    <h5 class="h5"><?= Yii::t('app', 'Заполните форму для отправки вашего резюме на эту вакансию')?></h5>
    <?php $form = ActiveForm::begin([
        'id' => 'vacancy-form-'. $vacancyID,
        'action' => ['/vacancies/send']
    ]); ?>
        <?= $form->errorSummary($model); ?>
        <?= Html::hiddenInput('form_id', $vacancyID)?>
        <?= $form->field($model, 'fio',
            [
                'template' => "<label for=\"input-fio\" class=\"label\"><span>". Yii::t('app', 'ФИО') ."</span>{input}</label>"
            ])
            ->textInput(['maxlength' => true, 'class' => 'input-text'])
            ->label(false)->hint('') ?>
        <?= $form->field($model, 'email',
            [
                'template' => "<label for=\"input-email\" class=\"label\"><span>". Yii::t('app', 'Email') ."</span>{input}</label>"
            ])
            ->textInput(['maxlength' => true, 'class' => 'input-text'])
            ->label(false)->hint('') ?>
        <?= $form->field($model, 'phone',
            [
                'template' => "<label for=\"input-phone\" class=\"label\"><span>". Yii::t('app', 'Моб. телефон') ."</span>{input}</label>"
            ])
            ->textInput(['maxlength' => true, 'class' => 'input-text'])
            ->label(false)->hint('') ?>
        <?= $form->field($model, 'file', [
            'inputTemplate' => "<div class=\"file-upluad-wrapper\"><span class=\"upload-label\">" . Yii::t('app', 'Резюме<br>(.doc, .pdf, .docx)') .
                "</span>{input}<label for=\"vacancyform-file-{$vacancyID}\" class=\"btn btn-tertiary js-labelFile\"><span class=\"glyphicon glyphicon-check\"></span><span class=\"js-fileName\">" . Yii::t('app', 'Выбрать файл') . "</span></label></div>"
        ])->fileInput(['class' => "input-file", 'id' => "vacancyform-file-{$vacancyID}"])->label(false)->hint('')->error(false) ?>
        <?= $form->field($model, 'vacancy_id')->hiddenInput(['maxlength' => true, 'value' => $vacancyID])->label(false)?>

        <div id="captcha-<?=$vacancyID?>"></div>
    <?= Html::submitButton(Yii::t('app', 'Отправить резюме'), ['class' => 'submit']) ?>
    <?php ActiveForm::end(); ?>

</div>
<?php $script = <<< JS
$('form#vacancy-form').on('beforeSubmit', function(e) {
    e.preventDefault();
    e.stopPropagation();
  var form = $(this),
    data = new FormData(form[0]);
     if (form.find('.has-error').length) {
          return false;
     }
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: data,
          success: function (response) {
               if(response.success) {
                   $('#success-vacancy').modal('toggle');
               }
               form.find("input[type=text], textarea").val("");
          }
     });
  return false;
});
JS;
$this->registerJS($script);
?>