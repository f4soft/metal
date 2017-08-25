<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 5/26/16
 * Time: 12:21 PM
 */

namespace app\models;
use yii\db\ActiveQuery;


class BaseQuery extends ActiveQuery
{
    /**
     * Returns current table name
     * @return mixed
     */
    public function getTableName() {
        $modelClass = $this->modelClass;
        return $modelClass::tableName();
    }

    public function getActive($status = 1)
    {
        return $this->andWhere(['status' => $status]);
    }

    public function getOnlyNew($sent = 0)
    {
        return $this->andWhere(['sent' => $sent]);
    }
}