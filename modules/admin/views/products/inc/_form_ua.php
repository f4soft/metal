<div class="row">
    <?= $form->field($model, 'title_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'article_title_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'article_description_ua')->textarea()->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full',
        'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
    ]) ?>

    <?= $form->field($model, 'image_alt_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_title_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_keywords_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description_ua')->textInput(['maxlength' => true]) ?>

</div>