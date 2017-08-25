<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Departments */

$this->title = Yii::t('app/admin', 'Обновить отдел');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Departments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/admin', 'Обновить');
?>
<div class="departments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('inc/_form', [
        'model' => $model,
        'offices' => $offices
    ]) ?>

</div>
