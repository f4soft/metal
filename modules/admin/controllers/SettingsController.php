<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 5/26/16
 * Time: 4:19 PM
 */

namespace app\modules\admin\controllers;

use app\modules\admin\components\AppController;
use yii;
use app\models\Settings;
use yii\data\ActiveDataProvider;

class SettingsController extends AppController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            "query" => Settings::find()->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 15,
            ],
            "sort" => [
                "defaultOrder" => [
                    "name" => SORT_ASC
                ],
            ],
        ]);

        return $this->render("index", ["dataProvider" => $dataProvider]);
    }

    protected function findModel($id){
        return Settings::findBySql("SELECT * FROM ".Settings::tableName() . " WHERE `id`= :id", [":id" => $id])->one();
    }

    /**
     * Updates an existing Settings model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect("index");
        } else {
            return $this->render("update", ["model" => $model]);
        }

    }

    /**
     * Deletes an existing Settings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect("index");
    }
}