<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pages */

$this->title = Yii::t('app/admin', 'Обновить стараницу');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Страницы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/admin', 'Обновить');
?>
<div class="pages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('inc/_form', [
        'model' => $model,
    ]) ?>

</div>
