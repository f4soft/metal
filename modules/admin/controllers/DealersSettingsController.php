<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\AppController;
use Yii;
use app\models\DealersSettings;
use yii\web\NotFoundHttpException;

/**
 * DealersSettingsController implements the CRUD actions for DealersSettings model.
 */
class DealersSettingsController extends AppController
{
    /**
     * Lists all DealersSettings models.
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $post = Yii::$app->request->post();
        if ($post) {
            if($model->load($post) && $model->validate()) {
                if($model->save()){
                    return $this->redirect(['update', 'id' => $model->id]);
                } else {
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model
            ]);
        }
    }

    public function actionInit()
    {
        $model = new DealersSettings();

        if ($model->save()) {
            return $this->redirect('update');
        }
    }

    /**
     * Finds the DealersSettings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DealersSettings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DealersSettings::findOne($id)) !== null) {
            return $model;
        } else {
            $model = new DealersSettings();
            if ($model->save()) {
                return $model;
            }
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
