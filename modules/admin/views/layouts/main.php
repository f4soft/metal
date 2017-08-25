<?php

use yii\helpers\Html;

\app\assets\AdminAsset::register($this);
dmstr\web\AdminLteAsset::register($this);
$directoryAsset = Yii::$app->assetManager->getPublishedUrl("@bower/admin-lte/dist");
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="<?= \dmstr\helpers\AdminLteHelper::skinClass() ?>">
<?php $this->beginBody() ?>

<div class="wrap">
    <?= $this->render('header');?>
    <?= $this->render(
        'left',
        ['directoryAsset' => $directoryAsset]
    )
    ?>
    <?= $this->render('content', ['content' => $content]);?>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
