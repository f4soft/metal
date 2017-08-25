<div class="row">
    <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description_en')->textarea()->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full',
        'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
    ]) ?>

    <?= $form->field($model, 'meta_keywords_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description_ua')->textInput(['maxlength' => true]) ?>
</div>

