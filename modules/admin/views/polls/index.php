<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/admin', 'Голосования');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="polls-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app/admin', 'Создать голосование'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
            ],
            [
                'attribute' => 'title_ru',
            ],
            [
                'attribute' => 'total_votes',
                'value' =>function ($data){
                    return is_null($data->total_votes)?0: $data->total_votes;
                }
            ],
//            [
//                'class'=>'kartik\grid\BooleanColumn',
//                'attribute'=>'is_multiple',
//                'vAlign'=>'middle',
//            ],
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'status',
                'vAlign'=>'middle',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => "{update}&nbsp{delete}"
            ],
        ],
    ]); ?>
</div>