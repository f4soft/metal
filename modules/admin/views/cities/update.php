<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cities */

$this->title = Yii::t('app/admin', 'Обновить город');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/admin', 'Update');
?>
<div class="cities-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('inc/_form', [
        'model' => $model,
    ]) ?>

</div>
