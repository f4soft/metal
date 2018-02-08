<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = Yii::t('app/admin', 'Добавить ссылку для ').$category->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'Category Links'), 'url' => ['index', 'category_id' => $category->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-create">

    <h1><?= Html::encode($this->title) ?></h1>  

    <?php $form = ActiveForm::begin(['action' =>['/admin/categories-link/update', 'id' => $model->id], 'method' => 'post']); ?>
        
    <div class="form-group">
        <label class="control-label" for="categories"><?= Yii::t('app/admin', 'Родительская категория') ?></label>
        <select id="categoryRoot" name="categoryRoot" class="form-control">
            <option value=""><?= Yii::t('app/admin', 'Выберите категорию') ?></option>
            <?php foreach($menuMain as $main):?>
                <option value="<?= $main->id?>" <?= $main->id == $dataRequest['categoryRoot'] ? " selected " : "" ?>><?= $main->title ?></option>
            <?php endforeach;?>
        </select>        
    </div>
        
    <?= $form->field($model, 'category_id')->dropDownList(array(), ['id'=>'subcategories']); ?>
    
    <?= $form->field($model, 'status')->checkbox(); ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app/admin', 'Создать') : Yii::t('app/admin', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app/admin', 'Отменить'), ['/admin/categories-link/index', 'category_id' => $category->id], ['class' => 'btn btn-default']);?>
    </div>
    
    <?php ActiveForm::end(); ?>
    
</div>

<?php $this->registerJs('

    $(document).ready(function(){
        
        var local = "'.$category::$lang.'";
        var category_root_id = $("#categoryRoot").val();
        var category_exist_id = '.$model->category_id.';

        $("#categoryRoot").change(function(){
            refreshSubCategory(local, $(this).val(), 0);
        });
console.log(category_exist_id);                
        refreshSubCategory(local, category_root_id, category_exist_id);
        
    });
    
    function refreshSubCategory(local, category_root_id, category_exist_id)
    {
        $.ajax({
            url: "'. \yii\helpers\Url::to(["/admin/categories-link/get-sub-category"]) .'",
            method: "POST",
            data: { category_id : category_root_id, _csrf : "'. \Yii::$app->request->getCsrfToken() .'" },
            dataType: "json",
            beforeSend : function() {
                $("#subcategories").attr("disabled", true);
                $("#subcategories").html("");
            },
            success : function(data){
                                
                var htmlOption = "";
                
                if(data){
                    $.each(data.categories, function(key, category){
                        htmlOption += "<option value=\""+category.id+"\" "+(category_exist_id == category.id ? " selected " : "")+">"+category[("title_"+local)]+"</option>";
                    });
                }
                
                $("#subcategories").attr("disabled", false);
                $("#subcategories").html(htmlOption);
            },
            error: function(data){
                $("#subcategories").attr("disabled", false);
            }
        });
    }

'); ?>