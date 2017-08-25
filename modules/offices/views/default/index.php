<?php
$this->title = Yii::t('app', 'Филиалы и контакты');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'template' => "<li class='breadcrumbs-i' itemtype = 'http://schema.org/ListItem'>
            <span class='breadcrumbs-title' itemprop = 'name'>{link}</span>
            </li>"];
?>
<div class="container-fluid page-title-block margin-top-0 margin-bottom-0">
    <div class="thumb" style="background: url('<?= $head_img->getImageBg(); ?>') no-repeat center center"></div>
    <div class="container-fluid page-title-content">
        <div class="container">
            <img src="<?= $head_img->getImageCircle(); ?>" alt="" title="" class="page-icon">
            <h1 class="h1 page-title"><?= $this->title?></h1>
            <h5 class="h5 page-sub-title"><span><i class="i-holder prev"></i><?= Yii::t('app', 'Самый большой выбор металлопроката')?><i class="i-holder next"></i></span></h5>
        </div>
    </div>
</div>

<?= $this->render('@app/views/layouts/inc/breadcrumbs'); ?>

<div class="container page-name-block margin-top-0 margin-bottom-0">
    <h2 class="h2"><?= $this->title?></h2>
</div>

<div class="container about-company-info margin-top-0">
    <h2 class="h2 title underlined"><?= Yii::t('app', 'Металл холдинг')?></h2>
    <h4 class="h4 fillials-top-text"><?= $blockSettings->offices_description?></h4>
</div>

<?php if($cities):?>
    <div class="container-fluid our-filials-block margin-bottom-0">
        <h2 class="h2"><?= Yii::t('app', 'Наши филиалы')?></h2>
        <div class="interactive-map full">
            <div class="map-content">
                <img src="/img/map-ukraine.png" alt="">
                <?php foreach ($cities as $item): ?>
                    <?php $ctParam = $item->alias != 'kiev' ? $item->alias : ''; ?>

                    <div class="city-item <?=$item->alias?>">
                        <a href="<?= \yii\helpers\Url::to(["/$ctParam/offices#contacts"])?>" class="city-sticker"><i class="i-holder i-plant"></i><i class="i-holder
                        i-marker"></i><?= $item->title?></a>
                        <div class="city-info">
                            <span class="title"><?= $item->title?></span>
                            <div class="contacts">
                                <?php foreach ($item->officesByCity as $office):?>
                                    <?php if($office->is_main): ?>
                                        <p class="tel" title="<?= $office->phone?>"><span><?= Yii::t('app', 'Тел')?>:</span><?= /*\yii\helpers\StringHelper::truncate(*/$office->phone/*, 15)*/?></p>
                                        <p class="adress" title="<?= $office->address?>"><span><?= Yii::t('app', 'Адрес')?>: </span><?= /*\yii\helpers\StringHelper::truncate(*/$office->address/*, 30)*/?>
                                            <?= \kartik\helpers\Html::a(Yii::t('app', 'Подробнее') . "<i class=\"i-holder read-more-i\"></i>", \yii\helpers\Url::to(["/$ctParam/offices#contacts"]));?>
                                        </p>
                                    <?php endif;?>
                                <?php endforeach;?>

                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
<?php endif;?>


<?php if($offices):?>
    <?php foreach ($offices as $office):?>
        <?php if($office->is_main && $office->id == 1 ):?>
            <div class="container-fluid main-filial-block margin-top-0" id="contacts">
                <div class="container main-filial-wrapper">
                    <div class="row">
                        <div class="col-lg-5 main-description">
                            <h4 class="h4 title"><?= Yii::t('app', 'Главный офис')?></h4>
                            <p class="main-adress" id="main-address"><?= $office->address?></p>
                            <p class="main-tel"><?= $office->phone?></p>
                            <h5 class="h5 title"><?= Yii::t('app', 'Режим работы') ?>:</h5>
                            <p><?= $office->how_we_works ?></p>

                            <?php if( $city == 'kiev' ):?>
                                <div class="feedback-form-wrapper">
                                    <div class="feedback-form">
                                        <h4 class="h4 title"><?= Yii::t('app', 'Обратная связь')?></h4>
                                        <div class="select-wrapper">
                                            <?= \kartik\helpers\Html::dropDownList(
                                                'departments', null, \yii\helpers\ArrayHelper::map($departments, 'id', 'title'),
                                                ['class' => 'departments-select', 'prompt' => Yii::t('app', 'Выберите отдел главного офиса')])?>
                                        </div>
                                        <?php foreach ($departments as $department): ?>
                                            <div class="current-department-item di-<?= $department->id?>">
                                                <h5 class="h5 title"><?= $department->title?></h5>
                                                <?php if(strpos($department->phone, ';') !== false):?>
                                                    <?php $phones = explode(";", $department->phone);?>
                                                    <?php foreach ($phones as $phone):?>
                                                        <h4 class="h4 tel"><?= $phone?></h4>
                                                    <?php endforeach;?>
                                                <?php else:?>
                                                    <h4 class="h4 tel"><?= $department->phone?></h4>
                                                <?php endif;?>
                                                <div class="email"><span class="text">e-mail: <span><?= $department->email?></span></span></div>
                                                <div class="position-name"><span class="text"><?= Yii::t('app', 'Начальник отдела')?>: <?= $department->leader_fio?></span></div>
                                            </div>
                                        <?php endforeach;?>
                                    </div>
                                    <?= $this->render('inc/_form', ['model' => $model])?>
                                    <?= $this->render('inc/popup')?>

                                </div>
                            <?php endif;?>
                        </div>
                        <div class="col-lg-7 map-row">
                            <div class="map-wrapper">
                                <div id="map-department-<?=$office->id?>" class="map map-main"
                                     data-lat="<?=$office->lat?>" data-long="<?=$office->long?>" data-zoom="<?=$office->zoom?>"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else:?>
            <div class="container other-filials-block" id="contacts">
                <div class="row">
                    <div class="col-lg-5 other-description">
                        <h4 class="h4 title"><?= $office->address?></h4>
                        <p class="other-tel"><?= $office->phone?></p>
                        <div class="work-time">
                            <h5 class="h5 title"><?= Yii::t('app', 'Режим работы')?>:</h5>
                            <p><?= $office->how_we_works?></p>
                        </div>
                    </div>
                    <div class="col-lg-7 map-row">
                        <div class="map-wrapper">
                            <div id="map-department-<?=$office->id?>" class="map map-other"
                                 data-lat="<?=$office->lat?>" data-long="<?=$office->long?>" data-zoom="<?=$office->zoom?>"></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif;?>
    <?php endforeach;?>
<?php endif;?>

<?= $this->render('@app/views/layouts/inc/contact', ['model' => $modelContact])?>
<script>
    var map;
    var marker;
    function initMap() {
        var latLng, zoom;
        var maps = document.querySelectorAll('[id^="map-department"]');
        for (i = 0; i < maps.length; i++) {
            latLng = {lat: parseFloat(maps[i].dataset.lat), lng: parseFloat(maps[i].dataset.long)};
            zoom = parseInt(maps[i].dataset.zoom);
            map = new google.maps.Map(maps[i], {
                zoom: zoom,
                center: latLng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            marker = new google.maps.Marker({
                position: latLng,
                draggable: false,
                map: map,
                icon: '/img/map-marker.png'
            });
        }
    }

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=<?= Yii::$app->settingsConfig->settings['google_maps_key']?>&signed_in=true&callback=initMap&language=ru"></script>