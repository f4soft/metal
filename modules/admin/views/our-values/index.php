<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/admin', 'Наши ценности');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="our-values-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app/admin', 'Создать'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'title_ru'],
            [
                'attribute' => 'description_ru',
                'format' => 'raw',
                'value' => function($data) {
                    return \yii\helpers\StringHelper::truncate($data->description, 200);
                },
            ],
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($data) {
                    return Html::img("@web/images/our_values/{$data->id}/{$data->image}", ['width'=>'100']);
                },
            ],
            ['attribute' => 'image_title_ru'],
            ['attribute' => 'image_alt_ru'],

            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'status',
                'vAlign'=>'middle',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}&nbsp{delete}'
            ]
        ],
    ]); ?>
</div>
