<div class="row">
    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description_ru')->textarea()->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full',
        'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
    ]) ?>

    <?= $form->field($model, 'small_image_alt_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'small_image_title_ru')->textInput(['maxlength' => true]) ?>
</div>