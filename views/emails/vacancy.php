<?php
$this->title = Yii::t('app', 'Новое резюме')
?>
<h1><?= Yii::t('app', 'Новое резюме') ?></h1>
<h2><?= Yii::t('app', 'Вакансия') ?></h2>
<p><b><?= Yii::t('app', 'Название вакансии') ?></b><br><?= $vacancy->title ?></p>
<p><b><?= Yii::t('app', 'Отдел') ?></b><br><?= $vacancy->department_title ?></p>
<p><b><?= Yii::t('app', 'Требования') ?></b><br><?= $vacancy->requirements ?></p>
<p><b><?= Yii::t('app', 'Описание') ?></b><br><?= $vacancy->description ?></p>
<h2><?= Yii::t('app', 'Соискатель') ?></h2>
<p><b><?= Yii::t('app', 'ФИО') ?></b><br><?= $model->fio ?></p>
<p><b><?= Yii::t('app', 'емайл') ?></b><br><?= $model->email ?></p>
<p><b><?= Yii::t('app', 'телефон') ?></b><br><?= $model->phone ?></p>