<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Vacancies */

$this->title = Yii::t('app/admin', 'Создать вакансию');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Вакансии'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancies-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('inc/_form', [
        'model' => $model,
        'cities' => $cities
    ]) ?>

</div>
