<?php
$title = Yii::t('app','О компании');
$this->params['breadcrumbs'][] = ['label' => $title, 'template' => "<li class='breadcrumbs-i' itemtype = 'http://schema.org/ListItem'>
            <span class='breadcrumbs-title' itemprop = 'name'>{link}</span>
            </li>"];
?>
<div class="container-fluid page-title-block margin-top-0 margin-bottom-0">
    <div class="thumb" style="background: url('<?= $head_img->getImageBg(); ?>') no-repeat center center"></div>
    <div class="container-fluid page-title-content">
        <div class="container">
            <img src="<?= $head_img->getImageCircle(); ?>" alt="" title="" class="page-icon">
            <h1 class="h1 page-title"><?= $title;?></h1>
            <h5 class="h5 page-sub-title"><span><i class="i-holder prev"></i><?= Yii::t('app', 'Самый большой выбор металлопроката')?><i class="i-holder next"></i></span></h5>
        </div>
    </div>
</div>

<?= $this->render('@app/views/layouts/inc/breadcrumbs'); ?>

<div class="container page-name-block margin-top-0 margin-bottom-0">
    <h2 class="h2"><?= $title?></h2>
</div>

<div class="container about-company-info">
    <h2 class="h2 title underlined"><?= Yii::t('app', 'Металл-холдинг');?></h2>
    <div class="text"><?= $block_settings->about_main_description?></div>
    <div class="row">
        <div class="col-lg-7">
            <div class="info-item mission-item">
                <h2 class="h2 title underlined"><i class="i-holder"></i><?= Yii::t('app', 'Наша миссия')?></h2>
                <div class="text"><?= $block_settings->about_mission_description?></div>
            </div>
            <div class="info-item goals-item">
                <h2 class="h2 title underlined"><i class="i-holder"></i><?= Yii::t('app', 'Наша стратегия')?></h2>
                <div class="text"><?= $block_settings->about_strategy_description?></div>
            </div>
        </div>
        <?php if(!empty($poll) && !empty($answers)):?>
            <?= $this->render('@app/views/about/inc/pool', ['poll' => $poll, 'answers' => $answers,]); ?>
        <?php endif;?>
    </div>
</div>

<?php if($block_settings->our_goal_description):?>
    <?= $block_settings->our_goal_description ?>
<?php endif;?>

<?php if($ourValues):?>
    <div class="container our-values-block" id="values">
        <h2 class="h2 stripped-title"><span><?= Yii::t('app', 'Наши ценности')?></span></h2>
        <?php  $imageModel = new \app\models\ImageUpload(\app\models\OurValues::tableName());?>
        <?php foreach ($ourValues as $k => $value):?>
            <div class="value-item item<?=$k+1?>">
                <span class="icon">
                    <?= \kartik\helpers\Html::img("/".$imageModel->getImage($value, Yii::$app->params['imagePresets']['our-values']['main'], 'view', 'image'), ['alt' => '', 'title' => ''])?>
                </span>
                <span class="text"><span class="inner-text"><?= $value->title ?></span></span>
                <span class="sub-text"><?= $value->description ?></span>
            </div>
        <?php endforeach;?>
    </div>
<?php endif;?>

<?php if($histories):?>
    <div class="container-fluid our-history-block" id="history">
        <div class="container">
            <h2 class="h2"><?= Yii::t('app', 'Наша история')?></h2>
            <div class="our-history-carousel">
                <?php  $imageModel = new \app\models\ImageUpload(\app\models\History::tableName());?>
                <?php foreach ($histories as $history):?>
                    <div class="col-lg-6 col-md-6 col-sm-6 item" year="<?= $history->title?>">
                        <h2 class="h2 stripped-title year"><span><?= $history->title?></span></h2>
                        <p class="text"><?= \yii\helpers\StringHelper::truncate($history->description, 280)?></p>
                        <?= \kartik\helpers\Html::img("/".$imageModel->getImage($history, Yii::$app->params['imagePresets']['history']['aboutPage'], 'view', 'image'), ['alt' => $history->image_alt, 'title' => $history->image_title])?>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
<?php endif;?>

<?php if($employes):?>
    <div class="container our-employee-block">
        <h2 class="h2 stripped-title"><span><?= Yii::t('app', 'Наши сотрудники')?></span></h2>
        <div class="our-employee-carousel">
            <?php  $imageModel = new \app\models\ImageUpload(\app\models\Team::tableName());?>
            <?php foreach ($employes as $employee):?>
                <div class="col-lg-3 item">
                    <?= \kartik\helpers\Html::img("/".$imageModel->getImage($employee, Yii::$app->params['imagePresets']['team']['slider'], 'view', 'image'), ['alt' => $employee->image_alt, 'title' => $employee->image_title])?>
                    <div class="initials">
                        <p class="surname"><?= $employee->lname?></p>
                        <p class="name"><?= "{$employee->fname} {$employee->sname}"?></p>
                    </div>
                    <p class="position"><?= $employee->position?></p>
                    <div class="contacts">
                        <div class="c-email"><span class="pre">E-mail:</span><?= $employee->email?></div>
                        <div class="c-work-number"><span class="pre"><?= Yii::t('app', 'Раб. тел')?>:</span><?= $employee->work_phone?></div>
                        <div class="c-personal-number"><span class="pre"><?= Yii::t('app', 'Моб. тел')?>:</span><?= $employee->mobile_phone?></div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
<?php endif;?>

<?php if($cities):?>
    <div class="container-fluid our-filials-block">
        <h2 class="h2"><?= Yii::t('app', 'Наши филиалы')?></h2>
        <div class="interactive-map full">
            <div class="map-content">
                <a href="<?= \yii\helpers\Url::to(["/offices"]) ?>">
                <img src="/img/map-ukraine.png" alt="">
                <?php foreach ($cities as $city): ?>
                    <?php $ctParam = $city->alias != 'kiev' ? $city->alias : ''; ?>

                    <div class="city-item <?=$city->alias?>">
                        <a href="<?= \yii\helpers\Url::to(["/$ctParam/offices#contacts"])?>" class="city-sticker"><i class="i-holder i-plant"></i><i class="i-holder
                        i-marker"></i><?= $city->title?></a>
                        <div class="city-info">
                            <span class="title"><?= $city->title?></span>
                            <div class="contacts">
                                <?php foreach ($city->officesByCity as $office):?>
                                    <?php if($office->is_main): ?>
                                        <p class="tel"><span><?= Yii::t('app', 'Тел')?>:</span><?= $office->phone?></p>
                                        <p class="adress"><span><?= Yii::t('app', 'Адрес')?>: </span><?= $office->address?>
                                            <?= \kartik\helpers\Html::a(Yii::t('app', 'Подробнее') . "<i class=\"i-holder read-more-i\"></i>", \yii\helpers\Url::to(["/$ctParam/offices#contacts"]));?>
                                        </p>
                                    <?php endif;?>
                                <?php endforeach;?>

                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
                </a>
            </div>
        </div>
    </div>
<?php endif;?>

<?php if($reports):?>
    <div class="container our-reports-block">
        <div class="panel-group accordeon-block" id="accordion-reports">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="h2 panel-title">
                        <a data-toggle="collapse" data-parent="#accordion-reports" href="#collapseOne" class="collapsed"><?= Yii::t('app', 'Наши отчеты')?></a>
                    </h2>
                </div>
                <div id="collapseOne" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="reports-list">
                            <?php foreach ($reports as $report):?>
                                <li>
                                    <?= \kartik\helpers\Html::a(\yii\helpers\StringHelper::truncate($report->title, 200), \yii\helpers\Url::to(["/uploads/reports/{$report->file}"]), ['target' => '_blank']);?>
                                </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>

<?= $this->render('@app/views/catalog/inc/catalog-block', ['selectedCity' => $selectedCity, 'blockSettings' => $blockSettings]);?>

<?= $this->render('@app/views/layouts/inc/contact', ['model' => $modelContact])?>
<?= $this->render('@app/views/layouts/inc/popup_contact')?>