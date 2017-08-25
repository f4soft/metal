<div class="row">
    <?= $form->field($model, 'title_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description_ua')->textarea()->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full',
        'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
    ]) ?>

    <?= $form->field($model, 'small_image_alt_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'small_image_title_ua')->textInput(['maxlength' => true]) ?>
</div>