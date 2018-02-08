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
    
     <?php if($model->parent_id > 1):/*показываем только для подкатегорий*/?>    
        <div class="form-group">
            <a href="<?= \yii\helpers\Url::to(["/admin/categories-link/index/", "category_id" => $model->id]) ?>" blank="__target">
                <button class="btn btn-primary" type="button"><?= Yii::t('app/admin', 'Ссылки на подкатегории') ?></button>
            </a>
        </div>    
    <?php endif;?>

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
