<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/admin', 'Категории');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-categories-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!--<p>
        <?/*= Html::a(Yii::t('app/admin', 'Создать категорию'), ['create'], ['class' => 'btn btn-success']) */?>
    </p>-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'title_ru',
                /*'value' => function ($data){
                    return Html::a($data->title_ru, ['products/index', 'ProductsSearch[category_id]'=> $data->title_ru]);
                },*/
                'format' => 'raw',
                'value' => 'title_ru',
                'options' => ['style' => 'width: 1%'],
                'contentOptions' =>function ($model, $key, $index, $column){
                    if($model->depth){
                        return ['style' => "padding-left: {$model->depth}2px"];
                    } else {
                        return ['style' => "padding-left: 8px"];
                    }
                },
            ],
            [
                'attribute' => 'article_title_ru',
            ],
            [
                'attribute' => 'article_description_ru',
            ],

            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'status',
                'vAlign'=>'middle',
                'options' => ['style' => 'width: 1%'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => "{update}&nbsp{delete}",
            ],
        ],
    ]); ?>
</div>
