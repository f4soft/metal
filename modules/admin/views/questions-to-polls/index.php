<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/admin', 'Ответы для голосований');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-to-polls-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app/admin', 'Создать ответ'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
            ],
            
            [
                'format' => 'raw',
                'attribute' => 'poll_id',
                'value' => function($data){
                    return $data->poll->title;
                },
            ],
            [
                'attribute' => 'title_ru',
            ],
            [
                'attribute' => 'votes_count',
                'value' => function ($data) {
                    return is_null($data->votes_count) ? 0 : $data->votes_count;
                }
            ],
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'status',
                'vAlign'=>'middle',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => "{update}&nbsp{delete}",
                'options' => ['style' => 'width: 1%'],
            ],
        ],
    ]); ?>
</div>
