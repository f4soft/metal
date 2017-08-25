<?php

namespace app\components;
use Yii;
use kartik\helpers\Html;
use yii\helpers\Json;

class Helper
{
    public static function feedbackStatus($status = 0) {

        switch ($status) {
            case 0:
                $label = Yii::t('app', 'Новый');
                $type = 'TYPE_DANGER';
                break;
            case 1:
                $label = Yii::t('app', 'Рассмотрено');
                $type = 'TYPE_SUCCESS';
                break;
        }


        return Html::bsLabel($label, constant("\kartik\helpers\Html::{$type}")) . "&nbsp;&nbsp;";
    }

    static public function checkCaptcha($postfields)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));

        $response = curl_exec($ch);

        if (curl_error($ch)) {
            die('Unable to connect: ' . curl_errno($ch) . ' - ' . curl_error($ch));
        }

        curl_close($ch);

        return Json::decode($response);
    }

    static public function str_replace_first($search, $replace, $subject)
    {
        $pos = strpos($subject, $search);
        if ($pos !== false) {
            return substr_replace($subject, $replace, $pos, strlen($search));
        }
        return $subject;
    }

    public static function getWord($number, $suffix)
    {
        $keys = array(2, 0, 1, 1, 1, 2);
        $mod = $number % 100;
        $suffix_key = ($mod > 7 && $mod < 20) ? 2 : $keys[min($mod % 10, 5)];
        return $suffix[$suffix_key];
    }

    static public function setUserNewsletterLanguage($lang)
    {
        switch ($lang) {
            case 'en':
                \Yii::$app->language = 'en-US';
                \Yii::$app->formatter->locale = 'en-US';
                break;
            case 'ua':
                \Yii::$app->language = 'uk-UA';
                \Yii::$app->formatter->locale = 'uk-UA';
                break;

            default:
                \Yii::$app->language = 'ru-RU';
                \Yii::$app->formatter->locale = 'ru-RU';
                break;
        }
    }
}