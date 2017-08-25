<?php
namespace app\models;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Yii;
use yii\web\UploadedFile;
use yii\base\Model;

class ImageUpload extends Model
{
    /**
     * @var UploadedFile
     */
    public $folder;
    public $file;
    public $big_file;
    public $type;

    public function __construct($type)
    {
        parent::__construct();
        $this->type = $type;
    }

    /**
     * @param $image
     * @return bool
     */
    public function upload($model, $presets = false, $action, $field = 'image')
    {
        if($this->file && !$this->file->error){
            $this->createDir($model);
            $fileOrig = $this->getPath($model, false, $action, $field);
            if($this->file->saveAs(Yii::getAlias("@webroot/$fileOrig"))) {
                if($presets && !empty($presets)) {
                    foreach ($presets as $preset) {
                        $w = !empty($preset[0]) ? $preset[0] : false;
                        $h = !empty($preset[1]) ? $preset[1] : false;
                        $file = $this->getPath($model, $preset, $action, $field);
                        /*$image = Yii::$app->image->load(Yii::getAlias("@webroot/$fileOrig"));
                        $image->resize($w, $h, \yii\image\drivers\Image::NONE)
                            ->save(Yii::getAlias("@webroot/$file"), 60);*/
                        //implement Samdark module logic
                        $imagine = new Imagine();
                        $size = new Box($w, $h);
                        $mode = ImageInterface::THUMBNAIL_OUTBOUND;
                        $image = $imagine->open(Yii::getAlias("@webroot/$fileOrig"));
                        $_h = $image->getSize()->getHeight();
                        $_w = $image->getSize()->getWidth();
                        if($w != $_w) {
                            $image->thumbnail($size, $mode)->save(Yii::getAlias("@webroot/$file"), [
                                //'png_compression_level' => 0,
                                'jpeg_quality' => 60
                            ]);
                        } else {
                            copy(Yii::getAlias("@webroot/$fileOrig"), Yii::getAlias("@webroot/$file"));
                        }
                    }
                } else {
                    $file = $this->getPath($model, false, $action, $field);
                    /*$image = Yii::$app->image->load(Yii::getAlias("@webroot/$fileOrig"));
                    $image->save(Yii::getAlias("@webroot/$file"), 60);*/
                    //implement Samdark module logic
                    $imagine = new Imagine();
                    $image = $imagine->open(Yii::getAlias("@webroot/$fileOrig"));
                    $image->save(Yii::getAlias("@webroot/$file"), [
                        'jpeg_quality' => 60
                    ]);
                }
                return true;
            }
        }
        return false;
    }

    public function getImage($model, $preset = false, $action, $field = "file")
    {
        $this->getDirName($model);
        $img = $this->getPath($model, $preset, $action, $field);
        if($img && $model->$field) {
            //if (!file_exists(Yii::getAlias("@webroot/$img"))) {
                $fileOrig = Yii::getAlias("@webroot/{$this->folder}/{$model->$field}");
                /*$image = Yii::$app->image->load($fileOrig);
                $image->resize($preset[0], $preset[1], \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/{$this->folder}/{$preset[0]}_{$model->$field}"), 60);
                $img = $this->getPath($model, $preset, $action, $field);*/
                //implement Samdark module logic
                $imagine = new Imagine();
                $image = $imagine->open($fileOrig);
                if($preset) {
                    $size = new Box($preset[0], $preset[1]);
                    $_h = $image->getSize()->getHeight();
                    $_w = $image->getSize()->getWidth();
                    if($preset[0] != $_w) {
                        $mode = ImageInterface::THUMBNAIL_OUTBOUND;
                        $image->thumbnail($size, $mode)->save(Yii::getAlias("@webroot/{$this->folder}/{$preset[0]}_{$model->$field}"), [
                            'jpeg_quality' => 60
                        ]);
                    } else {
                        copy(Yii::getAlias("@webroot/{$this->folder}/{$model->$field}"), Yii::getAlias("@webroot/{$this->folder}/{$preset[0]}_{$model->$field}"));
                    }

                } else {
                    $image->save(Yii::getAlias("@webroot/{$this->folder}/{$preset[0]}_{$model->$field}"), [
                        'jpeg_quality' => 60
                    ]);
                }

                $img = $this->getPath($model, $preset, $action, $field);
            //}
            return $img;
        }
        return false;
    }

    /**
     * Get directory for images
     * @param $model
     */
    protected function getDirName($model)
    {
        /*if(is_integer($model->id / 5000)) {
            $level = $model->id / 5000;
            $this->folder = "images/{$this->type}_$level/{$model->id}";
        } else {*/
            $this->folder = "images/{$this->type}/{$model->id}";
        //}
        return $this->folder;
    }

    /**
     * Create directory for images
     * @param $model
     */
    protected function createDir($model)
    {
        $this->getDirName($model);
        if(!is_dir(Yii::getAlias("@webroot/$this->folder"))) {
            mkdir(Yii::getAlias("@webroot/$this->folder"), 0755, true);
        }
    }

    /**
     * Return fullpath for directory
     * @param $model
     * @param bool $preset
     * @param string $action
     * @param string $field
     * @return string
     */
    protected function getPath($model, $preset = false, $action, $field)
    {
        //if ( isset($model->{$field}) ) {
            switch ($action) {
                case 'create':
                    $fileName = str_replace(' ', '_', $this->file->baseName);
                    return !empty($preset) ? "{$this->folder}/{$preset[0]}_{$fileName}.{$this->file->extension}" :
                        "{$this->folder}/{$fileName}.{$this->file->extension}";
                    break;
                case 'update':
                    $fileName = str_replace(' ', '_', $this->file->baseName);
                    return !empty($preset) ? "{$this->folder}/{$preset[0]}_{$fileName}.{$this->file->extension}" :
                        "{$this->folder}/{$fileName}.{$this->file->extension}";
                    break;
                case 'view':
                    $preset = isset($preset) && !empty($preset) ? $preset[0] . "_" : '';
                    return !empty($preset) ? "{$this->folder}/{$preset}{$model->{$field}}" : "{$this->folder}/{$model->{$field}}";
                    break;
            }
        //}

        return false;
    }

    public function clearDirectory($model)
    {
        $path = $this->getDirName($model);
        $path = Yii::getAlias('@webroot') . "/" . $path;
        if(is_dir($path)) {
            $dir = glob($path)[0];
            if($dir) {
                foreach (scandir($dir) as $item) {
                    if ($item == '.' || $item == '..') {
                        continue;
                    }
                    if (!is_dir($dir . DIRECTORY_SEPARATOR . $item)) {
                        unlink($dir . DIRECTORY_SEPARATOR . $item);
                    }

                }
                return rmdir($dir);
            }
        }
        return false;
    }
}
