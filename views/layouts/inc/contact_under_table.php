<div class="container-fluid table-footer-block">
    <span class="h3"><?= Yii::t('app', "<strong>Есть вопросы?</strong> Обращайтесь к нашим менеджерам")?></span>
    <?php $form = \yii\bootstrap\ActiveForm::begin([
        'id' => 'table-feedback-form',
        'action' => ['/site/contact']
    ]);?>
        <?= $form->field($model, 'name',[
            'options' => ['class' => 'col-lg-3 col-md-3 col-sm-4',],
            'template' => "{input}{error}"
            ])
            ->textInput(['maxlength' => true, 'class' => 'form-control', 'placeholder' => Yii::t('app', 'Имя')])
            ->label(false)->hint('')
        ?>
        <?= $form->field($model, 'phone',[
            'options' => ['class' => 'col-lg-3 col-md-3 col-sm-4',],
            'template' => "{input}{error}"
        ])
            ->textInput(['maxlength' => true, 'class' => 'form-control', 'placeholder' => Yii::t('app', 'Телефон')])
            ->label(false)->hint('')
        ?>
        <?= $form->field($model, 'email',[
            'options' => ['class' => 'col-lg-3 col-md-3 col-sm-4',],
            'template' => "{input}{error}"
        ])
            ->textInput(['maxlength' => true, 'class' => 'form-control', 'placeholder' => Yii::t('app', 'Email')])
            ->label(false)->hint('')
        ?>
        <div class="col-lg-3 col-md-3">
            <?= \kartik\helpers\Html::submitButton(Yii::t('app', 'Связаться с нами'), ['class' => 'btn sumbit']) ?>
        </div>
    <?php \yii\bootstrap\ActiveForm::end();?>
</div>
<?php $script = <<< JS
$('form#table-feedback-form').on('beforeSubmit', function(e) {
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
          }
     });
  return false;
});
JS;
$this->registerJS($script);
?>