<?php
namespace app\modules\presscenter\controllers;


use app\components\AppController;
use app\models\Articles;
use app\models\PagesImages;
use app\models\BlockSettings;
use app\models\Forms\ContactForm;
use app\models\ImageUpload;
use app\models\Sales;
use Yii;
use yii\data\ActiveDataProvider;

class ArticlesController extends AppController
{
    public function actionIndex()
    {
        $sales = Sales::getSales();
        $articles = new ActiveDataProvider([
            'query' => Articles::find()->getActive()->orderBy('date_show DESC'),
            'pagination' => [
                'pageSize' => 6
            ]
        ]);
        $blockSettings = BlockSettings::find()->one();
        $modelContact = new ContactForm();
        $head_img = PagesImages::find()->where(['slug' => 'articles'])->one();

        return $this->render('index',
            [
                'sales'=> $sales,
                'articles' => $articles,
                'selectedCity' => $this->selectedCity,
                'modelContact' => $modelContact,
                'blockSettings' => $blockSettings,
                'head_img' => $head_img,
            ]
        );
    }

    public function actionView($id)
    {
        $model = Articles::find()->where(["alias"=>$id])->getActive()->one();
        if (!$model)
            throw new \yii\web\NotFoundHttpException;
        $imageModel = new ImageUpload(Articles::tableName());
        $image = $imageModel->getImage($model, \Yii::$app->params['imagePresets']['articles']['oneArticle'], 'view', 'image');
        $modelContact = new ContactForm();
        $head_img = PagesImages::find()->where(['slug' => 'articles'])->one();
        return $this->render('view',
            [
                'model' => $model,
                'image' => "/{$image}",
                'city' => $this->selectedCity,
                'modelContact' => $modelContact,
                'head_img' => $head_img,
            ]);
    }
}