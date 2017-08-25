<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vacancies */

$this->title = Yii::t('app/admin', 'Обновить вакансию');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Vacancies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/admin', 'Обновить');
?>
<div class="vacancies-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('inc/_form', [
        'model' => $model,
        'cities' => $cities
    ]) ?>

</div>
