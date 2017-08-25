<?php


$this->title = Yii::t("app", "Настройки");

$detailedColumns = [
    [
        'attribute' => 'name',
    ],
    [
        'attribute' => 'value',
    ],
    [
        'class' => '\kartik\grid\ActionColumn',
        'template' => "{update}&nbsp{delete}",
    ]
];
?>
<div class="user-view">
    <h1><?= \kartik\helpers\Html::encode($this->title) ?></h1>
    <?=
    \kartik\grid\GridView::widget([
        'dataProvider'=> $dataProvider,
        'columns' => $detailedColumns,
        'responsive'=>true,
        'hover'=>true,
        'resizableColumns' => false
    ]);
    ?>
    <span class="clearfix"></span>

</div>