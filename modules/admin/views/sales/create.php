<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Sales */

$this->title = Yii::t('app/admin', 'Создать спецпредложение');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Sales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('inc/_form', [
        'model' => $model,
    ]) ?>

</div>
