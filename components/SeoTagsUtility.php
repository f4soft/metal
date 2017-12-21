<?php
namespace app\components;
use Yii;
use app\models\SeoTags;
use app\components\Helper;

class SeoTagsUtility
{
    public static $active = false;

    public static $title = null;

    public static $description = null;

    public static $cities = [
        'kiev' => [
            'ru' => [
                'name' => 'Киев',
                'name1' => 'Киеве',
                'name2' => 'Киеву',
            ],
            'ua' => [
                'name' => 'Київ',
                'name1' => 'Києві',
                'name2' => 'Києві',
            ],
            'tel' => '(044) 461 54 72'
        ],
        'vinnitsa' => [
            'ru' => [
                'name' => 'Винница',
                'name1' => 'Виннице',
                'name2' => 'Виннице',
            ],
            'ua' => [
                'name' => 'Вінниця',
                'name1' => 'Вінниці',
                'name2' => 'Вінниці',
            ],
            'tel' => '(432) 50-88-07'
        ],
        'dnepr' => [
            'ru' => [
                'name' => 'Днепр',
                'name1' => 'Днепре',
                'name2' => 'Днепру',
            ],
            'ua' => [
                'name' => 'Дніпро',
                'name1' => 'Дніпрі',
                'name2' => 'Дніпрі',
            ],
            'tel' => '(056) 729-51-00, (056) 729-51-57'
        ],
        'lvov' => [
            'ru' => [
                'name' => 'Львов',
                'name1' => 'Львове',
                'name2' => 'Львову',
            ],
            'ua' => [
                'name' => 'Львів',
                'name1' => 'Львові',
                'name2' => 'Львові',
            ],
            'tel' => '(032) 245-01-50 (032) 245-01-53'
        ],
        'odessa' => [
            'ru' => [
                'name' => 'Одесса',
                'name1' => 'Одессе',
                'name2' => 'Одессе',
            ],
            'ua' => [
                'name' => 'Одеса',
                'name1' => 'Одесі',
                'name2' => 'Одесі',
            ],
            'tel' => '(048) 789-67-89'
        ],
        'kharkov' => [
            'ru' => [
                'name' => 'Харьков',
                'name1' => 'Харькове',
                'name2' => 'Харькову',
            ],
            'ua' => [
                'name' => 'Харків',
                'name1' => 'Харкові',
                'name2' => 'Харкові',
            ],
            'tel' => '(057) 751-95-10'
        ],
        'poltava' => [
            'ru' => [
                'name' => 'Полтава',
                'name1' => 'Полтаве',
                'name2' => 'Полтаве',
            ],
            'ua' => [
                'name' => 'Полтава',
                'name1' => 'Полтаві',
                'name2' => 'Полтаві',
            ],
            'tel' => '(0532) 610-910'
        ],
    ];

//    const CITY = ''

    public static function setMetaTags($title = null, $description = null)
    {
        SeoTagsUtility::$active = true;
        SeoTagsUtility::$title = $title;
        SeoTagsUtility::$description = $description;
    }

    public static function setCategoryMetaTags($category, $view = "catalog")
    {
        $lang = Yii::$app->params['langs'][Yii::$app->language];
        $city = Yii::$app->request->get('city') ? Yii::$app->request->get('city') : 'kiev';
        
        $meta_data = [];
        
        $url_individual = "/{$lang}/[city]/$view/{$category->alias}";
        
        if($category->meta_keywords && $category->meta_description && $view == "catalog"){
            $meta_data['title'] = $category->meta_keywords;
            $meta_data['description'] = $category->meta_description;
        }
        
        if(!$meta_data){
            $tags = SeoTags::getMetaTags($url_individual);
            if($tags){
                $meta_data['title'] = $tags->title;
                $meta_data['description'] = $tags->description;
            }
        }        
        
        if ($meta_data) {
            $replace = SeoTagsUtility::$cities[$city][$lang]['name1'];
            $title = Helper::str_replace_first('[city]',$replace , $meta_data['title']);

            $description = Helper::str_replace_first('[city]', $replace, $meta_data['description']);
            $replace = SeoTagsUtility::$cities[$city][$lang]['name2'];
            $description = Helper::str_replace_first('[city]', $replace, $description);
            $replace = SeoTagsUtility::$cities[$city]['tel'];
            $description = Helper::str_replace_first('[tel]', $replace, $description);

            SeoTagsUtility::setMetaTags($title, $description);
        }
    }

    public static function setSubCategoryMetaTags($subcategory, $view = "catalog")
    {
        $request_get = Yii::$app->request->get();
        $lang = Yii::$app->params['langs'][Yii::$app->language];
        $city = Yii::$app->request->get('city') ? Yii::$app->request->get('city') : 'kiev';
        
        $meta_data = [];
        
        $url_template = "/{$lang}/[city]/$view/[category]/[subcategory]";
        $url_individual = "/{$lang}/[city]/$view/{$request_get['category']}/{$request_get['subcategory']}";      
        
        if($subcategory->meta_keywords && $subcategory->meta_description && $view == "catalog"){
            $meta_data['title'] = $subcategory->meta_keywords;
            $meta_data['description'] = $subcategory->meta_description;
        }
        
        if(!$meta_data){
            $tags = SeoTags::getMetaTags($url_individual);
            if($tags){
                $meta_data['title'] = $tags->title;
                $meta_data['description'] = $tags->description;
            }
        }
        
        if(!$meta_data){
            $tags = SeoTags::getMetaTags($url_template);
            if($tags){
                $meta_data['title'] = $tags->title;
                $meta_data['description'] = $tags->description;
            }            
        }        
        
        if ($meta_data) {
            $replace = SeoTagsUtility::$cities[$city][$lang]['name1'];
            $title = Helper::str_replace_first('[city]',$replace , $meta_data['title']);

            $description = Helper::str_replace_first('[city]', $replace, $meta_data['description']);
            $replace = SeoTagsUtility::$cities[$city][$lang]['name2'];
            $description = Helper::str_replace_first('[city]', $replace, $description);
            $replace = $subcategory->title;
            $title = Helper::str_replace_first('[subcategory]', $replace, $title);
            $description = Helper::str_replace_first('[subcategory]', $replace, $description);
            $replace = SeoTagsUtility::$cities[$city]['tel'];
            $description = Helper::str_replace_first('[tel]', $replace, $description);

            SeoTagsUtility::setMetaTags($title, $description);
        }
    }

    public static function setProductMetaTags($product)
    {
        $request_get = Yii::$app->request->get();
        $lang = Yii::$app->params['langs'][Yii::$app->language];
        $city = Yii::$app->request->get('city') ? Yii::$app->request->get('city') : 'kiev';
        
        $meta_data = [];
        
        $url_template = "/{$lang}/[city]/catalog/[category]/[subcategory]/[product]";
        $url_individual = "/{$lang}/[city]/catalog/{$request_get['category']}/{$request_get['subcategory']}/{$request_get['alias']}";
        
        if($product->meta_keywords && $product->meta_description){
            $meta_data['title'] = $product->meta_keywords;
            $meta_data['description'] = $product->meta_description;
        }
        
        if(!$meta_data){
            $tags = SeoTags::getMetaTags($url_individual);
            if($tags){
                $meta_data['title'] = $tags->title;
                $meta_data['description'] = $tags->description;
            }
        }
        
        if(!$meta_data){
            $tags = SeoTags::getMetaTags($url_template);
            if($tags){
                $meta_data['title'] = $tags->title;
                $meta_data['description'] = $tags->description;
            }            
        }  
        
        if ($meta_data) {
            $replace = SeoTagsUtility::$cities[$city][$lang]['name1'];
            $title = Helper::str_replace_first('[city]',$replace , $meta_data['title']);

            $description = Helper::str_replace_first('[city]', $replace, $meta_data['description']);
            $replace = SeoTagsUtility::$cities[$city][$lang]['name2'];
            $description = Helper::str_replace_first('[city]', $replace, $description);
            $replace = $product->title;
            $title = Helper::str_replace_first('[product]', $replace, $title);
            $description = Helper::str_replace_first('[product]', $replace, $description);
            $replace = SeoTagsUtility::$cities[$city]['tel'];
            $description = Helper::str_replace_first('[tel]', $replace, $description);

            SeoTagsUtility::setMetaTags($title, $description);
        }
    }
}
