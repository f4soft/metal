<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\components\AppController;
use app\models\QuestionsToPolls;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Polls;

/**
 * QuestionsToPollsController implements the CRUD actions for QuestionsToPolls model.
 */
class QuestionsToPollsController extends AppController
{
    use traits\Common;

    /**
     * Lists all QuestionsToPolls models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider(['query' => QuestionsToPolls::find()]);
        $dataProvider->setSort(['defaultOrder' => ['created_at' => SORT_DESC]]);
        $dataProvider->setPagination(['pageSize' => 15]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single QuestionsToPolls model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new QuestionsToPolls model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new QuestionsToPolls();
        $polls = ArrayHelper::map(Polls::find()->getActive()->all(), "id", "title");

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                "polls" => $polls
            ]);
        }
    }

    /**
     * Updates an existing QuestionsToPolls model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $polls = ArrayHelper::map(Polls::find()->getActive()->all(), "id", "title_ru");
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                "polls" => $polls
            ]);
        }
    }

    /**
     * Finds the QuestionsToPolls model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QuestionsToPolls the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QuestionsToPolls::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
