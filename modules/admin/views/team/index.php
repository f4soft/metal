<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Filters\TeamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/admin', 'Сотрудники');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="team-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app/admin', 'Создать сотрудника'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'fname_ru',
                'options' => ['style' => 'width: 1%'],
            ],
            [
                'attribute' => 'lname_ru',
                'options' => ['style' => 'width: 1%'],
            ],
            [
                'attribute' => 'sname_ru',
                'options' => ['style' => 'width: 1%'],
            ],
            [
                'attribute' => 'position_ru',
                'options' => ['style' => 'width: 1%'],
            ],
            [
                'attribute' => 'fname_ru',
                'options' => ['style' => 'width: 1%'],
            ],
            [
                'attribute' => 'email',
                'format' => 'email',
                'options' => ['style' => 'width: 1%'],
            ],
             'work_phone',
             'mobile_phone',
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
