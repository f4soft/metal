<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OurValues */

$this->title = Yii::t('app/admin', 'Обновить ценность');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Наши ценности'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/admin', 'Обновить');
?>
<div class="our-values-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('inc/_form', [
        'model' => $model,
        "preset_100" => $preset_100
    ]) ?>

</div>
