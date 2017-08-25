<?php

namespace app\modules\admin\controllers\traits;

use yii\web\UploadedFile;
use yii\helpers\Url;

trait Upload
{
    public function actionUpload()
    {
        $uploadedFile = UploadedFile::getInstanceByName('upload');
        $mime = \yii\helpers\FileHelper::getMimeType($uploadedFile->tempName);
        $file = time()."_".$uploadedFile->name;
        if(!is_dir(\Yii::getAlias("@webroot/images/ckeditor"))) {
            mkdir(\Yii::getAlias("@webroot/images/ckeditor"), 0755, true);
        }
        $url = Url::to('/images/ckeditor/' . $file);
        $uploadPath = \Yii::getAlias('@webroot').'/images/ckeditor/' . $file;
        if ($mime!="image/jpeg" && $mime!="image/png") {
            if(!is_dir(\Yii::getAlias("@webroot/docs/ckeditor"))) {
                mkdir(\Yii::getAlias("@webroot/docs/ckeditor"), 0755, true);
            }
            //$url = \Yii::$app->urlManager->createAbsoluteUrl('/docs/ckeditor/' . $file);
            $url = Url::to('/docs/ckeditor/' . $file);
            $uploadPath = \Yii::getAlias('@webroot').'/docs/ckeditor/' . $file;
        } else {
            if(!is_dir(\Yii::getAlias("@webroot/images/ckeditor"))) {
                mkdir(\Yii::getAlias("@webroot/images/ckeditor"), 0755, true);
            }
            //$url = \Yii::$app->urlManager->createAbsoluteUrl('/images/ckeditor/' . $file);
            $url = Url::to('/images/ckeditor/' . $file);
            $uploadPath = \Yii::getAlias('@webroot').'/images/ckeditor/' . $file;
        }
        if ($uploadedFile==null)
        {
            $message = "No file uploaded.";
        }
        else if ($uploadedFile->size == 0)
        {
            $message = "The file is of zero length.";
        }
        /*else if ($mime!="image/jpeg" && $mime!="image/png")
        {
            $message = "The image must be in either JPG or PNG format. Please upload a JPG or PNG instead.";
        }*/
        else if ($uploadedFile->tempName==null)
        {
            $message = "You may be attempting to hack our server. We're on to you; expect a knock on the door sometime soon.";
        }
        else {
            $message = "";
            $move = $uploadedFile->saveAs($uploadPath);
            if(!$move)
            {
                $message = "Error moving uploaded file. Check the script is granted Read/Write/Modify permissions.";
            }
        }
        $funcNum = $_GET['CKEditorFuncNum'] ;
        echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
    }
}