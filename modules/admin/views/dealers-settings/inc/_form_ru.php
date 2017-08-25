<div class="row">

    <?= $form->field($model, 'dealers_title_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dealers_page_description_ru')->textarea()
        ->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>

</div>

