<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\QuestionsToPolls */

    /**
     * #TODO: add language support
     */
    $this->title = Yii::t('app/admin', 'Обновить');
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Ответы для голосований'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
    $this->params['breadcrumbs'][] = Yii::t('app/admin', 'Update');
?>
<div class="questions-to-polls-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('inc/_form', [
        'model' => $model,
        'polls' => $polls,
    ]) ?>

</div>
