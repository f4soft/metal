<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Departments */

$this->title = Yii::t('app/admin', 'Создать отдел');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Departments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('inc/_form', [
        'model' => $model,
        'offices' => $offices
    ]) ?>

</div>
