<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Feedback */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Feedbacks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="feedback-view">

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
            'name',
            'phone',
            'email:email',
            'message:ntext',
            [
                'format' => 'raw',
                'attribute' => 'status',
                'value' => \app\components\Helper::feedbackStatus($model->status),
                'hAlign' => \kartik\grid\GridView::ALIGN_CENTER,
                'options' => ['style' => 'width: 1%; text-align: center'],
            ],

            [
                'format' => 'date',
                'attribute' => 'created_at'
            ],
        ],
    ]) ?>

</div>
