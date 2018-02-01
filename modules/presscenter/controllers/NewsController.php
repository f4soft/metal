<?php
namespace app\modules\presscenter\controllers;


use app\components\AppController;
use app\models\BlockSettings;
use app\models\PagesImages;
use app\models\Forms\ContactForm;
use app\models\Forms\NewsSubscribeForm;
use app\models\ImageUpload;
use app\models\News;
use app\models\NewsSubcribers;
use app\models\Sales;
use yii\data\ActiveDataProvider;
use Yii;

class NewsController extends AppController
{
    public function actionIndex()
    {
        $sales = Sales::getSales();
        $model = new NewsSubscribeForm();
        $news = new ActiveDataProvider([
           'query' => News::find()->getActive()->orderBy('date_show DESC'),
            'pagination' => [
                'pageSize' => 6
            ]
        ]);
        $blockSettings = BlockSettings::find()->one();
        $modelContact = new ContactForm();
        $head_img = PagesImages::find()->where(['slug' => 'news'])->one();
        return $this->render('index',
            [
                'sales'=> $sales,
                'news' => $news,
                'selectedCity' => $this->selectedCity,
                'model' => $model,
                'modelContact' => $modelContact,
                'blockSettings' => $blockSettings,
                'head_img' => $head_img,
            ]
        );
    }

    public function actionView($id)
    {
        $model = News::find()->where(["alias"=>$id])->getActive()->one();
        if (!$model)
            throw new \yii\web\NotFoundHttpException;
        $modelContact = new ContactForm();
        $imageModel = new ImageUpload(News::tableName());
        $image = $imageModel->getImage($model, \Yii::$app->params['imagePresets']['news']['oneNews'], 'view', 'image');
        $city = isset(Yii::$app->request->get()['city']) ? Yii::$app->request->get()['city'] : '';
        $head_img = PagesImages::find()->where(['slug' => 'news'])->one();
        return $this->render('view', ['modelContact' => $modelContact, 'model' => $model, 'image' => "/{$image}",
            'city' => $city, 'head_img' => $head_img,]);
    }
}