<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/admin', 'Услуги');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="services-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(\app\models\Services::isMaxServices()):?>
            <?= Html::a(Yii::t('app/admin', 'Создать услугу'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif;?>
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
