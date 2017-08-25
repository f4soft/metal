<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = Yii::t('app/admin', 'Импорт');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 id="page-title"><?= \kartik\helpers\Html::encode($this->title) ?></h1>
<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-check"></i>Сохранено!</h4>
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('danger')): ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-check"></i>Ошибка!</h4>
        <?= Yii::$app->session->getFlash('danger') ?>
    </div>
<?php endif; ?>

<div class="form-group">
    <div class="row">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'action'=>'/admin/import/import-cities']) ?>
        <div class="form-group">
            <div class="col-md-4">
                <?= $form->field($model, 'cities')->fileInput()->label('Импорт городов')->widget
                (\kartik\widgets\FileInput::classname(), [
                    'options' => ['accept' => '.xml'],
                    'pluginOptions' => [
                        'showRemove' => true,
                        'showUpload' => false,
                        'showCaption' => true,
                        'showPreview' => false,
                    ]
                ]); ?>

                <button class="btn btn-default">Загрузить список городов</button>

            </div>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <form action=""></form>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'action' => '/admin/import/import-categories']) ?>
        <div class="form-group">
            <div class="col-md-4">
                <?= $form->field($model, 'categories')->fileInput()->label('Импорт категорий')->widget
                (\kartik\widgets\FileInput::classname(), [
                    'options' => ['accept' => '.xml'],
                    'pluginOptions' => [
                        'showRemove' => true,
                        'showUpload' => false,
                        'showCaption' => true,
                        'showPreview' => false,
                    ]
                ]); ?>

                <button class="btn btn-default">Загрузить список категорий</button>

            </div>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'action' => '/admin/import/upload-products']) ?>
        <div class="form-group">
            <div class="col-md-4">
                <?= $form->field($model, 'products')->fileInput()->label('Импорт товаров')->widget
                (\kartik\widgets\FileInput::classname(), [
                    'options' => ['accept' => '.xml'],
                    'pluginOptions' => [
                        'showRemove' => true,
                        'showUpload' => false,
                        'showCaption' => true,
                        'showPreview' => false,
                    ]
                ]); ?>
                
                <button class="btn btn-default" id="visible_submit" onClick="submitProduct(); return false;">Загрузить список товаров</button>               
                <?= Html::submitButton('Button Submit', ['style' => 'display: none;', 'class' => 'btn btn-hidden', 'id'=>'submit_id']) ?>
                
            </div>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>

<?php $this->registerJsFile("@web/js/import.js",['depends' => [\yii\web\JqueryAsset::className()]]); ?>