<div class="row">

    <?= $form->field($model, 'dealers_title_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dealers_page_description_en')->textarea()
        ->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'clientOptions' => require(Yii::getAlias("@app/config/ckeditor.php"))
        ]) ?>

</div>

