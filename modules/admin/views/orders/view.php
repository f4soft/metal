<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = Yii::t('app/admin', 'Orders');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app/admin', 'Назад'), ['index'], ['class' => 'btn btn-primary']) ?>
        <?php if(!$model->status):?>
        <?= Html::a(Yii::t('app/admin', 'Сменить статус на обработанный'), ['update', 'id' => $model->id], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => Yii::t('app/admin', 'Are you sure you want to delete this item?'),
               // 'method' => 'post',
            ],
        ]) ?>
        <?php endif;?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'format' => 'raw',
                'attribute' => 'user_id',
                'value' => function ($model, $widgetl) {
                    $user = \app\models\User::find()->where(['id' => $widgetl->model->user_id])->one();
                    return !is_null($user->name) ? $user->name : $user->company;
                },
            ],
            'sum',
            'weight',
            [
                'format' => 'raw',
                'attribute' => 'status',
                'value' => \app\components\Helper::feedbackStatus($model->status),
                'hAlign' => \kartik\grid\GridView::ALIGN_CENTER,
                'options' => ['style' => 'width: 1%; text-align: center'],
            ],
            'created_at:datetime',
            'updated_at:datetime'
        ],
    ]) ?>

</div>
