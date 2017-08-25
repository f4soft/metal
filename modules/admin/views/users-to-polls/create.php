<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UsersToPolls */

$this->title = Yii::t('app/admin', 'Create Users To Polls');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Users To Polls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-to-polls-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
