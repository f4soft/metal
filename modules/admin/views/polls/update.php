<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Polls */

$this->title = Yii::t('app/admin', 'Обновить голосование');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Polls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/admin', '__update__');
?>
<div class="polls-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('inc/_form', [
        'model' => $model
    ]) ?>

</div>