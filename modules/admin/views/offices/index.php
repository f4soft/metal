<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Filters\OfficesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/admin', 'Офисы');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offices-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app/admin', 'Создать офис'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'address_ru'],
            [
                'attribute' => 'city_id',
                'value' => function($data){
                    return $data->city['title_ru'];
                }
            ],
            ['attribute' => 'phone'],
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'status',
                'vAlign'=>'middle',
            ],
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'is_main',
                'vAlign'=>'middle',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}&nbsp{delete}'
            ],
        ],
    ]); ?>
</div>
