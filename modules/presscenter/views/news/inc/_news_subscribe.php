<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="rss-news-block">
    <?php
        $form = ActiveForm::begin([
            'id' => 'news-subscribe',
            'action' => ["/subscribe/news"],
        ])
    ?>
    <label class="title control-label"><?=Yii::t('app' ,'Подписаться на новости')?></label>
    <?= $form->field($model, 'email')
        ->textInput(['maxlength' => true, 'class' => 'form-control', 'id' => 'rss-input', 'placeholder' => Yii::t('app' ,'Подписаться на новости')])
        ->label(false)->hint('') ?>
    <?= $form->field($model, 'language', ['template' => '{input}'])
        ->hiddenInput(['maxlength' => true, 'value' => Yii::$app->params['langs'][Yii::$app->language]])
        ->label(false)->hint('') ?>
    <?= Html::submitButton("<span class=\"triangle-bottom-right\"></span>".Yii::t('app', 'Подписаться'), ['class' => 'submit']) ?>
    <?php
        ActiveForm::end();
    ?>
</div>

<?php $script = <<< JS
$('form#news-subscribe').on('beforeSubmit', function(e) {
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
                   $('#success-news-subscription').modal('toggle');
                   form.find("input[type=text], textarea").val("");
               }
               if(response.errorMessage){
                    $('.field-rss-input .help-block-error').text(response.errorMessage);
                    $('.field-rss-input').removeClass('has-success').addClass('has-error');
               }
          }
     });
  return false;
});
JS;
$this->registerJS($script);
?>

