<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Services */

$this->title = Yii::t('app/admin', 'Создать услугу');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Услуги'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="services-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('inc/_form', [
        'model' => $model,
    ]) ?>

</div>
