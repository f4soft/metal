<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UsersToPolls */

$this->title = Yii::t('app/admin', 'Update {modelClass}: ', [
    'modelClass' => 'Users To Polls',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Users To Polls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/admin', 'Update');
?>
<div class="users-to-polls-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
