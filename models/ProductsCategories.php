<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\components\SluggableBehavior;
use creocoder\nestedsets\NestedSetsBehavior;

/**
 * This is the model class for table "products_categories".
 *
 * @property integer $id
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property string $title_ru
 * @property string $title_ua
 * @property string $title_en
 * @property string $title_price_ru
 * @property string $title_price_ua
 * @property string $title_price_en 
 * @property string $image
 * @property string $image_alt_ru
 * @property string $image_alt_ua
 * @property string $image_alt_en
 * @property string $image_title_ru
 * @property string $image_title_ua
 * @property string $image_title_en
 * @property string $meta_keywords_ru
 * @property string $meta_keywords_ua
 * @property string $meta_keywords_en
 * @property string $meta_description_ru
 * @property string $meta_description_ua
 * @property string $meta_description_en
 * @property string $article_title_ru
 * @property string $article_title_ua
 * @property string $article_title_en
 * @property string $article_description_ru
 * @property string $article_description_ua
 * @property string $article_description_en
 * @property string $alias
 * @property string $external_id
 * @property string $related_categories_id
 * @property integer $updated_at
 * @property integer $created_at
 * @property integer $status
 * @property integer $show_price
 * @property integer $show_catalog
 * @property string $file_price_ru
 * @property string $file_price_ua
 * @property string $file_price_en
 * @property string $file_price_vinnitsa_ru
 * @property string $file_price_vinnitsa_ua
 * @property string $file_price_vinnitsa_en 
 * @property string $file_price_dnepr_ru
 * @property string $file_price_dnepr_ua 
 * @property string $file_price_dnepr_en 
 * @property string $file_price_lvov_ru
 * @property string $file_price_lvov_ua
 * @property string $file_price_lvov_en 
 * @property string $file_price_odessa_ru
 * @property string file_price_odessa_ua
 * @property string $file_price_odessa_en 
 * @property string $file_price_kharkov_ru
 * @property string $file_price_kharkov_ua
 * @property string $file_price_kharkov_en 
 * @property string $file_price_chernihiv_ru
 * @property string $file_price_chernihiv_ua
 * @property string $file_price_chernihiv_en  
 * @property string $file_price_khmelnytskyi_ru
 * @property string $file_price_khmelnytskyi_ua
 * @property string $file_price_khmelnytskyi_en  
 * @property string $file_price_poltava_ru
 * @property string $file_price_poltava_ua
 * @property string $file_price_poltava_en 
 * @property string $image_price_ru
 * @property string $image_price_ua
 * @property string $image_price_en
 * @property string $file_catalog_ru
 * @property string $file_catalog_ua
 * @property string $file_catalog_en
 * @property string $image_catalog_ru
 * @property string $image_catalog_ua
 * @property string $image_catalog_en
 */
class ProductsCategories extends BaseModel
{
    public $title;
    public $title_price;
    public $image_alt;
    public $image_title;
    public $meta_keywords;
    public $meta_description;
    public $article_title;
    public $article_description;
    public $page_description;
    public $parent_id;

    public $file_price;
    public $image_price;

    public $file_catalog;
    public $image_catalog;

    public $filePriceRu;
    public $filePriceUa;
    public $filePriceEn;    
    public $filePriceVinnitsaRu;
    public $filePriceVinnitsaUa;
    public $filePriceVinnitsaEn;    
    public $filePriceDneprRu;
    public $filePriceDneprUa;
    public $filePriceDneprEn;    
    public $filePriceLvovRu;
    public $filePriceLvovUa;
    public $filePriceLvovEn;    
    public $filePriceOdessaRu;
    public $filePriceOdessaUa;
    public $filePriceOdessaEn;
    public $filePriceKharkovRu;
    public $filePriceKharkovUa;
    public $filePriceKharkovEn;    
    public $filePriceChernihivRu;
    public $filePriceChernihivUa;
    public $filePriceChernihivEn;    
    public $filePriceKhmelnytskyiRu;
    public $filePriceKhmelnytskyiUa;
    public $filePriceKhmelnytskyiEn;    
    public $filePricePoltavaRu;
    public $filePricePoltavaUa;
    public $filePricePoltavaEn;
    
    public $imagePriceRu;
    public $imagePriceUa;
    public $imagePriceEn;
    public $fileCatalogRu;
    public $fileCatalogUa;
    public $fileCatalogEn;
    public $imageCatalogRu;
    public $imageCatalogUa;
    public $imageCatalogEn;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products_categories';
    }

    public function behaviors()
    {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                 'treeAttribute' => 'tree',
                 'leftAttribute' => 'lft',
                 'rightAttribute' => 'rgt',
                 'depthAttribute' => 'depth',
            ],
            'slug' => [
                'class' => SluggableBehavior::className(),
                'in_attribute' => 'title_ru',
                'out_attribute' => 'alias',
                'translit' => true,
            ],
            TimestampBehavior::className(),
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image'], 'file', 'extensions' => 'png, jpg', 'maxSize' => Yii::$app->params['maxSize']],
            [['file_price_ru','file_price_ua','file_price_en', 'file_catalog_ua','file_catalog_en','file_catalog_ru'], 'file', 'extensions' => 'pdf', 'maxSize' => Yii::$app->params['fileMaxSize']],
            [['file_price_vinnitsa_ru', 'file_price_vinnitsa_ua', 'file_price_vinnitsa_en'], 'file', 'extensions' => 'pdf', 'maxSize' => Yii::$app->params['fileMaxSize']],
            [['file_price_dnepr_ru', 'file_price_dnepr_ua', 'file_price_dnepr_en'], 'file', 'extensions' => 'pdf', 'maxSize' => Yii::$app->params['fileMaxSize']],
            [['file_price_lvov_ru', 'file_price_lvov_ua', 'file_price_lvov_en'], 'file', 'extensions' => 'pdf', 'maxSize' => Yii::$app->params['fileMaxSize']],
            [['file_price_odessa_ru', 'file_price_odessa_ua', 'file_price_odessa_en'], 'file', 'extensions' => 'pdf', 'maxSize' => Yii::$app->params['fileMaxSize']],
            [['file_price_kharkov_ru', 'file_price_kharkov_ua', 'file_price_kharkov_en'], 'file', 'extensions' => 'pdf', 'maxSize' => Yii::$app->params['fileMaxSize']],
            [['file_price_chernihiv_ru', 'file_price_chernihiv_ua', 'file_price_chernihiv_en'], 'file', 'extensions' => 'pdf', 'maxSize' => Yii::$app->params['fileMaxSize']],
            [['file_price_khmelnytskyi_ru', 'file_price_khmelnytskyi_ua', 'file_price_khmelnytskyi_en'], 'file', 'extensions' => 'pdf', 'maxSize' => Yii::$app->params['fileMaxSize']],
            [['file_price_poltava_ru', 'file_price_poltava_ua', 'file_price_poltava_en'], 'file', 'extensions' => 'pdf', 'maxSize' => Yii::$app->params['fileMaxSize']],
            [['image_price_ru','image_price_ua','image_price_en','image_catalog_ru','image_catalog_ua',
                'image_catalog_en'], 'file', 'extensions' => 'png, jpg',
                'maxSize' => Yii::$app->params['maxSize']],
            [['alias'], 'unique'],
            [['lft', 'rgt', 'updated_at', 'created_at', 'status','show_price','show_catalog'], 'integer'],
            [['article_description_ru', 'article_description_ua', 'article_description_en', 'page_description_ru', 'page_description_ua', 'page_description_en'], 'string'],
            [['title_ru', 'title_ua', 'title_en', 'title_price_ru', 'title_price_ua', 'title_price_en', 'image_alt_ru', 'image_alt_ua', 'image_alt_en', 'image_title_ru',
                'image_title_ua', 'image_title_en', 'meta_keywords_ru', 'meta_keywords_ua', 'meta_keywords_en',
                'meta_description_ru', 'meta_description_ua', 'meta_description_en', 'article_title_ru',
                'article_title_ua', 'article_title_en', 'alias', 'external_id',
                'related_categories_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/admin', 'ID'),
            'title_ru' => Yii::t('app/admin', 'Заголовок'),
            'title_ua' => Yii::t('app/admin', 'Заголовок'),
            'title_en' => Yii::t('app/admin', 'Заголовок'),
            'title_price_ru' => Yii::t('app/admin', 'Заголовок для цен'),
            'title_price_ua' => Yii::t('app/admin', 'Заголовок для цен'),
            'title_price_en' => Yii::t('app/admin', 'Заголовок для цен'),
            'image' => Yii::t('app/admin', 'Фото для категории'),
            'image_alt_en' => Yii::t('app/admin', 'Альтернативный текст для фото'),
            'image_alt_ru' => Yii::t('app/admin', 'Альтернативный текст для фото'),
            'image_alt_ua' => Yii::t('app/admin', 'Альтернативный текст для фото'),
            'image_title_en' => Yii::t('app/admin', 'Заголовок для фото'),
            'image_title_ru' => Yii::t('app/admin', 'Заголовок для фото'),
            'image_title_ua' => Yii::t('app/admin', 'Заголовок для фото'),

            'meta_keywords_ru' => Yii::t('app/admin', 'Ключевые слова для метатегов'),
            'meta_keywords_ua' => Yii::t('app/admin', 'Ключевые слова для метатегов'),
            'meta_keywords_en' => Yii::t('app/admin', 'Ключевые слова для метатегов'),
            'meta_description_ru' => Yii::t('app/admin', 'Описание для метатегов'),
            'meta_description_ua' => Yii::t('app/admin', 'Описание для метатегов'),
            'meta_description_en' => Yii::t('app/admin', 'Описание для метатегов'),

            'article_title_ru' => Yii::t('app/admin', 'СЕО заголовок'),
            'article_title_ua' => Yii::t('app/admin', 'СЕО заголовок'),
            'article_title_en' => Yii::t('app/admin', 'СЕО заголовок'),
            'article_description_ru' => Yii::t('app/admin', 'СЕО описание'),
            'article_description_ua' => Yii::t('app/admin', 'СЕО описание'),
            'article_description_en' => Yii::t('app/admin', 'СЕО описание'),
            'page_description_ru' => Yii::t('app/admin', 'Описание страницы'),
            'page_description_ua' => Yii::t('app/admin', 'Описание страницы'),
            'page_description_en' => Yii::t('app/admin', 'Описание страницы'),

            'file_price_ru' => Yii::t('app/admin', 'Прайс'),
            'file_price_ua' => Yii::t('app/admin', 'Прайс'),
            'file_price_en' => Yii::t('app/admin', 'Прайс'),            
            'file_price_vinnitsa_ru' => Yii::t('app/admin', 'Прайс для Винницы'),
            'file_price_vinnitsa_ua' => Yii::t('app/admin', 'Прайс для Винницы'),
            'file_price_vinnitsa_en' => Yii::t('app/admin', 'Прайс для Винницы'),            
            'file_price_dnepr_ru' => Yii::t('app/admin', 'Прайс для Днепра'),
            'file_price_dnepr_ua' => Yii::t('app/admin', 'Прайс для Днепра'),
            'file_price_dnepr_en' => Yii::t('app/admin', 'Прайс для Днепра'),            
            'file_price_lvov_ru' => Yii::t('app/admin', 'Прайс для Львова'),
            'file_price_lvov_ua' => Yii::t('app/admin', 'Прайс для Львова'),
            'file_price_lvov_en' => Yii::t('app/admin', 'Прайс для Львова'),            
            'file_price_odessa_ru' => Yii::t('app/admin', 'Прайс для Одессы'),
            'file_price_odessa_ua' => Yii::t('app/admin', 'Прайс для Одессы'),
            'file_price_odessa_en' => Yii::t('app/admin', 'Прайс для Одессы'),            
            'file_price_kharkov_ru' => Yii::t('app/admin', 'Прайс для Харькова'),
            'file_price_kharkov_ua' => Yii::t('app/admin', 'Прайс для Харькова'),
            'file_price_kharkov_en' => Yii::t('app/admin', 'Прайс для Харькова'),            
            'file_price_chernihiv_ru' => Yii::t('app/admin', 'Прайс для Чернигова'),
            'file_price_chernihiv_ua' => Yii::t('app/admin', 'Прайс для Чернигова'),
            'file_price_chernihiv_en' => Yii::t('app/admin', 'Прайс для Чернигова'),            
            'file_price_khmelnytskyi_ru' => Yii::t('app/admin', 'Прайс для Хмельницкого'),
            'file_price_khmelnytskyi_ua' => Yii::t('app/admin', 'Прайс для Хмельницкого'),
            'file_price_khmelnytskyi_en' => Yii::t('app/admin', 'Прайс для Хмельницкого'),            
            'file_price_poltava_ru' => Yii::t('app/admin', 'Прайс для Полтавы'),
            'file_price_poltava_ua' => Yii::t('app/admin', 'Прайс для Полтавы'),
            'file_price_poltava_en' => Yii::t('app/admin', 'Прайс для Полтавы'),            
            'image_price_ru' => Yii::t('app/admin', 'Картинка для прайса'),
            'image_price_ua' => Yii::t('app/admin', 'Картинка для прайса'),
            'image_price_en' => Yii::t('app/admin', 'Картинка для прайса'),

            'file_catalog_ru' => Yii::t('app/admin', 'Каталог'),
            'file_catalog_ua' => Yii::t('app/admin', 'Каталог'),
            'file_catalog_en' => Yii::t('app/admin', 'Каталог'),
            'image_catalog_ru' => Yii::t('app/admin', 'Картинка для каталога'),
            'image_catalog_ua' => Yii::t('app/admin', 'Картинка для каталога'),
            'image_catalog_en' => Yii::t('app/admin', 'Картинка для каталога'),

            'alias' => Yii::t('app/admin', 'Alias'),
            'updated_at' => Yii::t('app/admin', 'Updated At'),
            'created_at' => Yii::t('app/admin', 'Created At'),
            'parent_id' => Yii::t('app/admin', 'Родительская категория'),
            'status' => Yii::t('app/admin', 'Статус'),
            'show_price' => Yii::t('app/admin', 'Показать/Скрыть прайс'),
            'show_catalog' => Yii::t('app/admin', 'Показать/Скрыть каталог'),
        ];
    }

    public function afterFind()
    {
        $this->title = $this->{self::getTranslate('title')};
        $this->title_price = $this->{self::getTranslate('title_price')};
        $this->image_alt = $this->{self::getTranslate('image_alt')};
        $this->image_title = $this->{self::getTranslate('image_title')};
        $this->meta_keywords = $this->{self::getTranslate('meta_keywords')};
        $this->meta_description = $this->{self::getTranslate('meta_description')};
        $this->article_title = $this->{self::getTranslate('article_title')};
        $this->article_description = $this->{self::getTranslate('article_description')};
        $this->page_description = $this->{self::getTranslate('page_description')};
        
        $this->image_price = $this->{self::getTranslate('image_price')};
        $this->file_catalog = $this->{self::getTranslate('file_catalog')};
        $this->image_catalog = $this->{self::getTranslate('image_catalog')};
        
        $city = \Yii::$app->request->get('city') ? : '';  
        $file_price = 'file_price';
        if($city && $city != "kiev"){
            $file_price = 'file_price_'.$city;
        }
        
        $this->file_price = $this->{self::getTranslate($file_price)};
        
        parent::afterFind();
    }

    public static function find()
    {
        return new MenuQuery(get_called_class());
    }

    public function uploadPrice($lang)
    {
        if(!is_dir("uploads/prices/{$this->id}")){
            mkdir("uploads/prices/{$this->id}", 0777, true);
        }
        if ($this->validate()) {
            switch ($lang) {
                case 'ru':
                    $this->filePriceRu->saveAs("uploads/prices/{$this->id}/" . $this->file_price_ru);
                    break;
                case 'vinnitsa_ru':
                    $this->filePriceVinnitsaRu->saveAs("uploads/prices/{$this->id}/" . $this->file_price_vinnitsa_ru);
                    break;
                case 'dnepr_ru':
                    $this->filePriceDneprRu->saveAs("uploads/prices/{$this->id}/" . $this->file_price_dnepr_ru);
                    break;
                case 'lvov_ru':
                    $this->filePriceLvovRu->saveAs("uploads/prices/{$this->id}/" . $this->file_price_lvov_ru);
                    break;
                case 'odessa_ru':
                    $this->filePriceOdessaRu->saveAs("uploads/prices/{$this->id}/" . $this->file_price_odessa_ru);
                    break;
                case 'kharkov_ru':
                    $this->filePriceKharkovRu->saveAs("uploads/prices/{$this->id}/" . $this->file_price_kharkov_ru);
                    break;
                case 'chernihiv_ru':
                    $this->filePriceChernihivRu->saveAs("uploads/prices/{$this->id}/" . $this->file_price_chernihiv_ru);
                    break;
                case 'khmelnytskyi_ru':
                    $this->filePriceKhmelnytskyiRu->saveAs("uploads/prices/{$this->id}/" . $this->file_price_khmelnytskyi_ru);
                    break;
                case 'poltava_ru':
                    $this->filePricePoltavaRu->saveAs("uploads/prices/{$this->id}/" . $this->file_price_poltava_ru);
                    break;
                case 'ua':
                    $this->filePriceUa->saveAs("uploads/prices/{$this->id}/" . $this->file_price_ua);
                    break;
                case 'vinnitsa_ua':
                    $this->filePriceVinnitsaUa->saveAs("uploads/prices/{$this->id}/" . $this->file_price_vinnitsa_ua);
                    break;
                case 'dnepr_ua':
                    $this->filePriceDneprUa->saveAs("uploads/prices/{$this->id}/" . $this->file_price_dnepr_ua);
                    break;
                case 'lvov_ua':
                    $this->filePriceLvovUa->saveAs("uploads/prices/{$this->id}/" . $this->file_price_lvov_ua);
                    break;
                case 'odessa_ua':
                    $this->filePriceOdessaUa->saveAs("uploads/prices/{$this->id}/" . $this->file_price_odessa_ua);
                    break;
                case 'kharkov_ua':
                    $this->filePriceKharkovUa->saveAs("uploads/prices/{$this->id}/" . $this->file_price_kharkov_ua);
                    break;
                case 'chernihiv_ua':
                    $this->filePriceChernihivUa->saveAs("uploads/prices/{$this->id}/" . $this->file_price_chernihiv_ua);
                    break;
                case 'khmelnytskyi_ua':
                    $this->filePriceKhmelnytskyiUa->saveAs("uploads/prices/{$this->id}/" . $this->file_price_khmelnytskyi_ua);
                    break;
                case 'poltava_ua':
                    $this->filePricePoltavaUa->saveAs("uploads/prices/{$this->id}/" . $this->file_price_poltava_ua);
                    break;
                case 'en':
                    $this->filePriceEn->saveAs("uploads/prices/{$this->id}/" . $this->file_price_en);
                    break;
                case 'vinnitsa_en':
                    $this->filePriceVinnitsaEn->saveAs("uploads/prices/{$this->id}/" . $this->file_price_vinnitsa_en);
                    break;
                case 'dnepr_en':
                    $this->filePriceDneprEn->saveAs("uploads/prices/{$this->id}/" . $this->file_price_dnepr_en);
                    break;
                case 'lvov_en':
                    $this->filePriceLvovEn->saveAs("uploads/prices/{$this->id}/" . $this->file_price_lvov_en);
                    break;
                case 'odessa_en':
                    $this->filePriceOdessaEn->saveAs("uploads/prices/{$this->id}/" . $this->file_price_odessa_en);
                    break;
                case 'kharkov_en':
                    $this->filePriceKharkovEn->saveAs("uploads/prices/{$this->id}/" . $this->file_price_kharkov_en);
                    break;
                case 'chernihiv_en':
                    $this->filePriceChernihivEn->saveAs("uploads/prices/{$this->id}/" . $this->file_price_chernihiv_en);
                    break;
                case 'khmelnytskyi_en':
                    $this->filePriceKhmelnytskyiEn->saveAs("uploads/prices/{$this->id}/" . $this->file_price_khmelnytskyi_en);
                    break;
                case 'poltava_en':
                    $this->filePricePoltavaEn->saveAs("uploads/prices/{$this->id}/" . $this->file_price_poltava_en);
                    break;
            }
            return true;
        } else {
            return false;
        }
    }
    public function uploadPriceImage($lang)
    {
        if(!is_dir("uploads/prices/{$this->id}")){
            mkdir("uploads/prices/{$this->id}", 0777, true);
        }
        if ($this->validate()) {
            switch ($lang) {
                case 'ru':
                    $path = "uploads/prices/{$this->id}/" . $this->image_price_ru;
                    $fileOrig = $this->imagePriceRu->saveAs($path);
                    $image = Yii::$app->image->load(Yii::getAlias("@webroot/$path"));
                    $image->resize(1140, 190)->save(Yii::getAlias("@webroot/$path"));
                    break;
                case 'ua':
                    $path = "uploads/prices/{$this->id}/" . $this->image_price_ua;
                    $fileOrig = $this->imagePriceUa->saveAs($path);
                    $image = Yii::$app->image->load(Yii::getAlias("@webroot/$path"));
                    $image->resize(1140, 190)->save(Yii::getAlias("@webroot/$path"));
                    break;
                case 'en':
                    $path = "uploads/prices/{$this->id}/" . $this->image_price_en;
                    $fileOrig = $this->imagePriceEn->saveAs($path);
                    $image = Yii::$app->image->load(Yii::getAlias("@webroot/$path"));
                    $image->resize(1140, 190)->save(Yii::getAlias("@webroot/$path"));
                    break;
            }
            return true;
        } else {
            return false;
        }
    }

    public function uploadCatalog($lang)
    {
        if(!is_dir("uploads/catalogs/{$this->id}")){
            mkdir("uploads/catalogs/{$this->id}", 0777, true);
        }
        if ($this->validate()) {
            switch ($lang) {
                case 'ru':
                    $this->fileCatalogRu->saveAs("uploads/catalogs/{$this->id}/" . $this->file_catalog_ru);
                    break;
                case 'ua':
                    $this->fileCatalogUa->saveAs("uploads/catalogs/{$this->id}/" . $this->file_catalog_ua);
                    break;
                case 'en':
                    $this->fileCatalogEn->saveAs("uploads/catalogs/{$this->id}/" . $this->file_catalog_en);
                    break;
            }
            return true;
        } else {
            return false;
        }
    }

    public function uploadCatalogImage($lang)
    {
        if(!is_dir("uploads/catalogs/{$this->id}")){
            mkdir("uploads/catalogs/{$this->id}", 0777, true);
        }
        if ($this->validate()) {
            switch ($lang) {
                case 'ru':
                    $path = "uploads/catalogs/{$this->id}/" . $this->image_catalog_ru;
                    $fileOrig = $this->imageCatalogRu->saveAs($path);
                    $image = Yii::$app->image->load(Yii::getAlias("@webroot/$path"));
                    $image->resize(1140, 190)->save(Yii::getAlias("@webroot/$path"));
                    break;
                case 'ua':
                    $path = "uploads/catalogs/{$this->id}/" . $this->image_catalog_ua;
                    $fileOrig = $this->imageCatalogUa->saveAs($path);
                    $image = Yii::$app->image->load(Yii::getAlias("@webroot/$path"));
                    $image->resize(1140, 190)->save(Yii::getAlias("@webroot/$path"));
                    break;
                case 'en':
                    $path = "uploads/catalogs/{$this->id}/" . $this->image_catalog_en;
                    $fileOrig = $this->imageCatalogEn->saveAs($path);
                    $image = Yii::$app->image->load(Yii::getAlias("@webroot/$path"));
                    $image->resize(1140, 190)->save(Yii::getAlias("@webroot/$path"));
                    break;
            }
            return true;
        } else {
            return false;
        }
    }

    public function getPriceImagePath()
    {
        if(!$this->image_price) {
            return false;
        }

        return "uploads/prices/{$this->id}/{$this->image_price}";
    }

    public function getCatalogImagePath()
    {
        if(!$this->image_catalog) {
            return false;
        }

        return "uploads/catalogs/{$this->id}/{$this->image_catalog}";
    }

    public static function getCategoriesTree($all = false)
    {
        $items = [];
        $root = self::findOne(['alias' => 'menu']);
        if($roots = $root->children(1)->all()) {
            foreach ($roots as $root) {
                $rootItem = self::findOne(['id' => $root->id]);
                if(!$all) {
                    $items[$root->title_ru] = [];
                } else {
                    $items[$root->id] = $root->title_ru;
                }
                if($children = $rootItem->children()->all()) {
                    foreach ($children as $child) {
                        if(!$all) {
                            $items[$root->title_ru][$child->id] = $child->title_ru;
                        } else {
                            $items[$child->id] = "-" . $child->title_ru;
                        }
                    }
                }

            }
        }
        return $items;
    }

    /**
     * Get roots categories
     * @return array
     */
    public static function getCategoriesRoots()
    {
        $items = [];
        $root = self::findOne(['alias' => 'menu']);
        if($roots = $root->children(1)->all()) {
            foreach ($roots as $root) {
                $items[] = $root;
             }
        }

        return $items;
    }
    
    /**
     * Get roots categories with sale products
     * @return array
     */
    public static function getCategorieSaleRoot()
    {
//        var_dump('123'); exit();
        
//        $root = self::find()->where(['alias' => 'menu']);                
//                ->innerJoinWith([
//                    'products' => function ($query){ $query->onCondition(['products.stock' => 1]); },
//                    ])
//                            ->innerJoinWith(['products'])
//                ->where(['products.alias' => 'menu']);
        
//        \yii\helpers\VarDumper::dump($root->one()->title); exit();
        //var_dump($sales->createCommand()->sql); exit();
        
        $items = [];
        $root = self::findOne(['alias' => 'menu']);      
        if($roots = $root->children(1)->all()) {
            foreach ($roots as $root) {    
                $sales = self::checkSales($root['lft'], $root['rgt']);
                if($sales){
                    $items[] = $root;
                }               
            }
        }
        
        return $items;
    }    

    /**
     * Get children categories
     * @param $root
     * @return array
     */

    public static function getCategoriesChildren($root, $num=false)
    {
        $items = [];
        $key = 0;
        if($categories = $root->children()->all()) {
            foreach ($categories as $category) {
                if($num && $key < $num && $category->status) {
                    $items[] = $category;
                    $key++;
                } elseif(!$num && $category->status) {
                    $items[] = $category;
                }
            }
        }
        return $items;
    }
    
    public static function getCategoriesSaleChildren($root, $num=false)
    {
        $items = [];
        $key = 0;
        if($categories = $root->children()->all()) {
            foreach ($categories as $category) {
                $sales = self::checkSales($category->lft, $category->rgt);
                if($sales){                
                    if($num && $key < $num && $category->status) {
                        $items[] = $category;
                        $key++;
                    } elseif(!$num && $category->status) {
                        $items[] = $category;
                    }
                }
            }
        }
        return $items;
    }

    public static function getRelatedCategories($relatedIDs)
    {
        if(!$relatedIDs)
            return false;
        $result = false;
        $relatedIDs = explode(';', trim($relatedIDs, ';'));
        foreach ($relatedIDs as $id) {
            $result[] = self::findOne(['id' => $id]);
        }

        return $result;
    }

    public static function getRootCategory($catID)
    {
        $cat = self::findOne(['id' => $catID]);
        return $cat->parents(1)->one();
    }

    public function getPriceFiles()
    {
        return $data = [
            "ru" => "uploads/prices/{$this->id}/{$this->file_price_ru}",
            "vinnitsa_ru" => "uploads/prices/{$this->id}/{$this->file_price_vinnitsa_ru}", 
            "dnepr_ru" => "uploads/prices/{$this->id}/{$this->file_price_dnepr_ru}", 
            "lvov_ru" => "uploads/prices/{$this->id}/{$this->file_price_lvov_ru}", 
            "odessa_ru" => "uploads/prices/{$this->id}/{$this->file_price_odessa_ru}", 
            "kharkov_ru" => "uploads/prices/{$this->id}/{$this->file_price_kharkov_ru}", 
            "chernihiv_ru" => "uploads/prices/{$this->id}/{$this->file_price_chernihiv_ru}", 
            "khmelnytskyi_ru" => "uploads/prices/{$this->id}/{$this->file_price_khmelnytskyi_ru}", 
            "poltava_ru" => "uploads/prices/{$this->id}/{$this->file_price_poltava_ru}",       

            "ua" => "uploads/prices/{$this->id}/{$this->file_price_ua}",
            "vinnitsa_ua" => "uploads/prices/{$this->id}/{$this->file_price_vinnitsa_ua}",
            "dnepr_ua" => "uploads/prices/{$this->id}/{$this->file_price_dnepr_ua}",
            "lvov_ua" => "uploads/prices/{$this->id}/{$this->file_price_lvov_ua}",
            "odessa_ua" => "uploads/prices/{$this->id}/{$this->file_price_odessa_ua}",
            "kharkov_ua" => "uploads/prices/{$this->id}/{$this->file_price_kharkov_ua}",
            "chernihiv_ua" => "uploads/prices/{$this->id}/{$this->file_price_chernihiv_ua}",
            "khmelnytskyi_ua" => "uploads/prices/{$this->id}/{$this->file_price_khmelnytskyi_ua}",
            "poltava_ua" => "uploads/prices/{$this->id}/{$this->file_price_poltava_ua}",

            "en" => "uploads/prices/{$this->id}/{$this->file_price_en}",
            "vinnitsa_en" => "uploads/prices/{$this->id}/{$this->file_price_vinnitsa_en}",
            "dnepr_en" => "uploads/prices/{$this->id}/{$this->file_price_dnepr_en}",
            "lvov_en" => "uploads/prices/{$this->id}/{$this->file_price_lvov_en}",
            "odessa_en" => "uploads/prices/{$this->id}/{$this->file_price_odessa_en}",
            "kharkov_en" => "uploads/prices/{$this->id}/{$this->file_price_kharkov_en}",
            "chernihiv_en" => "uploads/prices/{$this->id}/{$this->file_price_chernihiv_en}",
            "khmelnytskyi_en" => "uploads/prices/{$this->id}/{$this->file_price_khmelnytskyi_en}",
            "poltava_en" => "uploads/prices/{$this->id}/{$this->file_price_poltava_en}",
        ];
    }
    public function getPriceImagesFiles()
    {
        return $data = [
            'ru'=> "uploads/prices/{$this->id}/{$this->image_price_ru}",
            'ua'=> "uploads/prices/{$this->id}/{$this->image_price_ua}",
            'en'=> "uploads/prices/{$this->id}/{$this->image_price_en}",
        ];
    }
    public function getCatalogFiles()
    {
        return $data = [
            'ru'=> "uploads/catalogs/{$this->id}/{$this->file_catalog_ru}",
            'ua'=> "uploads/catalogs/{$this->id}/{$this->file_catalog_ua}",
            'en'=> "uploads/catalogs/{$this->id}/{$this->file_catalog_en}",
        ];
    }
    public function getCatalogImagesFiles()
    {
        return $data = [
            'ru'=> "uploads/catalogs/{$this->id}/{$this->image_catalog_ru}",
            'ua'=> "uploads/catalogs/{$this->id}/{$this->image_catalog_ua}",
            'en'=> "uploads/catalogs/{$this->id}/{$this->image_catalog_en}",
        ];
    }
    
    public static function checkSales($left, $right)
    {
        return self::find()
            ->select('`products`.`id`')                        
            ->leftJoin('products', '`products`.`category_id` = `products_categories`.`id`')
            ->where("`products_categories`.`lft` >= '$left' AND `products_categories`.`rgt` <= '$right'")
            ->andWhere("`products`.`stock` = 1")
            ->limit(1)
            ->one();
    }
    
    public static function getSubcategorySaleRand()
    {
        return self::find()
                ->select('`products_categories`.*')
                ->leftJoin('products', '`products`.`category_id` = `products_categories`.`id`')
                ->where("`products_categories`.`depth` = 2")
                ->andWhere("`products`.`stock` = 1")
                ->orderBy(new \yii\db\Expression('rand()'))
                ->limit(10)
                ->all();
    }
    
    public function getFullAlias()
    {        
        $result = $this->alias;        
        $iter_depth = $this->depth;
        $iter_depth --;
        
        while($iter_depth){          
            $parent = $this->parents($iter_depth)->one();
            $result = $parent->alias . '/' . $result;
            $iter_depth --;
        }
        
        return '/' . $result;
    }
}