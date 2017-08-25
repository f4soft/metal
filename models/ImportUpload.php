<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

class ImportUpload extends Model
{
    const FILE_CITY = 'cities.xml';
    const FILE_CATEGORIES = 'product_group.xml';
    const FILE_PRODUCTS = 'product.xml';
    /**
     * @var UploadedFile
     */
    public $cities;
    /**
     * @var UploadedFile
     */
    public $categories;
    /**
     * @var UploadedFile
     */
    public $products;

    public function rules()
    {
        return [
            [['cities','categories','products'], 'file', 'skipOnEmpty' => true, 'extensions' => 'xml'],
        ];
    }

    public function uploadCities()
    {
        if ($this->validate()) {
            $this->cities->saveAs(Yii::getAlias('@app') .'/xml/' . self::FILE_CITY);
            return true;
        } else {
            return false;
        }
    }

    public function uploadCategories()
    {
        if ($this->validate()) {
            $this->categories->saveAs(Yii::getAlias('@app') .'/xml/' . self::FILE_CATEGORIES);
            return true;
        } else {
            return false;
        }
    }

    public function uploadProducts()
    {
        if ($this->validate()) {
            $this->products->saveAs(Yii::getAlias('@app') .'/xml/' . self::FILE_PRODUCTS);
            return true;
        } else {
            return false;
        }
    }
}