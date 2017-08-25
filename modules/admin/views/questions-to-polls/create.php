<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\QuestionsToPolls */

$this->title = Yii::t('app/admin', Yii::t('app/admin', 'Создать ответ для голосований'));
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Ответы для голосований'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-to-polls-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('inc/_form', [
        'model' => $model,
        'polls' => $polls,
    ]) ?>

</div>
