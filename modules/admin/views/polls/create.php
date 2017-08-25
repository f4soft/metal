<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Polls */

$this->title = Yii::t('app/admin', 'Создать голосование');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Polls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="polls-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('inc/_form', [
        'model' => $model,
    ]) ?>

</div>
