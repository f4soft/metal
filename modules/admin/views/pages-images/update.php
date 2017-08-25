<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PagesImages */

$this->title = Yii::t('app', 'Обновить');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages Images'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pages-images-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update', [
        'model' => $model,
    ]) ?>

</div>
