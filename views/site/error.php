<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="container error-layout-block">
    <div class="col-lg-6 col-md-6 content-error">

        <p class="error-text-large"><?= Yii::$app->getErrorHandler()->exception->statusCode?></p>
        <p class="error-text-small"><?= Yii::t('app', 'Ошибка')?></p>
        <h3 class="h3 title"><?= nl2br(Html::encode(Yii::$app->getErrorHandler()->exception->getMessage())) ?></h3>
        <p class="sorry-text"><?= Yii::t('app', 'Если вы считаете, что произошло недоразумение - пожалуйста, сообщите нам на почту -');?>
            <a href="mailto:example@gmail.com">holding@metal.kiev.ua</a>
        </p>
        <div class="link-wrapper">
            <a href="<?= \yii\helpers\Url::to(["/{$selectedCity}/catalog"])?>" class="back-to-catalog"><i class="i-holder read-more-i"></i><?= Yii::t('app', 'Вернуться в каталог')?></a>
        </div>

    </div>
    <div class="col-lg-6 col-md-6 image-error">
        <img src="/img/error-image.png" alt="">
    </div>
</div>
