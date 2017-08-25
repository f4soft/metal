<div class="row">
    <div class="col-xs-6 clearfix">
        <?= $form->field($model, 'title_ua')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description_ua')->textarea()->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>
    </div>
    <div class="col-xs-6 clearfix">

        <?= $form->field($model, 'department_title_ua')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'requirements_ua')->textarea()->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>

    </div>
</div>