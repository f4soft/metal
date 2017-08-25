<?php
namespace app\components;

use yii\helpers\Url;
use yii\helpers\Html;

class BreadcrumbsUtility
{
    /**
     * @param $links array breadcrumbs links (yii\widgets\Breadcrumbs Public property links)
     * @param int $home start breadcrumbs links (if isset home, $home=2. If not isset home, $home=1)
     * @return array breadcrumbs links */
    public static function UseMicroData($links, $home = 2)
    {
        // Get the last array_key
        $_values = array_keys($links);
        $last = array_pop($_values);
        foreach ($links as $key => &$link) {
            if ($key != $last) {
                if (is_array($link)) {
                    $link['label'] = !empty($link['label'])? $link['label']:'';
                    $link['url'] = !empty($link['url'])? $link['url']:'';
                    $link['template'] = BreadcrumbsUtility::getTemplate($link['label'], Url::to([$link['url']]), $key + $home);
                }
            } else {
                $link['label'] = !empty($link['label']) ? $link['label'] : '';
                $link['template'] = BreadcrumbsUtility::getLast($link['label']);
            }
        }
        return $links;
    }

    /**
     * @param $label string name home label
     * @param $url string url link home page
     * @return array */
    public static function getHome($label, $url)
    {
        $home = ['label' => $label, 'url' => $url,
            'template' => '<li class="breadcrumbs-i" itemscope  itemtype = "http://schema.org/ListItem">'.
                            '<a class="novisited breadcrumbs-link" itemprop = "item" href="'. $url.'">'.
                            '<span class="breadcrumbs-title" itemprop = "name">'.$label.
                            "</span></a></li>"
        ];
        return $home;
    }
    /**
     * @param $label string name last label
     * @param $url string url link
     * @return string */
    public static function getLast($label)
    {
        return '<li class="breadcrumbs-i" itemscope  itemtype = "http://schema.org/ListItem">' .
            '<span class="breadcrumbs-title" itemprop = "name">' . $label .
            "</span></li>";
    }

    /**
     * @param $label * @param $url
     * @param $key
     * @return string template microdata
     */
    protected static function getTemplate($label, $url, $key)
    {
        return '<li class="breadcrumbs-i" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">'
            . Html::a('<span class="breadcrumbs-title" itemprop="name">' . $label . '</span>', Url::to($url),
                ['itemprop' => 'item','class'=>'novisited breadcrumbs-link']).'</li>';
    }
}