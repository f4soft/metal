<div class="row">
    <?= $form->field($model, 'description_ua', ['template' => "{label}{input}<p class=\"help-block\">Максимальное колличество символов - 270</p>"])->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_alt_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_title_ua')->textInput(['maxlength' => true]) ?>
</div>
