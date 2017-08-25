<div class="row">
    <?= $form->field($model, 'address_ua')->textInput(['maxlength' => true, 'class' => 'offices-address form-control']) ?>

    <?= $form->field($model, 'how_we_works_ua')->textarea()->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full',
        'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
    ]) ?>
</div>