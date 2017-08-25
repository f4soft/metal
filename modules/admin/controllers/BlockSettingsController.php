<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\AppController;
use Yii;
use app\models\BlockSettings;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\widgets\Block;

/**
 * BlockSettingsController implements the CRUD actions for BlockSettings model.
 */
class BlockSettingsController extends AppController
{
    /**
     * Lists all BlockSettings models.
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $post = Yii::$app->request->post();
        $fileName = $model->getUploadedPressCenterPrices();
        $presscenterImage = $model->getUploadedPressCenterPriceImages();
        $bannerImage = $model->getUploadedCartBannerImages();
        $servicesImage = $model->getUploadedServicesBannerImages();
        $vacanciesImage = $model->getUploadedVacanciesBannerImages();
        $salesImage = $model->sales_image ? $model->getAdminPriceImage($model->sales_image) : false;
        $aboutImage = $model->about_image ? $model->getAdminPriceImage($model->about_image) : false;
        if ($post) {
            $vacanciesImageRu = UploadedFile::getInstance($model, 'vacancies_banner_ru') ?: $model->vacancies_banner_ru;
            $vacanciesImageUa = UploadedFile::getInstance($model, 'vacancies_banner_ua') ?: $model->vacancies_banner_ua;
            $vacanciesImageEn = UploadedFile::getInstance($model, 'vacancies_banner_en') ?: $model->vacancies_banner_en;
            $servicesImageRu = UploadedFile::getInstance($model, 'services_banner_ru') ?: $model->services_banner_ru;
            $servicesImageUa = UploadedFile::getInstance($model, 'services_banner_ua') ?: $model->services_banner_ua;
            $servicesImageEn = UploadedFile::getInstance($model, 'services_banner_en') ?: $model->services_banner_en;
            $bannerImageRu = UploadedFile::getInstance($model, 'cart_banner_ru') ?: $model->cart_banner_ru;
            $bannerImageUa = UploadedFile::getInstance($model, 'cart_banner_ua') ?: $model->cart_banner_ua;
            $bannerImageEn = UploadedFile::getInstance($model, 'cart_banner_en') ?: $model->cart_banner_en;
            $fileModelRu = UploadedFile::getInstance($model, 'presscenter_price_ru') ?  : $model->presscenter_price_ru;
            $fileModelUa = UploadedFile::getInstance($model, 'presscenter_price_ua') ?  : $model->presscenter_price_ua;
            $fileModelEn = UploadedFile::getInstance($model, 'presscenter_price_en') ?  : $model->presscenter_price_en;

            $presscenterImageModelRu = UploadedFile::getInstance($model, 'presscenter_price_image_ru') ? :
                $model->presscenter_price_image_ru;
            $presscenterImageModelUa = UploadedFile::getInstance($model, 'presscenter_price_image_ua') ? :
                $model->presscenter_price_image_ua;
            $presscenterImageModelEn = UploadedFile::getInstance($model, 'presscenter_price_image_en') ? :
                $model->presscenter_price_image_en;
            $salesImageModel = UploadedFile::getInstance($model, 'sales_image') ?  : $model->sales_image;
            $aboutImageModel = UploadedFile::getInstance($model, 'about_image') ?  : $model->about_image;

            $post['BlockSettings']['presscenter_price_ru'] = ($fileModelRu instanceof UploadedFile) ? $fileModelRu :
                $model->presscenter_price_ru;
            $post['BlockSettings']['presscenter_price_ua'] = ($fileModelUa instanceof UploadedFile) ? $fileModelUa :
                $model->presscenter_price_ua;
            $post['BlockSettings']['presscenter_price_en'] = ($fileModelEn instanceof UploadedFile) ? $fileModelEn :
                $model->presscenter_price_en;
            $post['BlockSettings']['presscenter_price_image_ru'] = ($presscenterImageModelRu instanceof UploadedFile) ?
                $presscenterImageModelRu : $model->presscenter_price_image_ru;
            $post['BlockSettings']['presscenter_price_image_ua'] = ($presscenterImageModelUa instanceof UploadedFile) ?
                $presscenterImageModelUa : $model->presscenter_price_image_ua;
            $post['BlockSettings']['presscenter_price_image_en'] = ($presscenterImageModelEn instanceof UploadedFile) ?
                $presscenterImageModelEn : $model->presscenter_price_image_en;
            $post['BlockSettings']['sales_image'] = ($salesImageModel instanceof UploadedFile) ? $salesImageModel : $model->sales_image;
            $post['BlockSettings']['about_image'] = ($aboutImageModel instanceof UploadedFile) ? $aboutImageModel : $model->about_image;
            $post['BlockSettings']['cart_banner_ru'] = ($bannerImageRu instanceof UploadedFile) ? $bannerImageRu :
                $model->cart_banner_ru;
            $post['BlockSettings']['cart_banner_ua'] = ($bannerImageUa instanceof UploadedFile) ? $bannerImageUa :
                $model->cart_banner_ua;
            $post['BlockSettings']['cart_banner_en'] = ($bannerImageEn instanceof UploadedFile) ? $bannerImageEn :
                $model->cart_banner_en;
            $post['BlockSettings']['services_banner_ru'] = ($servicesImageRu instanceof UploadedFile) ? $servicesImageRu :
                $model->services_banner_ru;
            $post['BlockSettings']['services_banner_ua'] = ($servicesImageUa instanceof UploadedFile) ? $servicesImageUa :
                $model->services_banner_ua;
            $post['BlockSettings']['services_banner_en'] = ($servicesImageEn instanceof UploadedFile) ? $servicesImageEn :
                $model->services_banner_en;
            $post['BlockSettings']['vacancies_banner_ru'] = ($vacanciesImageRu instanceof UploadedFile) ? $vacanciesImageRu :
                $model->services_banner_ru;
            $post['BlockSettings']['vacancies_banner_ua'] = ($vacanciesImageUa instanceof UploadedFile) ? $vacanciesImageUa :
                $model->services_banner_ua;
            $post['BlockSettings']['vacancies_banner_en'] = ($vacanciesImageEn instanceof UploadedFile) ? $vacanciesImageEn :
                $model->services_banner_en;

            if($model->load($post) && $model->validate()) {
                if($fileModelRu instanceof UploadedFile) {
                    $model->upload($fileModelRu);
                    $model->presscenter_price_ru = "{$fileModelRu->baseName}.{$fileModelRu->extension}";
                    $model->presscenter_price_ru = str_replace(' ', '_', $model->presscenter_price_ru);
                }
                if($fileModelUa instanceof UploadedFile) {
                    $model->upload($fileModelUa);
                    $model->presscenter_price_ua = "{$fileModelUa->baseName}.{$fileModelUa->extension}";
                    $model->presscenter_price_ua = str_replace(' ', '_', $model->presscenter_price_ua);
                }
                if($fileModelEn instanceof UploadedFile) {
                    $model->upload($fileModelEn);
                    $model->presscenter_price_en = "{$fileModelEn->baseName}.{$fileModelEn->extension}";
                    $model->presscenter_price_en = str_replace(' ', '_', $model->presscenter_price_en);
                }

                if($presscenterImageModelRu instanceof UploadedFile) {
                    $model->upload($presscenterImageModelRu);
                    $model->presscenter_price_image_ru = "{$presscenterImageModelRu->baseName}.{$presscenterImageModelRu->extension}";
                    $model->presscenter_price_image_ru = str_replace(' ', '_', $model->presscenter_price_image_ru);
                }

                if($presscenterImageModelUa instanceof UploadedFile) {
                    $model->upload($presscenterImageModelUa);
                    $model->presscenter_price_image_ua = "{$presscenterImageModelUa->baseName}.{$presscenterImageModelUa->extension}";
                    $model->presscenter_price_image_ua = str_replace(' ', '_', $model->presscenter_price_image_ua);
                }

                if($presscenterImageModelEn instanceof UploadedFile) {
                    $model->upload($presscenterImageModelEn);
                    $model->presscenter_price_image_en = "{$presscenterImageModelEn->baseName}.{$presscenterImageModelEn->extension}";
                    $model->presscenter_price_image_en = str_replace(' ', '_', $model->presscenter_price_image_en);
                }

                if($salesImageModel instanceof UploadedFile) {
                    $model->upload($salesImageModel);
                    $model->sales_image = "{$salesImageModel->baseName}.{$salesImageModel->extension}";
                    $model->sales_image = str_replace(' ', '_', $model->sales_image);
                }

                if($aboutImageModel instanceof UploadedFile) {
                    $model->upload($aboutImageModel);
                    $model->about_image = "{$aboutImageModel->baseName}.{$aboutImageModel->extension}";
                    $model->about_image = str_replace(' ', '_', $model->about_image);
                }

                if($bannerImageRu instanceof UploadedFile) {
                    $model->upload($bannerImageRu);
                    $model->cart_banner_ru = "{$bannerImageRu->baseName}.{$bannerImageRu->extension}";
                    $model->cart_banner_ru = str_replace(' ', '_', $model->cart_banner_ru);
                }

                if($bannerImageUa instanceof UploadedFile) {
                    $model->upload($bannerImageUa);
                    $model->cart_banner_ua = "{$bannerImageUa->baseName}.{$bannerImageUa->extension}";
                    $model->cart_banner_ua = str_replace(' ', '_', $model->cart_banner_ua);
                }

                if($bannerImageEn instanceof UploadedFile) {
                    $model->upload($bannerImageEn);
                    $model->cart_banner_en = "{$bannerImageEn->baseName}.{$bannerImageEn->extension}";
                    $model->cart_banner_en = str_replace(' ', '_', $model->cart_banner_en);
                }

                if($servicesImageRu instanceof UploadedFile) {
                    $model->upload($servicesImageRu);
                    $model->services_banner_ru = "{$servicesImageRu->baseName}.{$servicesImageRu->extension}";
                    $model->services_banner_ru = str_replace(' ', '_', $model->services_banner_ru);
                }

                if($servicesImageUa instanceof UploadedFile) {
                    $model->upload($servicesImageUa);
                    $model->services_banner_ua = "{$servicesImageUa->baseName}.{$servicesImageUa->extension}";
                    $model->services_banner_ua = str_replace(' ', '_', $model->services_banner_ua);
                }

                if($servicesImageEn instanceof UploadedFile) {
                    $model->upload($servicesImageEn);
                    $model->services_banner_en = "{$servicesImageEn->baseName}.{$servicesImageEn->extension}";
                    $model->services_banner_en = str_replace(' ', '_', $model->services_banner_en);
                }

                if($vacanciesImageRu instanceof UploadedFile) {
                    $model->upload($vacanciesImageRu);
                    $model->vacancies_banner_ru = "{$vacanciesImageRu->baseName}.{$vacanciesImageRu->extension}";
                    $model->vacancies_banner_ru = str_replace(' ', '_', $model->vacancies_banner_ru);
                }

                if($vacanciesImageUa instanceof UploadedFile) {
                    $model->upload($vacanciesImageUa);
                    $model->vacancies_banner_ua = "{$vacanciesImageUa->baseName}.{$vacanciesImageUa->extension}";
                    $model->vacancies_banner_ua = str_replace(' ', '_', $model->vacancies_banner_ua);
                }

                if($vacanciesImageEn instanceof UploadedFile) {
                    $model->upload($vacanciesImageEn);
                    $model->vacancies_banner_en = "{$vacanciesImageEn->baseName}.{$vacanciesImageEn->extension}";
                    $model->vacancies_banner_en = str_replace(' ', '_', $model->vacancies_banner_en);
                }

                if($model->save()){
                    return $this->redirect(['update', 'id' => $model->id]);
                } else {
                    return $this->render('update', [
                        'model' => $model,
                        'fileName' => $fileName,
                        'presscenterImage' => $presscenterImage,
                        'salesImage' => $salesImage,
                        'aboutImage' => $aboutImage,
                        'bannerImage' => $bannerImage,
                        'servicesImage'=> $servicesImage,
                        'vacanciesImage'=> $vacanciesImage
                    ]);
                }
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'fileName' => $fileName,
                    'presscenterImage' => $presscenterImage,
                    'salesImage' => $salesImage,
                    'aboutImage' => $aboutImage,
                    'bannerImage' => $bannerImage,
                    'servicesImage'=> $servicesImage,
                    'vacanciesImage' => $vacanciesImage
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'fileName' => $fileName,
                'presscenterImage' => $presscenterImage,
                'salesImage' => $salesImage,
                'aboutImage' => $aboutImage,
                'bannerImage' => $bannerImage,
                'servicesImage'=> $servicesImage,
                'vacanciesImage' => $vacanciesImage
            ]);
        }
    }

    public function actionInit()
    {
        $model = new BlockSettings();

        if ($model->save()) {
            return $this->redirect('update');
        }
    }

    /**
     * Finds the BlockSettings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BlockSettings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BlockSettings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
