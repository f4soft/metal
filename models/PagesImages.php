<?php

namespace app\models;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "pages_images".
 *
 * @property integer $id
 * @property string $slug
 * @property string $description
 * @property string $circle_image
 * @property string $bg_image
 * @property integer $updated_at
 * @property integer $created_at
 */
class PagesImages extends \app\models\BaseModel
{
    /**
     * @var mixed image the attribute for rendering the file input
     * widget for upload on the form
     */
    public $c_image;
    /**
     * @var mixed image the attribute for rendering the file input
     * widget for upload on the form
     */
    public $b_image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages_images';
    }

    public function behaviors()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['updated_at', 'created_at'], 'integer'],
            [['slug', 'description', 'circle_image', 'bg_image'], 'string', 'max' => 255],
            [['c_image', 'b_image'], 'file', 'extensions' => 'jpg, gif, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Имя',
            'description' => 'Описание',
            'circle_image' => 'Круглая картинка',
            'bg_image' => 'Задний фон',
            'updated_at' => 'Обновлено',
            'created_at' => 'Создано',
        ];
    }

    /**
     * fetch stored image file name with complete path
     * @return string
     */
    public function getImageCircle()
    {
        return isset($this->circle_image) ? Yii::getAlias("@web/images/pages_imgs/$this->slug/") . $this->circle_image : null;
    }

    /**
     * fetch stored image file name with complete path
     * @return string
     */
    public function getImageBg()
    {
        return isset($this->bg_image) ? Yii::getAlias("@web/images/pages_imgs/$this->slug/") . $this->bg_image : null;
    }

    /**
     * Process upload of image
     *
     * @return mixed the uploaded image instance
     */
    public function uploadImageCircle()
    {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $image = UploadedFile::getInstance($this, 'c_image');

        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }

        // generate a unique file name
        $this->circle_image = Yii::$app->security->generateRandomString() . ".{$image->getExtension()}";

        // store the uploaded image instance
        $this->createDir();
        $image->saveAs(Yii::getAlias("@webroot/images/pages_imgs/{$this->slug}/{$this->circle_image}"));

        return true;
    }

    /**
     * Process upload of image
     *
     * @return mixed the uploaded image instance
     */
    public function uploadImageBg()
    {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $image = UploadedFile::getInstance($this, 'b_image');

        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }

        // generate a unique file name
        $this->bg_image = Yii::$app->security->generateRandomString() . ".{$image->getExtension()}";

        // store the uploaded image instance
        $this->createDir();
        $image->saveAs(Yii::getAlias("@webroot/images/pages_imgs/{$this->slug}/{$this->bg_image}"));

        return true;
    }

    /**
     * Create directory for images
     */
    protected function createDir()
    {
        if (!is_dir(Yii::getAlias("@webroot/images/pages_imgs/$this->slug/"))) {
            mkdir(Yii::getAlias("@webroot/images/pages_imgs/$this->slug/"), 0755, true);
        }
    }

    /**
     * Process deletion of image
     *
     * @return boolean the status of deletion
     */
//    public function deleteImage()
//    {
//        $file = $this->getImageFile();
//
//        // check if file exists on server
//        if (empty($file) || !file_exists($file)) {
//            return false;
//        }
//
//        // check if uploaded file can be deleted on server
//        if (!unlink($file)) {
//            return false;
//        }
//
//        // if deletion successful, reset your file attributes
//        $this->avatar = null;
//        $this->filename = null;
//
//        return true;
//    }
}
