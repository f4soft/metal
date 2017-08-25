<div>
    <p>Email: <?= $model->email?></p>
    <p><?= Yii::t('app', 'Имя')?>: <?= $model->name?></p>
    <p><?= Yii::t('app', 'Телефон')?>: <?= $model->phone?></p>
    <p><?= $model->message?></p>
    <p><?= Yii::t('app', 'Дата')?>: <?= Yii::$app->formatter->asDate($model->created_at)?></p>
</div>
