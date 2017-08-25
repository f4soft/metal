<?php use \yii\helpers\Url; ?>

<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Меню администратора', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Товары',
                        'icon' => 'fa fa-circle-o',
                        'url' => Url::to(['/admin/products']),
                        'active' => Yii::$app->controller->id == 'products'
                    ],
//                    [
//                        'label' => 'Заказы',
//                        'icon' => 'fa fa-circle-o',
//                        'url' => Url::to(['/admin/orders']),
//                        'active' => Yii::$app->controller->id == 'orders'
//                    ],
                    [
                        'label' => 'Каталог продукции',
                        'icon' => 'fa fa-circle-o',
                        'url' => Url::to(['/admin/products-categories']),
                        'active' => Yii::$app->controller->id == 'products-categories'
                    ],
                    [
                        'label' => 'Новости',
                        'icon' => 'fa fa-circle-o',
                        'url' => Url::to(['/admin/news']),
                        'active' => Yii::$app->controller->id == 'news'
                    ],
                    [
                        'label' => 'Обратная связь',
                        'icon' => 'fa fa-circle-o',
                        'url' => Url::to(['/admin/feedback']),
                        'active' => Yii::$app->controller->id == 'feedback'
                    ],
                    [
                        'label' => 'Импорт',
                        'icon' => 'fa fa-circle-o',
                        'url' => Url::to(['/admin/import']),
                        'active' => Yii::$app->controller->id == 'import'
                    ],
                    [
                        'label' => 'Статьи',
                        'icon' => 'fa fa-circle-o',
                        'url' => Url::to(['/admin/articles']),
                        'active' => Yii::$app->controller->id == 'articles'
                    ],
                    [
                        'label' => 'Сотрудники',
                        'icon' => 'fa fa-circle-o',
                        'url' => Url::to(['/admin/team']),
                        'active' => Yii::$app->controller->id == 'team'
                    ],
                    [
                        'label' => 'Новостная рассылка',
                        'icon' => 'fa fa-circle-o',
                        'url' => Url::to(['/admin/news-subscribers']),
                        'active' => Yii::$app->controller->id == 'news-subscribers'
                    ],
                    [
                        'label' => 'Услуги',
                        'icon' => 'fa fa-circle-o',
                        'url' => Url::to(['/admin/services']),
                        'active' => Yii::$app->controller->id == 'services'
                    ],
                    [
                        'label' => 'История',
                        'icon' => 'fa fa-circle-o',
                        'url' => Url::to(['/admin/history']),
                        'active' => Yii::$app->controller->id == 'history'
                    ],
                    [
                        'label' => 'Отчеты',
                        'icon' => 'fa fa-circle-o',
                        'url' => Url::to(['/admin/reports']),
                        'active' => Yii::$app->controller->id == 'reports'
                    ],
                    [
                        'label' => 'Города',
                        'icon' => 'fa fa-circle-o',
                        'url' => Url::to(['/admin/cities']),
                        'active' => Yii::$app->controller->id == 'cities'
                    ],
                    [
                        'label' => 'Спецпредложения',
                        'icon' => 'fa fa-circle-o',
                        'url' => Url::to(['/admin/sales']),
                        'active' => Yii::$app->controller->id == 'sales'
                    ],
                    [
                        'label' => 'Наши ценности',
                        'icon' => 'fa fa-circle-o',
                        'url' => Url::to(['/admin/our-values']),
                        'active' => Yii::$app->controller->id == 'our-values'
                    ],
                    [
                        'label' => 'Вакансии',
                        'icon' => 'fa fa-circle-o',
                        'url' => Url::to(['/admin/vacancies']),
                        'active' => Yii::$app->controller->id == 'vacancies'
                    ],
                    [
                        'label' => Yii::t("app", "Голосования"),
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => Yii::t("app", "Голосования"),
                                'icon' => 'fa fa-circle-o',
                                'url' => Url::to(['/admin/polls']),
                                'active' => Yii::$app->controller->id == 'polls'
                            ],
                            [
                                'label' => Yii::t("app", "Ответы для голосований"),
                                'icon' => 'fa fa-circle-o',
                                'url' => Url::to(['/admin/questions-to-polls']),
                                'active' => Yii::$app->controller->id == 'questions-to-polls'
                            ],
                        ],
                    ],
                    [
                        'label' => Yii::t("app", "Филиалы и отделы"),
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => Yii::t("app", "Филиалы"),
                                'icon' => 'fa fa-circle-o',
                                'url' => Url::to(['/admin/offices']),
                                'active' => Yii::$app->controller->id == 'offices'
                            ],
                            [
                                'label' => Yii::t("app", "Отделы"),
                                'icon' => 'fa fa-circle-o',
                                'url' => Url::to(['/admin/departments']),
                                'active' => Yii::$app->controller->id == 'departments'
                            ],
                        ],
                    ],
//                    [
//                        'label' => 'Страницы',
//                        'icon' => 'fa fa-circle-o',
//                        'url' => Url::to(['/admin/pages']),
//                        'active' => Yii::$app->controller->id == 'pages'
//                    ],
                    [
                        'label' => 'Настройки',
                        'icon' => 'fa fa-circle-o',
                        'url' => Url::to(['/admin/settings']),
                        'active' => Yii::$app->controller->id == 'settings'
                    ],
                    [
                        'label' => 'Настройки блоков',
                        'icon' => 'fa fa-circle-o',
                        'url' => Url::to(['/admin/block-settings/update', 'id' => 1]),
                        'active' => Yii::$app->controller->id == 'block-settings'
                    ],
                    [
                        'label' => 'Дилерам',
                        'icon' => 'fa fa-circle-o',
                        'url' => Url::to(['/admin/dealers-settings/update', 'id' => 1]),
                        'active' => Yii::$app->controller->id == 'dealers-settings'
                    ],
                    [
                        'label' => 'Сео теги',
                        'icon' => 'fa fa-circle-o',
                        'url' => Url::to(['/admin/seo-tags']),
                        'active' => Yii::$app->controller->id == 'seo-tags'
                    ],
                    [
                        'label' => 'Фото в шапке',
                        'icon' => 'fa fa-circle-o',
                        'url' => Url::to(['/admin/pages-images']),
                        'active' => Yii::$app->controller->id == 'pages-images'
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
