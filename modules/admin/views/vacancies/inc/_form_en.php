<div class="row">
    <div class="col-xs-6 clearfix">
        <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description_en')->textarea()->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>
    </div>
    <div class="col-xs-6 clearfix">

        <?= $form->field($model, 'department_title_en')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'requirements_en')->textarea()->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>

    </div>
</div>

