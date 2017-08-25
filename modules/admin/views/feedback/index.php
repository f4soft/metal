<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/admin', 'Обратная связь');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
            ],
            [
                'attribute' => 'phone',
            ],
            [
                'attribute' => 'email',
            ],
            [
                'attribute' => 'message',
            ],
            [
                'format' => 'raw',
                'attribute' => 'status',
                'value' => function($data){
                    return \app\components\Helper::feedbackStatus($data->status);
                },
                'hAlign' => \kartik\grid\GridView::ALIGN_CENTER,
                'options' => ['style' => 'width: 1%; text-align: center'],
            ],
            [
                'attribute'=>'created_at',
                'format' => 'date'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}&nbsp{delete}'
            ],

        ],
    ]); ?>
</div>
