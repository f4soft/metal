<?php

namespace app\modules\admin\controllers\traits;

trait Common {

    /**
     * Deletion: mark item as deleted
     * but not deleting it from the DB actually
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $item = $this->findModel($id);
        $item->status = 0;
        $item->save();

        return $this->redirect(['index']);
    }
}
