<?php
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Filters\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/admin', 'Авто Импорт');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'file_name',
            ],
            [
                'attribute' => 'file_type',
            ],
            [
                'format' => 'raw',
                'label' => Yii::t('app/admin', 'Статус'),
                'attribute' => 'status',
                'value' => function($data){       
                    return $data->getStatus();
                }
            ],
            [
                'attribute' => 'created_at',
                'format'=>'date',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => /*"{view}&nbsp{delete}"*/"",
            ],
        ],
    ]); ?>
</div>