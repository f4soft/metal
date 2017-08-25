<div class="row">
    <?= $form->field($model, 'description_en',
        ['template' => "{label}{input}<p class=\"help-block\">Максимальное колличество символов - 270</p>",]
    )->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_alt_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_title_en')->textInput(['maxlength' => true]) ?>
</div>