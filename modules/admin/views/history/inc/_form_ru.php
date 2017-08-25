<div class="row">
    <?= $form->field($model, 'description_ru',['template' => "{label}{input}<p class=\"help-block\">Максимальное колличество символов - 270</p>"])->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_alt_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_title_ru')->textInput(['maxlength' => true]) ?>
</div>

