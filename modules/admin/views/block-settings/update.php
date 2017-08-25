<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BlockSettings */

$this->title = Yii::t('app/admin', 'Обновить настройки блоков');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Block Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/admin', 'Update');
?>
<div class="block-settings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('inc/_form', [
        'model' => $model,
        'fileName' => $fileName,
        'presscenterImage' => $presscenterImage,
        'salesImage' => $salesImage,
        'aboutImage' => $aboutImage,
        'bannerImage' => $bannerImage,
        'servicesImage' => $servicesImage,
        'vacanciesImage' => $vacanciesImage
    ]) ?>

</div>
