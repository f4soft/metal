<?php
use yii\helpers\Url;
use yii\helpers\Html;

$title = Yii::t('app', 'Вакансии');
$formUrl = '/vacancies#vacancy-block';
$selectCity = 0;
if (!is_null($selectedCity)) {
//    $formUrl ="/". $selectedCity->alias. '/vacancies#vacancy-block';
    $selectCity = $selectedCity->id;
}

$this->params['breadcrumbs'][] = ['label' => $title, 'template' => "<li class='breadcrumbs-i' itemtype = 'http://schema.org/ListItem'>
            <span class='breadcrumbs-title' itemprop = 'name'>{link}</span>
            </li>"];
?>

<div class="container-fluid page-title-block margin-top-0 margin-bottom-0">
    <div class="thumb" style="background: url('<?= $head_img->getImageBg(); ?>') no-repeat center center"></div>
    <div class="container-fluid page-title-content">
        <div class="container">
            <img src="<?= $head_img->getImageCircle(); ?>" alt="" title="" class="page-icon">
            <h1 class="h1 page-title"><?= $title?></h1>
            <h5 class="h5 page-sub-title"><span><i class="i-holder prev"></i><?= Yii::t('app', 'Самый большой выбор металлопроката')?><i class="i-holder next"></i></span></h5>
        </div>
    </div>
</div>

<?= $this->render('@app/views/layouts/inc/breadcrumbs'); ?>

<div class="container page-name-block margin-top-0 margin-bottom-0">
    <h2 class="h2"><?= $this->title?></h2>
</div>

<div class="container vacancy-title margin-top-0 margin-bottom-0">
    <h4 class="h4"><?= $block_settings->vacancy_description?></h4>
</div>

<?php if($block_settings->vacancy_offer_description):?>
    <?= $block_settings->vacancy_offer_description?>
<?php endif;?>
<div class="container vacancy-block" id="vacancy-block">
    <div class="vacancy-block-header">
        <span class="header-title"><?= Yii::t('app', 'Список вакансий') ?></span>
        <?php \yii\bootstrap\ActiveForm::begin([
            'action' => Url::to([$formUrl])
        ]); ?>
        <div class="select-wrapper">
            <?= \kartik\helpers\Html::dropDownList(
                'city', $selectCity, \yii\helpers\ArrayHelper::map($cities, 'id', 'title'),
                ['class' => 'city-select', 'prompt' => Yii::t('app', 'Выберите город'), 'onchange' => 'this.form.submit()']) ?>
            <?php \yii\bootstrap\ActiveForm::end(); ?>
        </div>

    </div>
<?php if($vacancies):?>
        <div class="panel-group accordeon-block vacancy-list" id="accordion-vacancies">
            <?php $idS = '';?>
            <?php foreach ($vacancies as $vacancy):?>
                <?php if (isset($error) && $error && $error == $vacancy->id): ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="h2 panel-title">
                                <a data-toggle="collapse" data-parent="#accordion-vacancies" href="#collapse<?=$vacancy->id?>">
                                    <span class="position"><?= \yii\helpers\StringHelper::truncate($vacancy->title, 100)?> </span>
                                    <span class="department"><?= \yii\helpers\StringHelper::truncate($vacancy->department_title, 100)?></span>
                                    <span class="city"> <?= !is_null($vacancy->city) ?'г.'. $vacancy->city->title : ''?></span>
                                    <button class="btn send-resume"><?= Yii::t('app', 'Отправить резюме')?></button>
                                </a>
                            </h2>
                        </div>
                        <div id="collapse<?=$vacancy->id?>" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div class="col-lg-7">
                                    <h5 class="h5 department"><?= Yii::t('app', 'Подразделение')?>: <?= \yii\helpers\StringHelper::truncate($vacancy->department_title, 100)?></h5>
                                    <h5 class="h5 subtitle"><?= Yii::t('app', 'Требования')?>:</h5>
                                    <div class="text"><?= $vacancy->requirements?></div>
                                    <h5 class="h5 subtitle"><?= Yii::t('app', 'Функциональные обязанности')?>:</h5>
                                    <div class="text"><?= $vacancy->description?></div>
                                </div>
                                <div class="col-lg-5">
                                    <?= $this->render('inc/_form', ['model'=>$model, 'vacancyID' => $vacancy->id])?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        location.href = "#";
                        location.href = "#collapse" + <?php echo $vacancy->id?>;
                    </script>
                <?php else: ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="h2 panel-title">
                                <a data-toggle="collapse" data-parent="#accordion-vacancies" href="#collapse<?=$vacancy->id?>" class="collapsed">
                                    <span class="position"><?= \yii\helpers\StringHelper::truncate($vacancy->title, 100)?> </span>
                                    <span class="department"><?= \yii\helpers\StringHelper::truncate($vacancy->department_title, 100)?></span>
                                    <span class="city"><?= !is_null($vacancy->city) ? 'г.' .$vacancy->city->title : ''?></span>
                                    <button class="btn send-resume"><?= Yii::t('app', 'Отправить резюме')?></button>
                                </a>
                            </h2>
                        </div>
                        <div id="collapse<?=$vacancy->id?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="col-lg-7">
                                    <h5 class="h5 department"><?= Yii::t('app', 'Подразделение')?>: <?= \yii\helpers\StringHelper::truncate($vacancy->department_title, 100)?></h5>
                                    <h5 class="h5 subtitle"><?= Yii::t('app', 'Требования')?>:</h5>
                                    <div class="text"><?= $vacancy->requirements?></div>
                                    <h5 class="h5 subtitle"><?= Yii::t('app', 'Функциональные обязанности')?>:</h5>
                                    <div class="text"><?= $vacancy->description?></div>
                                </div>
                                <div class="col-lg-5">
                                    <?= $this->render('inc/_form', ['model'=>$model, 'vacancyID' => $vacancy->id])?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
                <?php $idS .= $vacancy->id . ',';?>
            <?php endforeach;?>
            <?php $idS = !empty($idS)? trim($idS, ','):'';?>
        </div>
        <?= $this->render('inc/popup')?>
    <script type="text/javascript">
        var string = "<?php echo $idS?>";
        var array = string.split(',');
        var onloadCallback = function () {
            for (var i = 0; i < array.length; i++) {
                if ($('#captcha-' + array[i]).length) {
                    grecaptcha.render('captcha-' + array[i], {
                        'sitekey': "<?php echo Yii::$app->params['recaptchaSiteKey']?>",
                        'type': 'image'
                    });
                }
            }
        };
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=<?php echo yii\helpers\BaseStringHelper::byteSubstr(\Yii::$app->language, 0, 2) ?>"
            async defer>
    </script>
<?php else: ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="h4 panel-title">
                В этом городе открытых вакансий на данный момент нет
            </h4>
        </div>
    </div>
<?php endif;?>
</div>

<?php $image = $block_settings->getBlockSettingsImage($block_settings->vacancies_banner,945,81) ?>
<?php if ($image):?>
<div class="container-fluid banner-small-block">
    <img src="<?=$image?>">
</div>
<?php endif; ?>

