<?php

namespace app\models;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "block_settings".
 *
 * @property integer $id
 * @property string $presscenter_price
 * @property string $presscenter_price_ru
 * @property string $presscenter_price_ua
 * @property string $presscenter_price_en
 * @property string $presscenter_price_image_ru
 * @property string $presscenter_price_image_ua
 * @property string $presscenter_price_image_en
 * @property string $presscenter_price_image_alt_ru
 * @property string $presscenter_price_image_alt_ua
 * @property string $presscenter_price_image_alt_en
 * @property string $presscenter_price_image_title_ru
 * @property string $presscenter_price_image_title_ua
 * @property string $presscenter_price_image_title_en
 * @property string $sales_image
 * @property string $sales_image_alt_ru
 * @property string $sales_image_alt_ua
 * @property string $sales_image_alt_en
 * @property string $sales_image_title_ru
 * @property string $sales_image_title_ua
 * @property string $sales_image_title_en
 * @property string $vacancy_description_ru
 * @property string $vacancy_description_ua
 * @property string $vacancy_description_en
 * @property string $vacancy_offer_description_ru
 * @property string $vacancy_offer_description_ua
 * @property string $vacancy_offer_description_en
 * @property string $services_description_ru
 * @property string $services_description_ua
 * @property string $services_description_en
 * @property string $services_offer_description_ru
 * @property string $services_offer_description_ua
 * @property string $services_offer_description_en
 * @property string $about_main_description_ru
 * @property string $about_main_description_ua
 * @property string $about_main_description_en
 * @property string $about_mission_description_ru
 * @property string $about_mission_description_ua
 * @property string $about_mission_description_en
 * @property string $about_strategy_description_ru
 * @property string $about_strategy_description_ua
 * @property string $about_strategy_description_en
 * @property string $offices_description_ru
 * @property string $offices_description_ua
 * @property string $offices_description_en
 * @property integer $newsletter_enable
 * @property string $catalog_page_seo_title_ru
 * @property string $catalog_page_seo_title_ua
 * @property string $catalog_page_seo_title_en
 * @property string $catalog_page_seo_description_ru
 * @property string $catalog_page_seo_description_ua
 * @property string $catalog_page_seo_description_en
 * @property string $cart_banner_ru
 * @property string $cart_banner_ua
 * @property string $cart_banner_en
 * @property string $services_banner_ru
 * @property string $services_banner_ua
 * @property string $services_banner_en
 * @property string $vacancies_banner_ru
 * @property string $vacancies_banner_ua
 * @property string $vacancies_banner_en
 */
class BlockSettings extends BaseModel
{
    public $presscenter_price;
    public $presscenter_price_image;
    public $presscenter_price_image_alt;
    public $presscenter_price_image_title;
    public $vacancy_description;
    public $vacancy_offer_description;
    public $services_description;
    public $services_offer_description;
    public $about_main_description;
    public $about_mission_description;
    public $about_strategy_description;
    public $our_goal_description;
    public $offices_description;
    public $catalog_page_seo_title;
    public $catalog_page_seo_description;
    public $sales_image_alt;
    public $sales_image_title;
    public $about_image_title;
    public $about_image_alt;
    public $about_main_page_description;
    public $cart_banner;
    public $services_banner;
    public $vacancies_banner;

    public function behaviors()
    {
        return [];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'block_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['newsletter_enable'], 'integer'],
            [['presscenter_price_ru','presscenter_price_ua','presscenter_price_en',], 'file', 'extensions' => 'pdf', 'maxSize' => Yii::$app->params['fileMaxSize']],
            [['presscenter_price_image_ua','presscenter_price_image_ru','presscenter_price_image_en', 'sales_image',
                'about_image', 'cart_banner_ru', 'cart_banner_ua', 'cart_banner_en',
                'services_banner_ru', 'services_banner_ua', 'services_banner_en', 'vacancies_banner_ru', 'vacancies_banner_ua', 'vacancies_banner_en'],
                'file', 'extensions' => 'png, jpg', 'maxSize' => Yii::$app->params['maxSize']],
            [
                [
                    'presscenter_price_image_alt_ru', 'presscenter_price_image_alt_ua',
                    'presscenter_price_image_alt_en', 'presscenter_price_image_title_ru',
                    'presscenter_price_image_title_ua', 'presscenter_price_image_title_en',
                    'catalog_page_seo_title_ru', 'catalog_page_seo_title_ua', 'catalog_page_seo_title_en',
                    'sales_image_alt_ru', 'sales_image_alt_ua', 'sales_image_alt_en', 
                    'sales_image_title_ru', 'sales_image_title_ua', 'sales_image_title_en', 'about_image_alt_ru',
                    'about_image_alt_ua', 'about_image_alt_en', 'about_image_title_ru', 'about_image_title_ua',
                    'about_image_title_en'
                ], 'string', 'max' => 255],
            [[
                'vacancy_description_ru', 'vacancy_description_ua', 'vacancy_description_en',
                'vacancy_offer_description_ru', 'vacancy_offer_description_ua',
                'vacancy_offer_description_en', 'services_offer_description_ru', 'services_offer_description_ua',
                'services_offer_description_en', 'services_description_ru', 'services_description_ua',
                'services_description_en', 'about_main_description_ru', 'about_main_description_ua',
                'about_main_description_en','about_mission_description_ru','about_mission_description_ua',
                'about_mission_description_en', 'about_strategy_description_ru','about_strategy_description_ua',
                'about_strategy_description_en','our_goal_description_ru', 'our_goal_description_ua',
                'our_goal_description_en', 'offices_description_ru', 'offices_description_en',
                'offices_description_ua', 'catalog_page_seo_description_ru', 'catalog_page_seo_description_ua',
                'catalog_page_seo_description_en', 'about_main_page_description_ru', 'about_main_page_description_ua',
                'about_main_page_description_en'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/admin', 'ID'),
            'presscenter_price_ru' => Yii::t('app/admin', 'Справочник для страницы прессцентра'),
            'presscenter_price_ua' => Yii::t('app/admin', 'Справочник для страницы прессцентра'),
            'presscenter_price_en' => Yii::t('app/admin', 'Справочник для страницы прессцентра'),
            'presscenter_price_image_ru' => Yii::t('app/admin', 'Фото для справочника на странице прессцентра'),
            'presscenter_price_image_ua' => Yii::t('app/admin', 'Фото для справочника на странице прессцентра'),
            'presscenter_price_image_en' => Yii::t('app/admin', 'Фото для справочника на странице прессцентра'),
            'presscenter_price_image_alt_ru' => Yii::t('app/admin', 'Альтернативный текст для фото справочника на странице прессцентра'),
            'presscenter_price_image_alt_ua' => Yii::t('app/admin', 'Альтернативный текст для фото справочника на странице прессцентра'),
            'presscenter_price_image_alt_en' => Yii::t('app/admin', 'Альтернативный текст для фото справочника на странице прессцентра'),
            'presscenter_price_image_title_ru' => Yii::t('app/admin', 'Заголовок для фото справочника на странице прессцентра'),
            'presscenter_price_image_title_ua' => Yii::t('app/admin', 'Заголовок для фото справочника на странице прессцентра'),
            'presscenter_price_image_title_en' => Yii::t('app/admin', 'Заголовок для фото справочника на странице прессцентра'),

            'sales_image' => Yii::t('app/admin', 'Фото для баннера спецпредложений на главной'),
            'sales_image_alt_ru' => Yii::t('app/admin', 'Альтернативный текст для фото баннера спецпредложений на главной'),
            'sales_image_alt_ua' => Yii::t('app/admin', 'Альтернативный текст для фото баннера спецпредложений на главной'),
            'sales_image_alt_en' => Yii::t('app/admin', 'Альтернативный текст для фото баннера спецпредложений на главной'),
            'sales_image_title_ru' => Yii::t('app/admin', 'Заголовок для фото прайса баннера спецпредложений на главной'),
            'sales_image_title_ua' => Yii::t('app/admin', 'Заголовок для фото прайса баннера спецпредложений на главной'),
            'sales_image_title_en' => Yii::t('app/admin', 'Заголовок для фото прайса баннера спецпредложений на главной'),

            'vacancy_description_ru' => Yii::t('app/admin', 'Короткое описание на странице вакансий'),
            'vacancy_description_ua' => Yii::t('app/admin', 'Короткое описание на странице вакансий'),
            'vacancy_description_en' => Yii::t('app/admin', 'Короткое описание на странице вакансий'),

            'vacancy_offer_description_ru' => Yii::t('app/admin', 'Цели на странице вакансий'),
            'vacancy_offer_description_ua' => Yii::t('app/admin', 'Цели на странице вакансий'),
            'vacancy_offer_description_en' => Yii::t('app/admin', 'Цели на странице вакансий'),

            'services_description_ru' => Yii::t('app/admin', 'Короткое описание на странице услуг'),
            'services_description_ua' => Yii::t('app/admin', 'Короткое описание на странице услуг'),
            'services_description_en' => Yii::t('app/admin', 'Короткое описание на странице услуг'),

            'services_offer_description_ru' => Yii::t('app/admin', 'Цели на странице услуг'),
            'services_offer_description_ua' => Yii::t('app/admin', 'Цели на странице услуг'),
            'services_offer_description_en' => Yii::t('app/admin', 'Цели на странице услуг'),

            'about_main_description_ru' => Yii::t('app/admin', 'Описание на странице компании'),
            'about_main_description_ua' => Yii::t('app/admin', 'Описание на странице компании'),
            'about_main_description_en' => Yii::t('app/admin', 'Описание на странице компании'),

            'about_mission_description_ru' => Yii::t('app/admin', 'Описание миссии на странице компании'),
            'about_mission_description_ua' => Yii::t('app/admin', 'Описание миссии на странице компании'),
            'about_mission_description_en' => Yii::t('app/admin', 'Описание миссии на странице компании'),

            'about_strategy_description_ru' => Yii::t('app/admin', 'Описание стратегии на странице компании'),
            'about_strategy_description_ua' => Yii::t('app/admin', 'Описание стратегии на странице компании'),
            'about_strategy_description_en' => Yii::t('app/admin', 'Описание стратегии на странице компании'),

            'our_goal_description_ru' => Yii::t('app/admin', 'Описание целей на странице компании'),
            'our_goal_description_ua' => Yii::t('app/admin', 'Описание целей на странице компании'),
            'our_goal_description_en' => Yii::t('app/admin', 'Описание целей на странице компании'),

            'offices_description_ru' => Yii::t('app/admin', 'Описание на странице филиалов'),
            'offices_description_ua' => Yii::t('app/admin', 'Описание на странице филиалов'),
            'offices_description_en' => Yii::t('app/admin', 'Описание на странице филиалов'),

            'newsletter_enable' => Yii::t('app/admin', 'Новостная рассылка'),

            'about_image' => Yii::t('app/admin', 'Фото для блока "О компании" на главной'),

            'about_image_alt_ru' => Yii::t('app/admin', 'Альтернативный текст фото блока "О компании" на главной'),
            'about_image_alt_en' => Yii::t('app/admin', 'Альтернативный текст фото блока "О компании" на главной'),
            'about_image_alt_ua' => Yii::t('app/admin', 'Альтернативный текст фото блока "О компании" на главной'),

            'about_image_title_ru' => Yii::t('app/admin', 'Заголовок фото блока "О компании" на главной'),
            'about_image_title_en' => Yii::t('app/admin', 'Заголовок текст фото блока "О компании" на главной'),
            'about_image_title_ua' => Yii::t('app/admin', 'Заголовок текст фото блока "О компании" на главной'),

            'about_main_page_description_ru' => Yii::t('app/admin', 'Описание блока "О компании" на главной'),
            'about_main_page_description_ua' => Yii::t('app/admin', 'Описание блока "О компании" на главной'),
            'about_main_page_description_en' => Yii::t('app/admin', 'Описание блока "О компании" на главной'),

            'cart_banner_ru' => Yii::t('app/admin', 'Баннер в корзине'),
            'cart_banner_ua' => Yii::t('app/admin', 'Баннер в корзине'),
            'cart_banner_en' => Yii::t('app/admin', 'Баннер в корзине'),

            'services_banner_ru' => Yii::t('app/admin', 'Баннер на странице услуг'),
            'services_banner_ua' => Yii::t('app/admin', 'Баннер на странице услуг'),
            'services_banner_en' => Yii::t('app/admin', 'Баннер на странице услуг'),

            'vacancies_banner_ru' => Yii::t('app/admin', 'Баннер на странице вакансий'),
            'vacancies_banner_ua' => Yii::t('app/admin', 'Баннер на странице вакансий'),
            'vacancies_banner_en' => Yii::t('app/admin', 'Баннер на странице вакансий'),
        ];
    }

    public function afterFind()
    {
        $this->presscenter_price = $this->{self::getTranslate('presscenter_price')};
        $this->presscenter_price_image = $this->{self::getTranslate('presscenter_price_image')};
        $this->presscenter_price_image_alt = $this->{self::getTranslate('presscenter_price_image_alt')};
        $this->presscenter_price_image_title = $this->{self::getTranslate('presscenter_price_image_title')};
        $this->vacancy_description = $this->{self::getTranslate('vacancy_description')};
        $this->vacancy_offer_description = $this->{self::getTranslate('vacancy_offer_description')};
        $this->services_description = $this->{self::getTranslate('services_description')};
        $this->services_offer_description = $this->{self::getTranslate('services_offer_description')};
        $this->about_main_description = $this->{self::getTranslate('about_main_description')};
        $this->about_mission_description = $this->{self::getTranslate('about_mission_description')};
        $this->about_strategy_description = $this->{self::getTranslate('about_strategy_description')};
        $this->our_goal_description = $this->{self::getTranslate('our_goal_description')};
        $this->offices_description = $this->{self::getTranslate('offices_description')};
        $this->catalog_page_seo_title = $this->{self::getTranslate('catalog_page_seo_title')};
        $this->catalog_page_seo_description = $this->{self::getTranslate('catalog_page_seo_description')};

        $this->sales_image_alt = $this->{self::getTranslate('sales_image_alt')};
        $this->sales_image_title = $this->{self::getTranslate('sales_image_title')};

        $this->about_image_title = $this->{self::getTranslate('about_image_title')};
        $this->about_image_alt = $this->{self::getTranslate('about_image_alt')};
        $this->about_main_page_description = $this->{self::getTranslate('about_main_page_description')};
        $this->cart_banner = $this->{self::getTranslate('cart_banner')};
        $this->services_banner = $this->{self::getTranslate('services_banner')};
        $this->vacancies_banner = $this->{self::getTranslate('vacancies_banner')};

        parent::afterFind();
    }

    public function upload($fileModel)
    {
        if(!is_dir("uploads/block-settings")){
            mkdir("uploads/block-settings", 0777, true);
        }
        if ($this->validate()) {
            if($this->presscenter_price_ru instanceof UploadedFile) {
                $fileName = str_replace(" ", "_", $fileModel->baseName);
                $this->presscenter_price_ru->saveAs(Yii::getAlias('@webroot') . "/uploads/block-settings/" . "{$fileName}.{$fileModel->extension}");
                return true;
            }
            if($this->presscenter_price_ua instanceof UploadedFile) {
                $fileName = str_replace(" ", "_", $fileModel->baseName);
                $this->presscenter_price_ua->saveAs(Yii::getAlias('@webroot') . "/uploads/block-settings/" . "{$fileName}.{$fileModel->extension}");
                return true;
            }
            if($this->presscenter_price_en instanceof UploadedFile) {
                $fileName = str_replace(" ", "_", $fileModel->baseName);
                $this->presscenter_price_en->saveAs(Yii::getAlias('@webroot') . "/uploads/block-settings/" . "{$fileName}.{$fileModel->extension}");
                return true;
            }
            if($this->presscenter_price_image_ru instanceof UploadedFile) {
                $fileName = str_replace(" ", "_", $this->presscenter_price_image_ru->baseName);
                $path = "uploads/block-settings/" . $fileName . '.' . $this->presscenter_price_image_ru->extension;
                $fileOrig = $this->presscenter_price_image_ru->saveAs($path);
                $image = Yii::$app->image->load(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/1140_" . $fileName . '.' . $this->presscenter_price_image_ru->extension;
                $image->resize(1140, 160, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/100_" . $fileName . '.' . $this->presscenter_price_image_ru->extension;
                $image->resize(100, 100, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                return true;
            }
            if($this->presscenter_price_image_ua instanceof UploadedFile) {
                $fileName = str_replace(" ", "_", $this->presscenter_price_image_ua->baseName);
                $path = "uploads/block-settings/" . $fileName . '.' . $this->presscenter_price_image_ua->extension;
                $fileOrig = $this->presscenter_price_image_ua->saveAs($path);
                $image = Yii::$app->image->load(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/1140_" . $fileName . '.' . $this->presscenter_price_image_ua->extension;
                $image->resize(1140, 160, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/100_" . $fileName . '.' . $this->presscenter_price_image_ua->extension;
                $image->resize(100, 100, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                return true;
            }
            if($this->presscenter_price_image_en instanceof UploadedFile) {
                $fileName = str_replace(" ", "_", $this->presscenter_price_image_en->baseName);
                $path = "uploads/block-settings/" . $fileName . '.' . $this->presscenter_price_image_en->extension;
                $fileOrig = $this->presscenter_price_image_en->saveAs($path);
                $image = Yii::$app->image->load(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/1140_" . $fileName . '.' . $this->presscenter_price_image_en->extension;
                $image->resize(1140, 160, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/100_" . $fileName . '.' . $this->presscenter_price_image_en->extension;
                $image->resize(100, 100, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                return true;
            }

            if( $this->sales_image instanceof UploadedFile ) {
                $fileName = str_replace(" ", "_", $this->sales_image->baseName);
                $path = "uploads/block-settings/" . $fileName . '.' . $this->sales_image->extension;
                $fileOrig = $this->sales_image->saveAs($path);
                $image = Yii::$app->image->load(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/720_" . $fileName . '.' . $this->sales_image->extension;
                $image->resize(720, 790, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/100_" . $fileName . '.' . $this->sales_image->extension;
                $image->resize(100, 100, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                return true;
            }

            if( $this->about_image instanceof UploadedFile ) {
                $fileName = str_replace(" ", "_", $this->about_image->baseName);
                $path = "uploads/block-settings/" . $fileName . '.' . $this->about_image->extension;
                $fileOrig = $this->about_image->saveAs($path);
                $image = Yii::$app->image->load(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/1120_" . $fileName . '.' . $this->about_image->extension;
                $image->resize(1120, 514, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/100_" . $fileName . '.' . $this->about_image->extension;
                $image->resize(100, 100, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                return true;
            }

            if( $this->cart_banner_ru instanceof UploadedFile ) {
                $fileName = str_replace(" ", "_", $this->cart_banner_ru->baseName);
                $path = "uploads/block-settings/" . $fileName . '.' . $this->cart_banner_ru->extension;
                $fileOrig = $this->cart_banner_ru->saveAs($path);
                $image = Yii::$app->image->load(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/945_" . $fileName . '.' . $this->cart_banner_ru->extension;
                $image->resize(945, 96, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/100_" . $fileName . '.' . $this->cart_banner_ru->extension;
                $image->resize(100, 50, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                return true;
            }

            if( $this->cart_banner_ua instanceof UploadedFile ) {
                $fileName = str_replace(" ", "_", $this->cart_banner_ua->baseName);
                $path = "uploads/block-settings/" . $fileName . '.' . $this->cart_banner_ua->extension;
                $fileOrig = $this->cart_banner_ua->saveAs($path);
                $image = Yii::$app->image->load(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/945_" . $fileName . '.' . $this->cart_banner_ua->extension;
                $image->resize(945, 96, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/100_" . $fileName . '.' . $this->cart_banner_ua->extension;
                $image->resize(100, 50, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                return true;
            }

            if( $this->cart_banner_en instanceof UploadedFile ) {
                $fileName = str_replace(" ", "_", $this->cart_banner_en->baseName);
                $path = "uploads/block-settings/" . $fileName . '.' . $this->cart_banner_en->extension;
                $fileOrig = $this->cart_banner_en->saveAs($path);
                $image = Yii::$app->image->load(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/945_" . $fileName . '.' . $this->cart_banner_en->extension;
                $image->resize(945, 96, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/100_" . $fileName . '.' . $this->cart_banner_en->extension;
                $image->resize(100, 50, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                return true;
            }

            if( $this->services_banner_ru instanceof UploadedFile ) {
                $fileName = str_replace(" ", "_", $this->services_banner_ru->baseName);
                $path = "uploads/block-settings/" . $fileName . '.' . $this->services_banner_ru->extension;
                $fileOrig = $this->services_banner_ru->saveAs($path);
                $image = Yii::$app->image->load(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/945_" . $fileName . '.' . $this->services_banner_ru->extension;
                $image->resize(1141, 141, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/100_" . $fileName . '.' . $this->services_banner_ru->extension;
                $image->resize(100, 50, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                return true;
            }

            if( $this->services_banner_ua instanceof UploadedFile ) {
                $fileName = str_replace(" ", "_", $this->services_banner_ua->baseName);
                $path = "uploads/block-settings/" . $fileName . '.' . $this->services_banner_ua->extension;
                $fileOrig = $this->services_banner_ua->saveAs($path);
                $image = Yii::$app->image->load(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/945_" . $fileName . '.' . $this->services_banner_ua->extension;
                $image->resize(1141, 141, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/100_" . $fileName . '.' . $this->services_banner_ua->extension;
                $image->resize(100, 50, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                return true;
            }

            if( $this->services_banner_en instanceof UploadedFile ) {
                $fileName = str_replace(" ", "_", $this->services_banner_en->baseName);
                $path = "uploads/block-settings/" . $fileName . '.' . $this->services_banner_en->extension;
                $fileOrig = $this->services_banner_en->saveAs($path);
                $image = Yii::$app->image->load(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/945_" . $fileName . '.' . $this->services_banner_en->extension;
                $image->resize(1141, 141, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/100_" . $fileName . '.' . $this->services_banner_en->extension;
                $image->resize(100, 50, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                return true;
            }
            if( $this->vacancies_banner_ru instanceof UploadedFile ) {
                $fileName = str_replace(" ", "_", $this->vacancies_banner_ru->baseName);
                $path = "uploads/block-settings/" . $fileName . '.' . $this->vacancies_banner_ru->extension;
                $fileOrig = $this->vacancies_banner_ru->saveAs($path);
                $image = Yii::$app->image->load(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/945_" . $fileName . '.' . $this->vacancies_banner_ru->extension;
                $image->resize(945, 81, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/100_" . $fileName . '.' . $this->vacancies_banner_ru->extension;
                $image->resize(100, 50, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                return true;
            }

            if( $this->vacancies_banner_ua instanceof UploadedFile ) {
                $fileName = str_replace(" ", "_", $this->vacancies_banner_ua->baseName);
                $path = "uploads/block-settings/" . $fileName . '.' . $this->vacancies_banner_ua->extension;
                $fileOrig = $this->vacancies_banner_ua->saveAs($path);
                $image = Yii::$app->image->load(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/945_" . $fileName . '.' . $this->vacancies_banner_ua->extension;
                $image->resize(945, 81, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/100_" . $fileName . '.' . $this->vacancies_banner_ua->extension;
                $image->resize(100, 50, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                return true;
            }

            if( $this->vacancies_banner_en instanceof UploadedFile ) {
                $fileName = str_replace(" ", "_", $this->vacancies_banner_en->baseName);
                $path = "uploads/block-settings/" . $fileName . '.' . $this->vacancies_banner_en->extension;
                $fileOrig = $this->vacancies_banner_en->saveAs($path);
                $image = Yii::$app->image->load(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/945_" . $fileName . '.' . $this->vacancies_banner_en->extension;
                $image->resize(945, 81, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                $path = "uploads/block-settings/100_" . $fileName . '.' . $this->vacancies_banner_en->extension;
                $image->resize(100, 50, \yii\image\drivers\Image::CROP)
                    ->save(Yii::getAlias("@webroot/$path"));
                return true;
            }

        } else {
            return false;
        }
    }

    public function getUploadedPressCenterPrices()
    {
       return $data = [
            'ru' => self::getUploadedFilePath($this->presscenter_price_ru),
            'ua' => self::getUploadedFilePath($this->presscenter_price_ua),
            'en' => self::getUploadedFilePath($this->presscenter_price_en),
        ];
    }

    public function getUploadedPressCenterPriceImages()
    {
       return $data = [
            'ru' => self::getAdminPriceImage($this->presscenter_price_image_ru),
            'ua' => self::getAdminPriceImage($this->presscenter_price_image_ua),
            'en' => self::getAdminPriceImage($this->presscenter_price_image_en),
        ];
    }

    public function getUploadedCartBannerImages()
    {
       return $data = [
            'ru' => self::getAdminPriceImage($this->cart_banner_ru),
            'ua' => self::getAdminPriceImage($this->cart_banner_ua),
            'en' => self::getAdminPriceImage($this->cart_banner_en),
        ];
    }

    public function getUploadedServicesBannerImages()
    {
       return $data = [
            'ru' => self::getAdminPriceImage($this->services_banner_ru),
            'ua' => self::getAdminPriceImage($this->services_banner_ua),
            'en' => self::getAdminPriceImage($this->services_banner_en),
        ];
    }

    public function getUploadedVacanciesBannerImages()
    {
       return $data = [
            'ru' => self::getAdminPriceImage($this->vacancies_banner_ru),
            'ua' => self::getAdminPriceImage($this->vacancies_banner_ua),
            'en' => self::getAdminPriceImage($this->vacancies_banner_en),
        ];
    }

    static public function getUploadedFilePath($field)
    {
        if(!$field) {
            return false;
        }
        $t = strpos($field, 'presscenter_price_image');
        if(strpos($field, 'presscenter_price_image') !== false) {
            return Yii::getAlias('@web') . "/uploads/block-settings/100_{$field}";
        }
        return Yii::getAlias('@web') . "/uploads/block-settings/{$field}";
    }

    public function getAdminPriceImage($field)
    {
        if(!$field) {
            return false;
        }
        return Yii::getAlias('@web') . "/uploads/block-settings/100_{$field}";
    }

    static public function getBlockSettingsImage($field, $width = 1140, $height=500)
    {
        if(!$field) {
            return false;
        }
        if(!file_exists(Yii::getAlias('@web') . "/uploads/block-settings/{$width}_{$field}")) {
            $w = !empty($width) ? $width : 1140;
            $h = !empty($height) ? $height : 500;
            $fileOrig = Yii::getAlias("@webroot/uploads/block-settings/$field");
            $imagine = new Imagine();
            $size = new Box($w, $h);
            $mode = ImageInterface::THUMBNAIL_OUTBOUND;
            $image = $imagine->open($fileOrig);
            $_w = $image->getSize()->getWidth();
            if($w != $_w) {
                $image->thumbnail($size, $mode)->save(Yii::getAlias("@webroot/uploads/block-settings/{$width}_{$field}"), [
                    'jpeg_quality' => 60
                ]);
            } else {
                copy(Yii::getAlias("$fileOrig"), Yii::getAlias("@webroot/uploads/block-settings/{$width}_{$field}"));
            }
        }
        return Yii::getAlias('@web') . "/uploads/block-settings/{$width}_{$field}";
    }
}
