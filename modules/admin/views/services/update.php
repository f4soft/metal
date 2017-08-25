<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Services */

$this->title = Yii::t('app/admin', 'Обновить услугу');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Услуги'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/admin', 'Обновить');
?>
<div class="services-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('inc/_form', [
        'model' => $model,
        'preset_100' => $preset_100,
        'preset_big_100' => $preset_big_100
    ]) ?>

</div>
