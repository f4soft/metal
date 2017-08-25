<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Filters\VacanciesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/admin', 'Вакансии');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancies-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app/admin', 'Создать вакансию'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'title_ru'],
            [
                'attribute' => 'city_id',
                'value' => function($data){
                    return $data->city['title_ru'];
                }
            ],
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'status',
                'vAlign'=>'middle',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}&nbsp{delete}'
            ],
        ],
    ]); ?>
</div>
