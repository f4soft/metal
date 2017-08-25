<div class="row">
    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'article_title_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'article_description_ru')->textarea()->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full',
        'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
    ]) ?>

    <?= $form->field($model, 'image_alt_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_title_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_keywords_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description_ru')->textInput(['maxlength' => true]) ?>

</div>

