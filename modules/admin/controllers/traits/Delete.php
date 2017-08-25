<?php

namespace app\modules\admin\controllers\traits;

trait Delete {

    /**
     * Deletion: mark item as deleted
     * but not deleting it from the DB actually
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $item = $this->findModel($id);
        $item->delete();

        return $this->redirect(['index']);
    }
}
