<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/admin', 'Новости');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app/admin', 'Создать новость'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($data) {
                    return Html::img("@web/images/news/{$data->id}/{$data->image}", ['width'=>'100']);
                },
            ],

            ['attribute' => 'title_ru'],
            [
                'attribute' => 'description_ru',
                'format' => 'raw',
                'value' => function($data) {
                    return \yii\helpers\StringHelper::truncate($data->description, 200);
                },
            ],
            [
                'attribute' => 'created_at',
                'format'=>'date',
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
