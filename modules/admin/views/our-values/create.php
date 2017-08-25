<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OurValues */

$this->title = Yii::t('app/admin', 'Создать ценность');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Наши ценности'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="our-values-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('inc/_form', [
        'model' => $model,
    ]) ?>

</div>
