<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/admin', 'Истории нашей компании');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app/admin', 'Создать'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'title'],
            ['attribute' => 'description_ru'],

            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($data) {
                    return Html::img("@web/images/history/{$data->id}/{$data->image}", ['width'=>'100']);
                },
            ],
            ['attribute' => 'image_alt_ru'],
            ['attribute' => 'image_title_ru'],
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'status',
                'vAlign'=>'middle',
                'options' => ['style' => 'width: 1%'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => "{update}&nbsp{delete}",
                'options' => ['style' => 'width: 1%'],
            ],
        ],
    ]); ?>
</div>
