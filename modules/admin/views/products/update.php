<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = Yii::t('app/admin', 'Обновить товар');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/admin', 'Update');
?>
<div class="products-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('inc/_form', [
        'model' => $model,
        'categories' => $categories,
        "preset_100" => $preset_100,
        //'additionalInfo' => $additionalInfo,
    ]) ?>

</div>
