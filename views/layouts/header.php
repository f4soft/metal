<?php
use app\models\Forms\CallbackForm;
use kartik\helpers\Html;
use \app\models\Offices;
use \app\models\Cities;
use \app\models\CartProducts;
use \app\components\Helper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$count = CartProducts::getCartCounter() ? : 0;
$city = \Yii::$app->request->get('city');
$selectedCity = $city ? Cities::getByAlias($city) : Cities::getDefaultCity();
$cities = Cities::getAll();
$lang = Yii::$app->params['langs'][Yii::$app->language];
if (!empty($selectedCity->alias) && $selectedCity->alias == 'kiev') {
    $offices = Offices::find()->
    where(['city_id' => $selectedCity->id, 'status' => 1, 'is_main'=>0])->all();
} else {
    $offices = Offices::find()->
    where(['city_id' => $selectedCity->id, 'status' => 1])->
    orderBy('is_main DESC')->one();
}

//$baseUrl = substr(\Yii::$app->request->getUrl(), 3) ;
$baseUrl = \Yii::$app->request->getUrl() ;
if (!$selectedCity->is_default) {
    $baseUrl = str_replace('/'.$selectedCity->alias, '', $baseUrl);
}
$modelCallback = new CallbackForm();
?>
<div class="header-block">
    <!-- extra top navbar -->
    <nav class="navbar extra-top-navbar">
        <div class="container">
            <ul class="nav navbar-nav pull-right" >
                <li class="disabled city-title"><span><?= Yii::t('app', 'Ваш регион')?></span></li>
                <li class="city-wrapper dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                        <?= $selectedCity->title ? $selectedCity->title : Yii::t('app', 'город')?>
                        <span class="glyphicon glyphicon-menu-down"></span></button>
                    <ul class="dropdown-menu">
                        <?php foreach ($cities as $city):?>
                            <?php
//                                $url = ($city->is_default) ? $baseUrl : $city->alias. $baseUrl;
                                $url = ($city->is_default) ? '' : $city->alias;
                                $liClass = null;
                                $link_options['class'] = null;
                                if ($selectedCity->alias == $city->alias) {
                                    $liClass = 'active';
                                    $link_options['class'] = 'active';
                                }
                            ?>
                            <li class="<?= $liClass ?>"><?= Html::a($city->title, \yii\helpers\Url::to(["/$url"]),
                                    $link_options)?>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </li>
                <li class="lang-wrapper dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                        <?= $lang ? $lang : Yii::t('app', 'язык');?>
                        <span class="glyphicon glyphicon-menu-down"></span></button>
                    <ul class="dropdown-menu">
                        <?php
                            $lang_url[] = str_replace("/{$lang}",'/', Yii::$app->request->url);?>
                        <?php foreach (Yii::$app->params['langs'] as $key => $value): ?>
                            <?php /*if ($key!='ru-RU') continue*/;?>
                            <?php $lang_url['language'] = $key;?>
                            <?php $link_options['class'] = null;
                            $liClass = null;?>
                            <?php if($key==Yii::$app->language) {
                                $link_options['class'] = 'active';
                                $liClass = 'active';
                            }
                            ?>
                            <li class="<?= $liClass ?>"><?= Html::a($value, $lang_url, $link_options) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="callback-form-wrapper">
                    <button type="button" class="btn call-us-btn" data-toggle="dropdown" data-target="#call-us">
                        <i class="i-holder"></i>
                        <?= Yii::t('app', 'Позвонить нам') ?>
                    </button>
                    <div class="dropdown-menu callback-form-block">
                        <?php  $callBackForm = ActiveForm::begin([
                            'id' => 'header-contact-form',
                            'enableAjaxValidation' => true,
                            'options' => ['class' => 'form callback-form'],
//                            'action' => Url::to('site/callback')
                        ]) ?>
                        <h4 class="h4 title"><?= Yii::t('app', 'Заказать обратный звонок') ?></h4>
                        <?= $callBackForm->field($modelCallback, 'name')
                            ->textInput(['placeholder'=>Yii::t('app', 'Ваше имя..'), 'class'=>'input-text'])
                            ->label(false) ?>
                        <?= $callBackForm->field($modelCallback, 'email')->textInput(['placeholder'=> Yii::t
                        ('app', 'Ваш Email..')])->label(false) ?>
                        <?= $callBackForm->field($modelCallback, 'phone')->textInput(['placeholder'=> Yii::t
                        ('app', 'Номер телефона..')])->label(false) ?>
                        <?= $callBackForm->field($modelCallback, 'time')
                            ->textInput(['placeholder'=> Yii::t('app', 'Удобное для звонка время')])->label(false) ?>
                        <?= $callBackForm->field($modelCallback, 'message')->textarea
                        (['placeholder'=> Yii::t('app', 'Примечание')])->label(false) ?>
                        <?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'submit']) ?>
                        <?php ActiveForm::end() ?>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- header content block -->
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="logo-wrapper pull-left"><a href="<?= \yii\helpers\Url::to(["/$currentСity/"])?>"><img src="/img/logo.png" alt="логотип" title="логотип"></a></div>
                <div class="company-tagline pull-left"><?= Yii::t('app', '<p>Самый</p><p>Большой выбор</p><p>Металлопроката</p>')?></div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="h-current-city">
                    <?php if (!empty($offices) && !empty($selectedCity)): ?>
                        <p class="c-s-item title"><?= $selectedCity->title ?></p>
                    <?php if ($selectedCity->alias == 'kiev'): ?>
                            <p class="c-s-item">
                            <?php $c = -1 ?>
                            <?php foreach ($offices as $office): ?>
                                <?php $c++ ?>
                                <span><?= str_repeat('&nbsp;', $c*4) ?><?= str_replace('г. Киев, ','',
                                        $office->address)?>
                                    : <?= $office->phone
                                    ?></span><br>
                            <?php endforeach; ?>
                            </p>
                    <?php else: ?>
                            <p class="c-s-item"><?= $offices->address ?> : <br> <?= $offices->phone ?></p>
                    <?php endif; ?>
                    <?php endif;?>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 h-cart-wrapper">
                <div class="h-cart active">
                    <a href="#"><span class="pull-left h-cart-text"><?= Yii::t('app', 'В КОРЗИНЕ')?>:<br><span class="cart-count"><?= $count?></span> <span
                                    class="cart-word"><?= Helper::getWord($count, [Yii::t('app', 'товар'), Yii::t('app', 'товара'), Yii::t('app', 'товаров')]) ?></span></span><span class="pull-right h-cart-icon"><i class='i-holder'></i></span></a>
                </div>

            </div>
        </div>
    </div>

    <!-- top main navbar -->
    <?= $this->render('menu', ['currentСity' => $currentСity])?>
</div>
