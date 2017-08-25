<?php
use \kartik\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>
    <?php if($model->isNewRecord):?>
        <?= $form->field($model, 'const_name')->textInput(['maxlength' => true]) ?>
    <?php endif;?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t("app", "Создать") : Yii::t("app", "Обновить"), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t("app", "Отменить"), ['/admin/settings'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>