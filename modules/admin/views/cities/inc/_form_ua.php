<div class="row">
    <div class="col-xs-6 clearfix">
        <?= $form->field($model, 'title_ua')->textInput(['maxlength' => true]) ?>
                
        <?= $form->field($model, 'cat_description_ua')->textarea(['rows' => 3]) ?>
    
        <?= $form->field($model, 'sub_cat_description_ua')->textarea(['rows' => 3]) ?>
    
        <?= $form->field($model, 'product_description_ua')->textarea(['rows' => 3]) ?>
    </div>
</div>
