<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PagesImages */

$this->title = Yii::t('app', 'Добавить новую запись');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages Images'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-images-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
