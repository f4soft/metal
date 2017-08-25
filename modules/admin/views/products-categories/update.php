<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductsCategories */

$this->title = Yii::t('app/admin', 'Обновить категорию');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Products Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/admin', 'Update');
?>
<div class="products-categories-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('inc/_form', [
        'model' => $model,
        'preset_100' => $preset_100,
        'preset_price_100' => $preset_price_100,
        'priceName' => $priceName,
        'rootCategories' => $rootCategories,
        'preset_catalog_100' => $preset_catalog_100,
        'catalogName' => $catalogName,
    ]) ?>

</div>
