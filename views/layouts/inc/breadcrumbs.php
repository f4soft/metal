<div class="container breadcrumbs-block margin-top-0 margin-bottom-0">
    <?php
    use yii\widgets\Breadcrumbs;
    use app\components\BreadcrumbsUtility;
    echo Breadcrumbs::widget([
            'homeLink' => BreadcrumbsUtility::getHome(Yii::t('app', 'Главная'), Yii::$app->getHomeUrl()) ,
            'links' => isset($this->params['breadcrumbs']) ?
                BreadcrumbsUtility::UseMicroData($this->params['breadcrumbs']): [],
            'options' => ['class' => 'clearfix breadcrumbs', 'itemtype' => 'http://schema.org/BreadcrumbList',]
    ]);
//    echo Breadcrumbs::widget([
//            'homeLink' => [// fist Home link
//                'label' => Yii::t('app', 'Главная'),
//                'url' => Yii::$app->homeUrl,
//                'template' => "<li class='breadcrumbs-i' itemtype = 'http://schema.org/ListItem'><a class='novisited breadcrumbs-link' itemprop = 'item'><span class='breadcrumbs-title' itemprop = 'name'>{link}</span></a></li>"
//            ],
//            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//            'itemTemplate' => "<li class='breadcrumbs-i' itemtype = 'http://schema.org/ListItem'>
//                <a class='novisited breadcrumbs-link' itemprop = 'item'>
//                <span class='breadcrumbs-title' itemprop = 'name'>{link}</span>
//                </a>
//                </li>", // template for all links
//            'options' => ['class' => 'clearfix breadcrumbs', 'itemtype' => 'http://schema.org/BreadcrumbList',]
//    ]);
    ?>
</div>
