<?php
use kartik\helpers\Html;
$title = Yii::t('app', 'Оформление заказа');
$this->params['breadcrumbs'][] = ['label' => $title, 'template' => "<li class='breadcrumbs-i' itemtype = 'http://schema.org/ListItem'>
            <span class='breadcrumbs-title' itemprop = 'name'>{link}</span>
            </li>"];
?>
<?= $this->render('@app/views/layouts/inc/breadcrumbs'); ?>

<div class="container page-name-block margin-top-0 margin-bottom-0">
    <h2 class="h2"><?= Yii::t('app', 'Оформление заказа')?></h2>
</div>

<div class="container-fluid order-checkout-block">
    <div class="container">
        <div class="col-lg-6 col-md-6 order-forms-col">
            <div class="form-wrapper">
                <div class="col-lg-6 col-md-6 customer-type new active"><a href="#newUser" class="new-cusomer-btn"
                                                                  data-toggle="tab"><?= Yii::t('app', 'Я новый покупатель') ?></a></div>
                <div class="col-lg-6 col-md-6 customer-type old non-active"><a href="#oldUser" class="old-cusomer-btn"
                                                                      data-toggle="tab"><?= Yii::t('app', 'Я постоянный клиент') ?></a></div>
                <div class="tab-content">
                    <div class="col-lg-12 col-md-12 start-form form-inner fade in tab-pane active yur-fiz-form" id="newUser">
                        <!--<a href="" class="registration-btn as-yur" data-type="yur"><= Yii::t('app', 'Зарегистрироваться как юридическое лицо') ?></a>
                        <a href="" class="registration-btn as-fiz" data-type="fiz"><= Yii::t('app', 'Зарегистрироваться как физическое лицо') ?></a>-->

                        <form action="" class="form has-custom-checkboxes" style="/*display: none*/" id="reg-form">
                            <!--<div class="select-wrapper">
                                <span class="select-label"><= Yii::t('app', 'выберите тип регистрации') ?></span>
                                <select name="form-type" id="form-type" class="fiz yur select-type-user">
                                    <option value="fiz"><= Yii::t('app', 'Физическое лицо') ?></option>
                                    <option value="yur"><= Yii::t('app', 'Юридическое лицо') ?></option>
                                </select>
                            </div>-->
                            <input type="hidden" class="select-type-user" name="" value="general-user-type">
                            <label for="name" class="label fiz-fileds visible">
                                <span><?= Yii::t('app', 'Имя и Фамилия') ?>*</span>
                                <input type="text" name="name" id="name" class="input-text fiz general-user-type">
                            </label>
                            <label for="company-name" class="label yur-fileds /*hidden*/">
                                <span><?= Yii::t('app', 'Название компании')?></span>
                                <input type="text" name="company" id="company" class="input-text yur general-user-type">
                            </label>
                            <!--<label for="company-adress" class="label yur-fileds hidden">
                                <span><= Yii::t('app', 'Адрес')?></span>
                                <input type="text" name="city" id="city" class="input-text yur">
                            </label>-->
                            <label for="company-kod-okpo" class="label yur-fileds general-user-type/*hidden*/">
                                <span><?= Yii::t('app', 'Код ЕДРПОУ')?></span>
                                <input type="text" name="okpo" id="okpo" class="input-text yur general-user-type">
                            </label>
                            <!--<label for="company-kod-inn" class="label yur-fileds hidden">
                                <span><= Yii::t('app', 'Код ИНН')?></span>
                                <input type="text" name="inn" id="inn" class="input-text yur">
                            </label>-->
                            <label for="city" class="label fiz-fileds visible">
                                <span><?= Yii::t('app', 'Город')?>*</span>
                                <input type="text" name="city" id="city" class="input-text fiz general-user-type">
                            </label>
                            <label for="email" class="label visible">
                                <span><?= Yii::t('app', 'Email')?>*</span>
                                <input type="email" name="email" id="email" class="input-text fiz yur general-user-type">
                            </label>
                            <label for="tel" class="label visible">
                                <span><?= Yii::t('app', 'Мобильный телефон')?>*</span>
                                <input type="text" name="phone" id="phone" class="input-text fiz yur general-user-type">
                            </label>
                            <label for="add-info" class="label">
                                <span><?= Yii::t('app', 'Примечание к заказу')?></span>
                                <textarea name="message" id="message" cols="30" rows="10" class="textarea fiz yur general-user-type"></textarea>
                            </label>
                            <input type="hidden" name="user" value="new" class="fiz yur general-user-type">
                            <input type="checkbox" name="subscribe" id="subscribe" class="fiz yur general-user-type">
                            <label for="subscribe" class="label-subscribe-to-news">
                                <?= Yii::t('app', 'Подписаться на новости и акции')?></label>
                            <label class="label label-notifi-left">* <?= Yii::t('app', 'значит что поле обязательное')?></label>
                        </form>
                    </div>
                    <div class="col-lg-12 exist-user form-inner tab-pane fade" id="oldUser">
                        <form action="" class="form has-custom-checkboxes" id="log-form">
                            <label for="user-login" class="label">
                                <span><?= Yii::t('app', 'Логин')?></span>
                                <input type="text" name="login" id="login" class="input-text">
                            </label>
                            <label for="user-password" class="label">
                                <span><?= Yii::t('app', 'Пароль')?></span>
                                <input type="password" name="password" id="password" class="input-text">
                            </label>
                            <input type="hidden" name="user" value="old">
                            <button type="submit" class="submit" name="login-btn" id="login-btn"><?= Yii::t('app', 'Войти')?></button>
                            <p><a href="" id="reset_link"><?= Yii::t('app', 'Забыли пароль?') ?></a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 order-body-col">
            <?= $this->render('@app/views/checkout/inc/order-table', ['data' => $data]); ?>
        </div>
        <div class="col-lg-12 col-md-12" class="link-holder">
            <a href="#" class="btn order-confirm"><?= Yii::t('app', 'Оформить заказ')?></a>
        </div>
    </div>
</div>
<?= $this->render('@app/views/checkout/inc/popup_success'); ?>