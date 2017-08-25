<?php
use yii\helpers\Url;
$lang = Yii::$app->params['langs'][Yii::$app->language];
$host = Yii::$app->request->hostInfo;
function makeUrl($url)
{
    $selectedСity = \Yii::$app->request->get('city');
    $url = !empty($selectedСity)? '/' . $selectedСity . '/' . $url: '/' .$url;
    return Url::to([$url]);
}
?>
<footer class="footer">
    <div class="container footer-menu">
        <ul class="list-first">
            <li>
                <a href="<?= makeUrl('about')?>"><?= Yii::t('app', 'О компании')?></a>
                <ul class="list-second">
                    <li><a href="<?= makeUrl('about')?>"><?= Yii::t('app', 'О компании') ?></a></li>
                    <li><a href="<?= makeUrl('about')?>"><?= Yii::t('app', 'Цели') ?></a></li>
                    <li><a href="<?= makeUrl('about#values')?>"><?= Yii::t('app', 'Ценности') ?></a></li>
                    <li><a href="<?= makeUrl('about#history')?>"><?= Yii::t('app', 'История компании') ?></a></li>
                    <li><a href="<?= makeUrl('vacancies')?>"><?= Yii::t('app', 'Вакансии') ?></a></li>
                </ul>
            </li>
            <li>
                <a href="<?= makeUrl('services')?>"><?= Yii::t('app', 'Услуги') ?></a>
                <ul class="list-second">
                    <li><a href="<?= makeUrl('services#service1')?>"><?= Yii::t('app', 'Доставка продукции') ?></a></li>
                    <li><a href="<?= makeUrl('services#service2')?>"><?= Yii::t('app', 'Порезка металла') ?></a></li>
                    <li><a href="<?= makeUrl('services#service3')?>"><?= Yii::t('app', 'Механическая обработка металла') ?></a></li>
                    <li><a href="<?= makeUrl('services#service4')?>"><?= Yii::t('app', 'Комплектация и упаковка') ?></a></li>
                </ul>
            </li>
            <li>
                <a href="<?= makeUrl('presscenter')?>"><?= Yii::t('app', 'Пресс-центр') ?></a>
                <ul class="list-second">
                    <li><a href="<?= $host . Url::to(['presscenter/news'])?>"><?= Yii::t('app', 'Новости')?></a></li>
                    <li><a href="<?= $host . Url::to(['presscenter/articles'])?>"><?= Yii::t('app', 'Статьи') ?></a></li>
                </ul>
            </li>
            <li>
                <a href="<?= makeUrl('offices')?>"><?= Yii::t('app', 'Филиалы и контакты') ?></a>
                <ul class="list-second">
                    <li><a href="<?= $host  . Url::to(['/offices#contacts']) ?>"><?= Yii::t('app', 'Киев') ?></a></li>
                    <li><a href="<?= $host  . Url::to(['/vinnitsa/offices#contacts']) ?>"><?= Yii::t('app', 'Винница') ?></a></li>
                    <li><a href="<?= $host  . Url::to(['/dnepr/offices#contacts']) ?>"><?= Yii::t('app', 'Днепр') ?></a></li>
                    <li><a href="<?= $host  .Url::to(['/odessa/offices#contacts']) ?>"><?= Yii::t('app', 'Одесса') ?></a></li>
                    <li><a href="<?= $host  .Url::to(['/lvov/offices#contacts']) ?>"><?= Yii::t('app', 'Львов') ?></a></li>
                    <li><a href="<?= $host  .Url::to(['/kharkov/offices#contacts']) ?>"><?= Yii::t('app', 'Харьков') ?></a></li>
                    <li><a href="<?= $host  .Url::to(['/khmelnytskyi/offices#contacts']) ?>"><?= Yii::t('app', 'Хмельницкий') ?></a></li>
                    <li><a href="<?= $host  .Url::to(['/chernihiv/offices#contacts']) ?>"><?= Yii::t('app', 'Чернигов') ?></a></li>
                </ul>
            </li>
            <li>
                <a href="<?= makeUrl('dealers')?>"><?= Yii::t('app', 'Дилерам') ?></a>
                <ul class="list-second">
                    <li><a href="<?= makeUrl('dealers')?>"><?= Yii::t('app', 'Как стать нашим партнером') ?></a></li>
                </ul>
            </li>
        </ul>
<style>
.prod_footer li ul li {
    float: left;
    width: 220px;
    display: block !important;
}
.footer {
    height: 710px;
}
body {
    margin-bottom: 685px;
}
</style>
		<ul class="prod_footer list-first">
			<li>
                <a href="<?= makeUrl('catalog')?>"><?= Yii::t('app', 'Продукция') ?></a>
                <div class="block-catalog">
                    <ul class="list-second">
                        <li><a href="<?= makeUrl('catalog/cernyj-metall')?>"><?= Yii::t('app', 'Черный металл') ?></a></li>
                        <li><a href="<?= makeUrl('catalog/nerzaveusij-metall')?>"><?= Yii::t('app', 'Нержавеющий металл') ?></a></li>
                        <li><a href="<?= makeUrl('catalog/aluminij')?>"><?= Yii::t('app', 'Алюминий') ?></a></li>
                        <li><a href="<?= makeUrl('catalog/drugie-tovary')?>"><?= Yii::t('app', 'Другие товары') ?></a></li>
                        <li><a href="<?= makeUrl('catalog/kovanye-izdelia')?>"><?= Yii::t('app', 'Кованные изделия') ?></a></li>
                        <li><a href="<?= makeUrl('sales')?>"><?= Yii::t('app', 'Спецпредложения') ?></a></li>
                        <li><a href="<?= makeUrl('catalog/drugie-tovary/profnastil')?>"><?= Yii::t('app', 'Профнастил') ?></a></li>
                        <li><a href="<?= makeUrl('catalog/cernyj-metall/truba-profilnaa')?>"><?= Yii::t('app', 'Труба профильная') ?></a></li>
                        <li><a href="<?= makeUrl('catalog/drugie-tovary/setka-rabica')?>"><?= Yii::t('app', 'Сетка рабица') ?></a></li>
                        <li><a href="<?= makeUrl('catalog/kovanye-izdelia')?>"><?= Yii::t('app', 'Ковка') ?></a></li>
                        <li><a href="<?= makeUrl('catalog/cernyj-metall/list-ocinkovannyj')?>"><?= Yii::t('app', 'Лист оцинкованый') ?></a></li>
                        <li><a href="<?= makeUrl('catalog/drugie-tovary/setka-svarnaa-ocinkovannaa')?>"><?= Yii::t('app', 'Сетка сварная оцинкованная') ?></a></li>
                        <li><a href="<?= makeUrl('catalog/cernyj-metall/provoloka')?>"><?= Yii::t('app', 'Проволока вязальная') ?></a></li>
                        <li><a href="<?= makeUrl('catalog/nerzaveusij-metall/truba-nz')?>"><?= Yii::t('app', 'Труба нержавеющая') ?></a></li>
                        <li><a href="<?= makeUrl('catalog/aluminij/ugolok-aluminievyj')?>"><?= Yii::t('app', 'Уголок алюминиевый') ?></a></li>
                        <li><a href="<?= makeUrl('catalog/cernyj-metall/list-riflenyj')?>"><?= Yii::t('app', 'Лист рифленый') ?></a></li>
                        <li><a href="<?= makeUrl('catalog/drugie-tovary/elektrody')?>"><?= Yii::t('app', 'Електроды') ?></a></li>
                        <li><a href="<?= makeUrl('catalog/cernyj-metall/sveller-gnutyj')?>"><?= Yii::t('app', 'Швеллер гнутый') ?></a></li>
                        <li><a href="<?= makeUrl('catalog/aluminij/folga-aluminievaa')?>"><?= Yii::t('app', 'Фольга алюминиевая') ?></a></li>
                    </ul>
                </div>

            </li>
		</ui>
    </div>
    <div class="container-fluid footer-social">
        <div class="container">
            <div class="copyright"><span>© 2007-<?= date("Y") ?> «Metal •  Holding»</span>
                <?php if ($this->context->id == 'about'):?>
                <span><a href="https://mail.metal.kiev.ua/" class="corp-mail"><?= Yii::t('app', 'Корпоративная почта') ?></a></span>
                <?php endif;?>
            </div>
            <div class="socials">
                <ul>
                    <li><a href="https://www.linkedin.com/company/metal-holding-jsc" class="soc-i li"><i class="i-holder"></i></a></li>
                    <li><a href="#" class="soc-i yt"><i class="i-holder"></i></a></li>
                    <li><a href="https://www.facebook.com/metalholding/" class="soc-i fb"><i class="i-holder"></i></a></li>
                    <li><a href="https://www.instagram.com/metal_holding/" class="soc-i in"><i class="i-holder"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>