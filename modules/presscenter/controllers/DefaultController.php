<?php

namespace app\modules\presscenter\controllers;

use app\components\AppController;
use app\models\Articles;
use app\models\PagesImages;
use app\models\BlockSettings;
use app\models\Forms\ContactForm;
use app\models\Forms\NewsSubscribeForm;
use app\models\News;
use app\models\Sales;
use app\models\ProductsCategories;
use Yii;

/**
 * Default controller for the `pressCenter` module
 */
class DefaultController extends AppController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        /**
         * TODO
         *  subscribe to news
         */
        Yii::$app->formatter->locale = Yii::$app->language;
        $news = News::getPressCenterNews();
        $sales = ProductsCategories::getSubcategorySaleRand();
        $articles = Articles::getArticlesForPressCenter();
        $block_settings = BlockSettings::find()->one();
        $modelContact = new ContactForm();
        $modelSubscribe = new NewsSubscribeForm();

        $head_img = PagesImages::find()->where(['slug' => 'presscenter'])->one();
        return $this->render('index', [
            'modelSubscribe' => $modelSubscribe,
            'news' => $news,
            'sales'=>$sales,
            'articles' => $articles,
            'blockSettings' => $block_settings,
            'city' => $this->selectedCity,
            'modelContact' => $modelContact,
            'head_img' => $head_img,
        ]);
    }
}
