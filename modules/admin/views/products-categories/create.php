<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductsCategories */

$this->title = Yii::t('app/admin', 'Создать категорию');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Категория товара'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('inc/_form', [
        'model' => $model,
        'rootCategories' => $rootCategories,
    ]) ?>

</div>
