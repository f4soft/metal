<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SeoTags */

$this->title = 'Сео теги';
?>
<div class="seo-tags-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
