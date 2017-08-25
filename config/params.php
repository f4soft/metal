<?php

return [
    'maxSize' => 1024 * 1024 * 2,
    'fileMaxSize' => 1024 * 1024 * 50,
    'adminEmail' => 'mht@metal.kiev.ua',
    'homeUrl' => 'https://www.metall-holding.com.ua/',
//    'homeUrl' => 'http://mh.dinarys.com/',
    //'homeUrl' => 'http://mh.loc/',
    'langs' => [
        'ru-RU'=>'ru',
        'uk-UA'=>'ua',
        'en-US'=>'en',
    ],
    'units' => [
        'kg' => Yii::t('app/units', 'кг'),
        'kompl' => Yii::t('app/units', 'компл'),
        'm' => Yii::t('app/units', 'м'),
        'm2' => Yii::t('app/units', 'м2'),
        'pachka' => Yii::t('app/units', 'пач'),
        'rulon' => Yii::t('app/units', 'рул'),
        't' => Yii::t('app/units', Yii::t('app/units', 'т')),
        'sht' => Yii::t('app/units', 'шт'),
    ],
    'units_t' => [
        't' => Yii::t('app/units', 'т'),
        'm' => Yii::t('app/units', 'м'),
        'sht' => Yii::t('app/units', 'шт'),
        /*'kg' => Yii::t('app/units', 'кг'),*/
    ],
    'units_kg' => [
        'kg' => Yii::t('app/units', 'кг'),
        'm' => Yii::t('app/units', 'м'),
        /*'t' => Yii::t('app/units', 'т'),*/
        'sht' => Yii::t('app/units', 'шт'),
    ],
    'units_m' => [
        'm' => Yii::t('app/units', 'м'),
        'kg' => Yii::t('app/units', 'кг'),
        'sht' => Yii::t('app/units', 'шт'),
    ],
    'units_m2' => [
        'm2' => Yii::t('app/units', 'м2'),
        'kg' => Yii::t('app/units', 'кг'),
        'list' => Yii::t('app/units', 'лист'),
    ],
    'units2_m2' => [
        'm2' => Yii::t('app/units', 'м2'),
        'kg' => Yii::t('app/units', 'кг'),
        'list' => Yii::t('app/units', 'лист'),
    ],
    'units2_t' => [
        't' => Yii::t('app/units', 'т'),
        'm2' => Yii::t('app/units', 'м2'),
        'list' => Yii::t('app/units', 'лист'),
        'kg' => Yii::t('app/units', 'кг'),
    ],
    'units2_kg' => [
        'kg' => Yii::t('app/units', 'кг'),
        'm2' => Yii::t('app/units', 'м2'),
        'list' => Yii::t('app/units', 'лист'),
    ],
    'imagePresets' => [
        'team' => [
            'admin' => [100, 100],
            //'slider' => [188, 160],
            'slider' => [195, 162],
        ],
        'categories' => [
            'admin' => [100, 100],
            'main' => [213,161],
            'small' => [69, 69],
            'related' => [130, 130],
            'sub' => [118, 118],
            //'catalog' => [740, 560],
            'catalog' => [360, 272],
            'product' => [236, 236],
        ],
        'products' => [
            'admin' => [100,100],
            'main' => [236, 236],
            'popular' => [130, 130],
        ],
        'services-small' => [
            'admin' => [100, 100],
            'main' => [118, 118],
        ],
        'services-big' => [
            'admin' => [100, 100],
            'main' => [1920, 450],
        ],
        'categories-price' => [
            'admin' => [100, 100],
            'main' => [1140, 160]
        ],
        'our-values' => [
            'main' => ['94', '94']
        ],

        'history' => [
            'admin' => [100,100],
            'aboutPage' => [470, 200]
        ],
        'news' => [
            'admin' => [100,100],
            'small' => [136, 140],
            'oneNews' => [457, 251],
            'oneNewsBig' => [555, 255],
            'delivery' => [130, 130],
        ],
        'articles' => [
            'admin' => [100,100],
            'small' => [130, 80],
            'smallArticle' => [460, 260],
            'oneArticle' => [444, 251],
        ],
        'sales' => [
            'admin' => [100,100],
            'small' => [555, 276],
            'list' => [130, 80],
            'oneSale' => [457, 251],
            'newsSale' => [250, 180],
        ],
    ],
    'recaptchaSiteKey' => '6LfU3RIUAAAAACuLBxwSs8Xh-bcaldSKby4UoLpF',
    'recaptchaSecretKey' => '6LfU3RIUAAAAAFCIch-2Wq8l0arESaQhjE6qFpuX',
];
