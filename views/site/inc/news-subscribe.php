<div class="col-lg-4 rss-news-block-wrapper">
    <div class="rss-news-block">
        <img src="/img/news_subscr.jpeg" alt="" title="">
        <?php $form = \yii\bootstrap\ActiveForm::begin([
            'id' => 'news-subscribe-index',
            'action' => ["/subscribe/news"]
        ])?>
        <label class="title control-label" for="rss-input"><?= Yii::t('app', 'Подписаться на новости')?></label>

        <?= $form->field($model, 'email')
            ->textInput(['class' => 'form-control', 'id' => 'rss-input', 'placeholder' => Yii::t('app' ,'Подписаться на новости')])
            ->label(false)->hint('') ?>
        <?= $form->field($model, 'language', ['template' => '{input}'])
            ->hiddenInput(['value' => Yii::$app->params['langs'][Yii::$app->language]])
            ->label(false)->hint('') ?>
        <?= \kartik\helpers\Html::submitButton("<span class=\"triangle-bottom-right\"></span>".Yii::t('app', 'Подписаться'), ['class' => 'submit']) ?>
        <?php $form::end();?>
        <p class="text"><?= Yii::t('app', 'Получайте свежие новости компании и последние сведения пресс-центра.')?></p>
    </div>
</div>
<?php $script = <<< JS
$('form#news-subscribe-index').on('beforeSubmit', function(e) {
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
<?= $this->render('@app/modules/presscenter/views/news/inc/popup')?>
