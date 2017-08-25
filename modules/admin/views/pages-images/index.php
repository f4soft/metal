<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\filters\PagesImagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Картинки в шапках страниц');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-images-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Добавить новую запись'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'description',
            [
                'attribute' => 'circle_image',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img("@web/images/pages_imgs/{$data->slug}/{$data->circle_image}", ['width' => '100px']);
                },
            ],
            [
                'attribute' => 'bg_image',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img("@web/images/pages_imgs/{$data->slug}/{$data->bg_image}",
                        ['width' => '400px', 'height'=>'100px']);
                },
            ],
            // 'updated_at',
            // 'created_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}&nbsp{delete}'
            ],
        ],
    ]); ?>
</div>
