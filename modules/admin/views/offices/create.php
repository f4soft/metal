<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Offices */

$this->title = Yii::t('app/admin', 'Создать офис');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Offices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offices-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('inc/_form', [
        'model' => $model,
        'cities' => $cities
    ]) ?>

</div>
