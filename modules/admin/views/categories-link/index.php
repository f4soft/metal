<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\ProductsCategories;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticlesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/admin', 'Ссылки для').' '.$category->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app/admin', 'Добавить ссылку'), ['create', 'category_id' => $category->id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'format' => 'raw',
                'filter' => false,
                'value' => function($data) {
                    return $data->id;
                },
            ],
            [
                'label' => Yii::t('app/admin', 'Для подкатегории'),
                'attribute' => 'owner_category',
                'format' => 'raw',
                'filter' => false,
                'enableSorting' => false,
                'value' => function($data) {                    
                    return $data->ownerCategory->title;
                },
            ],
            [
                'label' => Yii::t('app/admin', 'Категория'),
                'attribute' => 'category_root',
                'format' => 'raw',
                'filter' => false,
                'enableSorting' => false,
                'value' => function($data) {                    
                    $categoryRoot = ProductsCategories::getRootCategory($data->category_id);                    
                    return $categoryRoot->title;
                },                      
            ],
            [
                'label' => Yii::t('app/admin', 'Cсылка'),
                'attribute' => 'category',
                'format' => 'raw',
                'enableSorting' => false,
                'value' => function($data) {
                    
                    $category = $data->productCategory;                    
                    return Html::a($category->title, ['/catalog' . $category->getFullAlias()], ['target' => '_blank']);
                },
            ],
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'status',
                'vAlign'=>'middle',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}&nbsp{delete}'
            ],
        ],
    ]); ?>
</div>