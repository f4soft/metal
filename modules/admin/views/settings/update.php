<?php
$this->title = Yii::t('app/admin', 'Обновить настройку');
?>
<div class="user-view settings-update">
    <h1><?= \kartik\helpers\Html::encode($this->title) ?></h1>

    <?= $this->render('inc/_form', [
        'model' => $model,
    ]) ?>

</div>