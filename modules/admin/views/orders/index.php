<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Filters\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/admin', 'Заказы');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'user_id',
                'label' => Yii::t('app/admin', 'Пользователь'),
                'value' => function ($data) {
                    $user = \app\models\User::find()->where(['id'=> $data->user_id])->one();
                    return !is_null($user->name)? $user->name:$user->company;
                }
            ],
            [
                'attribute' => 'sum',
                'label' => Yii::t('app/admin', 'Общая сумма'),
            ],
            [
                'attribute' => 'weight',
                'label' => Yii::t('app/admin', 'Общий вес'),
            ],
            [
                'format' => 'raw',
                'attribute' => 'status',
                'value' => function ($data) {
                    return \app\components\Helper::feedbackStatus($data->status);
                },
                'hAlign' => \kartik\grid\GridView::ALIGN_CENTER,
                'options' => ['style' => 'width: 1%; text-align: center'],
            ],
            [
                'attribute' => 'created_at',
                'format' => 'date'
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'date'
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => "{view}",
            ],
        ],
    ]); ?>
</div>
