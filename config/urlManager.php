<?php
return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'enableStrictParsing' => false,
    'class' => 'codemix\localeurls\UrlManager',
    'enableDefaultLanguageUrlCode' => false,
    'enableLanguagePersistence' => false,
    'enableLanguageDetection' => false,
    'ignoreLanguageUrlPatterns' => [
        '#^admin#' => '#^admin#',
        '#^uploads#' => '#^uploads#',
    ],
    'languages' => [
        'ru' => 'ru-RU',
        'ua' => 'uk-UA',
        'en' => 'en-US'
    ],
    'rules' => [
        // base url rules
        '<controller:(catalog)>/<category>' => 'catalog/category',
        '<controller:(catalog)>/<category>/<subcategory>' => 'catalog/subcategory',
        '<controller:(catalog)>/<category>/<subcategory>/<alias>' => 'products/index',
        [
            'pattern' => '<city:(kiev|vinnitsa|dnepr|lvov|kharkov|odessa|khmelnytskyi|chernihiv)>/<controller:(catalog)>/<category>',
            'route' => 'catalog/category',
        ],
        [
            'pattern' => '<city:(kiev|vinnitsa|dnepr|lvov|kharkov|odessa|khmelnytskyi|chernihiv)>/<controller:(catalog)>/<category>/<subcategory>',
            'route' => 'catalog/subcategory',
        ],
        [
            'pattern' => '<city:(kiev|vinnitsa|dnepr|lvov|kharkov|odessa|khmelnytskyi|chernihiv)>/<controller:(catalog)>/<category>/<subcategory>/<alias>',
            'route' => 'products/index',
        ],
        
        '<controller:(sales)>' => 'sales/catalog',
        '<controller:(sales)>/<category>' => 'sales/category',
        '<controller:(sales)>/<category>/<subcategory>' => 'sales/subcategory',
        [
            'pattern' => '<city:(kiev|vinnitsa|dnepr|lvov|kharkov|odessa|khmelnytskyi|chernihiv)>/<controller:(sales)>',
            'route' => 'sales/catalog',
        ],
        [
            'pattern' => '<city:(kiev|vinnitsa|dnepr|lvov|kharkov|odessa|khmelnytskyi|chernihiv)>/<controller:(sales)>/<category>',
            'route' => 'sales/category',
        ],
        [
            'pattern' => '<city:(kiev|vinnitsa|dnepr|lvov|kharkov|odessa|khmelnytskyi|chernihiv)>/<controller:(sales)>/<category>/<subcategory>',
            'route' => 'sales/subcategory',
        ],
        
        '<module:(admin)>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
        '<module:(admin)>/<controller:\w+>' => '<module>/<controller>',
        '<controller:(search|about|catalog|sales|services|site|subscribe|vacancies|checkout|dealers)>' => '<controller>/index',
        
        '<controller:(vacancies|subscribe|site|catalog|checkout|dealers|sales)>/<action:\w+>' => '<controller>/<action>',
        '<controller:(sales)>/<id:(.*)>' => '<controller>/view',
        [
            'pattern' => '<city:(kiev|vinnitsa|dnepr|lvov|kharkov|odessa|khmelnytskyi|chernihiv)>/<controller:(search|about|sales|services|subscribe|vacancies|catalog|checkout|dealers)>',
            'route' => '<controller>/index',
        ],
        [
            'pattern' => '<city:(kiev|vinnitsa|dnepr|lvov|kharkov|odessa|khmelnytskyi|chernihiv)>/<controller:(sales)>/<id:(.*)>',
            'route' => '<controller>/view',
        ],

        '<controller:\w+>/<id:\d+>/<action:\w+>' => '<controller>/<action>',
        '<module:(presscenter|offices)>/<controller:\w+>/' => '<module>/<controller>/index',
        [
            'pattern' => '<city:(kiev|vinnitsa|dnepr|lvov|kharkov|odessa|khmelnytskyi|chernihiv)>/<module:\w+>',
            'route' => '<module>/default/index',
        ],
        '<module:\w+>/<controller:\w+>' => '<module>',
        //'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        '<module:(admin|presscenter|offices)>' => '<module>',
        [
            'pattern' => '<city:(kiev|vinnitsa|dnepr|lvov|kharkov|odessa|khmelnytskyi|chernihiv)>',
            'route' => '',
        ],
        '<controller:\w+>' => '<controller>/index',
        [
            'pattern' => '<city:(kiev|vinnitsa|dnepr|lvov|kharkov|odessa|khmelnytskyi|chernihiv)>/<module:\w+>/<controller:\w+>/<id:(.*)>',
            'route' => '<module>/<controller>/view',
        ],
        '<module:(presscenter)>/<controller:\w+>/<id:(.*)>' => '<module>/<controller>/view',
        [
            'pattern' => '<city:(kiev|vinnitsa|dnepr|lvov|kharkov|odessa|khmelnytskyi|chernihiv)>/<module:\w+>/<controller:\w+>',
            'route' => '<module>/<controller>/index',
        ],
        '<module:\w+>/<controller:\w+>/<id:([a-zA-Z1-9]*)>' => '<module>/<controller>/view',
        '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
        '<module:\w+>/<controller:\w+>/<id:(.*)>/<action:\w+>' => '<module>/<controller>/<action>',

        [
            'pattern' => '<city:(kiev|vinnitsa|dnepr|lvov|kharkov|odessa|khmelnytskyi|chernihiv)>/<module:\w+>/<controller:\w+>/<id:(.*)>/<action:\w+>',
            'route' => '<module>/<controller>/<action>',
        ],
        [
            'pattern' => '<city:(kiev|vinnitsa|dnepr|lvov|kharkov|odessa|khmelnytskyi|chernihiv)>/<controller:\w+>/<id:\d+>/<action:\w+>',
            'route' => '<controller>/<action>',
        ],
        [
            'pattern' => '<city:(kiev|vinnitsa|dnepr|lvov|kharkov|odessa|khmelnytskyi|chernihiv)>/<controller:\w+>/<action:\w+>',
            'route' => '<controller>/<action>',
        ],
    ]
];
