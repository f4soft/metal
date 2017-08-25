<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Filters\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/admin', 'Товары');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'title_ru',
            ],
            [
                'attribute' => 'title_ua',
            ],
            [
                'attribute' => 'title_en',
            ],
            [
                'attribute' => 'sku',
            ],
/*            [
//                'attribute' => 'price',
            ],*/
            [
                'format' => 'raw',
                'label' => Yii::t('app/admin', 'Категория'),
                'attribute' => 'category_id',
                'value' => function($data){
                    return $data->productCategory['title'];
                },
                'options' => ['style' => 'width: 1%'],
            ],
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'status',
                'vAlign'=>'middle',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => "{update}&nbsp{delete}",
            ],
        ],
    ]); ?>
</div>
