<div class="row">
    <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'article_title_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'article_description_en')->textarea()->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full',
        'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
    ]) ?>

    <?= $form->field($model, 'image_alt_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_title_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_keywords_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description_en')->textInput(['maxlength' => true]) ?>

</div>