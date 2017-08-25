<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\models\ProductsCategories;

$categories = ProductsCategories::getCategoriesRoots();
$catItems = array();
foreach ($categories as $category) {
    $item = [
        'label' => $category->title,
        'url' => \yii\helpers\Url::to(["/{$currentСity}/catalog/" . $category->alias])
    ];
    if ($currentСity) {
        $item['url'] = \yii\helpers\Url::to(["/{$currentСity}/catalog/" . $category->alias]);
    } else {
        $item['url'] = \yii\helpers\Url::to(["/catalog/" . $category->alias]);
    }
    $catItems[] = $item;
}
array_unshift($catItems,
                ['label' => Yii::t('app', 'Продукция'),
                'active' => Yii::$app->controller->action->id == 'catalog',
                    'url' => ["/{$currentСity}/catalog"],
                ]);
//$catItems[] = ['label' => Yii::t('app', 'Спецпредложения'), 'url' => ["/{$currentСity}/sales"], 'active' => Yii::$app->controller->id == 'services']
?>
<?php NavBar::begin(
    [
        'containerOptions' => [
            'tag' => 'div',
            'class' => ''
        ],
        'options' => ['class' => 'navbar navbar-main-block']
    ]
);?>
<?= Nav::widget([
    'options' => [
        'class' => 'nav navbar-nav',
    ],
    'items' => [
        [
            'label' => Yii::t('app', 'О компании'), 'url' => ["/{$currentСity}/about"],
            'active' => Yii::$app->controller->action->id == 'about',
            'linkOptions' => ['class' => 'dropdown-toggle disabled'],
            'items' => [
                ['label' => Yii::t('app', 'О компании'), 'url' => ["/{$currentСity}/about"], 'active' => Yii::$app->controller->action->id == 'about'],
                ['label' => Yii::t('app', 'Вакансии'), 'url' => ["/{$currentСity}/vacancies"], 'active' => Yii::$app->controller->action->id == 'vacancies'],
            ]
        ],
        [
            'label' => Yii::t('app', 'Продукция'),
            'active' => Yii::$app->controller->id == 'catalog',
            'url' => ["/{$currentСity}/catalog"],
            'linkOptions' => ['class' => 'dropdown-toggle disabled'],
            'items' => $catItems
        ],
        ['label' => Yii::t('app', 'Услуги'), 'url' => ["/{$currentСity}/services"], 'active' => Yii::$app->controller->id == 'services'],
        [
            'label' => Yii::t('app', 'Пресс-центр'), 'url' => ["/{$currentСity}/presscenter"],
            'active' => (Yii::$app->controller->id == 'presscenter'),
//            'items' => [
//                ['label' => Yii::t('app', 'Пресс центр'), 'url' => ["/{$currentСity}/presscenter"],
//                    'active' => (Yii::$app->controller->id == 'presscenter')],
//                ['label' => Yii::t('app', 'Новости'), 'url' => ["/{$currentСity}/presscenter/news"], 'active' => Yii::$app->controller->id == 'news'],
//            ]
        ],
        ['label' => Yii::t('app', 'Филиалы и контакты'), 'url' => ["/{$currentСity}/offices"], 'active' => Yii::$app->controller->id == 'offices'],
        ['label' => Yii::t('app', 'Дилерам'), 'url' => ["/{$currentСity}/dealers"], 'active' => Yii::$app->controller->id == 'dealers'],
        //['label' => Yii::t('app', 'Спецпредложения'), 'url' => ["/{$currentСity}/sales"], 'active' => Yii::$app->controller->id == 'sales', 'linkOptions' => ['class' => 'menu-color-sales']],
        '<li class="menu-backroud-color-sales'. (Yii::$app->controller->id == 'sales' ? ' active' : '') .'"><a href="'.\yii\helpers\Url::to(["/{$currentСity}/sales"]).'">'.Yii::t('app', 'Спецпредложения').'</a></li>',        
        '<li class="search"><form action="'.\yii\helpers\Url::to(["/{$currentСity}/search"]).'"><input name="q" type="text" placeholder="'.Yii::t('app', 'Поиск...').'"><span><i class="i-holder"></i></span></form></li>'
    ],
]);?>
<?php NavBar::end();?>
