<?php
use kartik\helpers\Html;
$toRoute = \yii\helpers\Url::to(["/$city/presscenter/news/{$model->alias}"]);
?>
<div class="news-item col-lg-6">
    <?= Html::a(Html::img('/'.$image, ['class'=> 'news-preview-img', 'alt'=>$model->image_alt, 'title'=>$model->image_title])
        , $toRoute)?>
    <?= Html::a(\yii\helpers\StringHelper::truncate($model->title, 50), $toRoute, ['class' => 'preview-title'])?>
    <span class="preview-date"><?= Yii::$app->formatter->asDate($model->date_show)?></span>
    <p class="preview-text"><?= \yii\helpers\StringHelper::truncate(strip_tags($model->description), 80);?></p>
</div>