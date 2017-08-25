<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reports */

$this->title = Yii::t('app/admin', 'Обновить отчет');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Отчеты'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/admin', 'Обновить');
?>
<div class="reports-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('inc/_form', [
        'model' => $model,
        'fileName' => $fileName
    ]) ?>

</div>
