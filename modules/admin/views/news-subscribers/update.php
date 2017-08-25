<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NewsSubcribers */

$this->title = Yii::t('app/admin', 'Обновить подписчика');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'News Subcribers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/admin', 'Update');
?>
<div class="news-subcribers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
