<?php
/* Товар не пересчитывается
 *  если у него базовая единица шт, рул, пач
 *  если коэффициент товара равен нулю
 *
 *  Одномерных товаровы - ширина в метрах равна нулю а коэффициент означает вес погонного метра в кг
 *      если длина равна нулю – в списке единиц не должно быть плетей
 *      Базовая единица – ТОННА: тогда дополнительные единицы – ПЛЕТЬ, МЕТР, КГ
 *          Кво в тоннах  = Кво в  метрах * коэффициент/1000
 *          Кво в тоннах  = Кво в  плетях  длина  коэффициент/1000
 *          Кво в тоннах  = Кво в кг / 1000
 *          Кво в метрах =  Кво в тоннах / коэффициент * 1000
 *          Кво в метрах =  Кво в  плетях * длина
 *          Кво в метрах =  Кво в кг / коэффициент
 *          Кво в  плетях = Кво в тоннах / длина / коэффициент *1000
 *          Кво в  плетях = Кво в метрах / длина
 *          Кво в  плетях = Кво в кг / длина / коэффициент
 *          Кво в кг  = Кво в тоннах *1000
 *          Кво в кг  = Кво в  плетях  длина  коэффициент
 *          Кво в кг  = Кво в  метрах * коэффициент
 *      Базовая единица – кг: тогда дополнительные единицы –  МЕТР, ПЛЕТЬ.
 *          Кво в кг= Кво в  метрах * коэффициент
 *          Кво в кг= Кво в  плетях  длина  коэффициент
 *          Кво в метрах =  Кво в  плетях * длина
 *          Кво в метрах =  Кво в кг / коэффициент
 *          Кво в  плетях = Кво в метрах / длина
 *          Кво в  плетях = Кво в кг / длина / коэффициент
 *      Базовая единица – метр: тогда дополнительные единицы –  КГ, ПЛЕТЬ.
 *          Кво в метрах = Кво в кг/ коэффициент
 *          Кво в метрах = Кво в плетях * длина
 *          Кво в кг= Кво в  метрах * коэффициент
 *          Кво в кг= Кво в  плетях  длина  коэффициент
 *          Кво в  плетях = Кво в метрах / длина
 *          Кво в  плетях = Кво в кг / длина / коэффициент
 *
 *  для двумерных товаров – у них ширина в метрах не равна нулю, а коэффициент означает вес листа в кг.
 *      если длина или ширина (для двумерных товаров) равна нулю – в списке единиц не должно быть листов
 *      Базовая единица – тонна: тогда дополнительные единицы – КВ. МЕТР, ЛИСТ, КГ
 *          Кво в тоннах  = Кво в  кв. метрах/длина/ширина * коэффициент / 1000
 *          Кво в тоннах  = Кво в  листах * коэффициент / 1000
 *          Кво в тоннах  = Кво в кг / 1000
 *          Кво в  кв. метрах = Кво в тоннах   длина  ширина / коэффициент * 1000
 *          Кво в  кв. метрах = Кво в  листах  длина  ширина
 *          Кво в  кв. метрах = Кво в кг  длина  ширина / коэффициент
 *          Кво в  листах = Кво в тоннах / коэффициент * 1000
 *          Кво в  листах = Кво в кг / коэффициент
 *          Кво в  листах = Кво в  кв. метрах / длина / ширина
 *          Кво в кг = Кво в  кв. метрах/длина/ширина * коэффициент
 *          Кво в кг = Кво в  листах * коэффициент
 *          Кво в кг  = Кво в тоннах * 1000
 *      Базовая единица – кг: тогда дополнительные единицы –  кв. метр, лист.
 *          Кво в кг    =  Кво в  кв. метрах/длина/ширина * коэффициент
 *          Кво в кг    =  Кво в  листах * коэффициент
 */

namespace app\components;
use Yii;


class Calculator
{
    /**
     * @param $coeffifcient
     * @param $qtyT
     */
    static public function qtyMFromT($coeffifcient, $qtyT=1)
    {
        return $qtyT / $coeffifcient * 1000;
    }

    /**
     * @param $qtyM - колличество штук в метрах, которое приходится на N тонн
     * @param $priceT - цена за N тонн
     * @return float
     */
//    static public function priceMFromT($qtyM, $priceT)
//    {
//        return $priceT / $qtyM;
//    }

    static public function qtyShtFromT($coeffifcient, $length, $qtyT = 1)
    {
        return ($qtyT * 1000)/ ($coeffifcient * $length );
    }

//    static public function priceShtFromT($qtySht, $priceT)
//    {
//        return $priceT / $qtySht;
//    }
    static public function qtyMFromKg($coef ,$qty =1)
    {
        return $qty / $coef;
    }
    static public function qtyShtFromKg($coef, $lenght,$qty =1)
    {
        return $qty / ($lenght * $coef);
    }
    static public function qtyKgFromM($coef, $qty =1)
    {
        return $qty * $coef;
    }
    static public function qtyShtFromM($coef, $length, $qty =1)
    {
        return $qty / ($coef * $length);
    }
    /*Двумерные товары*/
    static public function qtyM2FromT2($width, $length, $coef, $qtyT=1)
    {
        return (($qtyT * $width * $length) / ($coef / 1000));
    }
    static public function qtyListFromT2($coef, $qtyT=1)
    {
        return ($qtyT / ($coef / 1000));
    }
    static public function qtyKgFromT2($qtyT=1)
    {
        return ($qtyT * 1000);
    }
    static public function qtyM2FromKg2($width, $length, $coef, $qtyT=1)
    {
        return (($qtyT * $width * $length) / $coef);
    }
    static public function qtyListFromKg2($coef, $qtyT=1)
    {
        return ($qtyT / $coef);
    }
    static public function qtyKgFromM22($width, $length, $coef, $qtyT=1)
    {
        return (($qtyT * $coef) /($width * $length));
    }
    static public function qtyListFromM22($width, $length, $qtyT=1)
    {
        return ($qtyT /($width * $length));
    }

    static public function calcPrice($qty, $price)
    {
        return $price / $qty;
    }

    /** Товар не пересчитывается
     *  если у него базовая единица шт, рул, пач
     *  если коэффициент товара равен нулю
     */
    static public function isRecalculate($item)
    {
        if (!in_array($item->unit_key, ['sht', 'pachka', 'rulon', 'kompl'])) {
            if (($productAddInfo = $item->cityProducts) && $productAddInfo[0]->coefficient != 0) {
               return ((!empty(Yii::$app->params["units2_{$item->unit_key}"]) && $item->width != 0) ||
                   !empty (Yii::$app->params["units_{$item->unit_key}"]));
            }
        }
        return false;
    }

    static public function getOptions($item)
    {
        $optionsData = [];
        $length = $item->length;
        $width = $item->width;
        $productAddInfo = $item->cityProducts;
        $coef = $productAddInfo[0]->coefficient;
        $price = $productAddInfo[0]->price;
        /*двумерный или одномерный*/
        
        if($width != 0 && isset(Yii::$app->params["units2_{$item->unit_key}"])){
            $unitsBase = Yii::$app->params["units2_{$item->unit_key}"]; 
        } else if(isset(Yii::$app->params["units_{$item->unit_key}"])) {
            $unitsBase = Yii::$app->params["units_{$item->unit_key}"];
        } else {
            return [];
        }
        
        array_walk($unitsBase, function (&$item, $key){
            $item = Yii::t('app/units', $item);
        });
        $units = array_keys($unitsBase);

        switch ($item->unit_key) {
            case 't':
                ($width != 0) ? $optionsData = self::getOptionsForT2($length, $width, $coef, $price, $units, $unitsBase) :
                    $optionsData = self::getOptionsForT($length, $width, $coef, $price, $units, $unitsBase);;
                break;
            case 'kg':
                ($width != 0) ? $optionsData = self::getOptionsForKg2($length, $width, $coef, $price, $units, $unitsBase) :
                    $optionsData = self::getOptionsForKg($length, $width, $coef, $price, $units, $unitsBase);
                break;
            case 'm2':
                ($width != 0) ? $optionsData = self::getOptionsForM22($length, $width, $coef, $price, $units,
                    $unitsBase): $optionsData = [];
                break;
            case 'm':
                ($width = 0) ? $optionsData = self::getOptionsForM($length, $width, $coef, $price, $units,
                    $unitsBase) : $optionsData = [];
                break;
        }

        return $optionsData;
    }

    static public function getOptionsForT2($length, $width, $coef, $price, $units, $unitsBase)
    {
        $optionsData = [];
        foreach ($units as $value) {
            $optionsData[$value] = [
                'data-length' => $length,
                'data-width' => $width,
                'data-coefficient' => $coef,
            ];
            switch ($value) {
                case 't':
                    $optionsData[$value]['data-unit'] = 't';
                    $optionsData[$value]['data-price'] = $price;
                    $optionsData[$value]['data-base'] = 1;
                    break;
                case 'm2':
                    $optionsData[$value]['data-unit'] = 'm2';
                    $optionsData[$value]['data-base'] = $t = self::qtyM2FromT2($width, $length, $coef);
                    $optionsData[$value]['data-price'] = self::calcPrice($t, $price);
                    break;
                case 'list':
                    if ($length == 0 || $width == 0) {
                        unset ($optionsData[$value]);
                        unset ($unitsBase[$value]);
                        break;
                    }
                    $optionsData[$value]['data-unit'] = 'list';
                    $optionsData[$value]['data-base'] = $t = self::qtyListFromT2($coef);
                    $optionsData[$value]['data-price'] = self::calcPrice($t, $price);
                    break;
                case 'kg':
                    $optionsData[$value]['data-unit'] = 'kg';
                    $optionsData[$value]['data-base'] = $t = self::qtyKgFromT2();
                    $optionsData[$value]['data-price'] = self::calcPrice($t, $price);
                    break;
            }
        }
        return [$optionsData,$unitsBase];
    }

    static public function getOptionsForKg2($length, $width, $coef, $price, $units, $unitsBase)
    {
        $optionsData = [];
        foreach ($units as $value) {
            $optionsData[$value] = [
                'data-length' => $length,
                'data-width' => $width,
                'data-coefficient' => $coef,
            ];
            switch ($value) {
                case 'kg':
                    $optionsData[$value]['data-unit'] = 'kg';
                    $optionsData[$value]['data-price'] = $price;
                    $optionsData[$value]['data-base'] = 1;
                    break;
                case 'm2':
                    $optionsData[$value]['data-unit'] = 'm2';
                    $optionsData[$value]['data-base'] = $t = self::qtyM2FromKg2($width, $length, $coef);
                    $optionsData[$value]['data-price'] = self::calcPrice($t, $price);
                    break;
                case 'list':
                    if ($length == 0 || $width == 0) {
                        unset ($optionsData[$value]);
                        unset ($unitsBase[$value]);
                        break;
                    }
                    $optionsData[$value]['data-unit'] = 'list';
                    $optionsData[$value]['data-base'] = $t = self::qtyListFromKg2($coef);
                    $optionsData[$value]['data-price'] = self::calcPrice($t, $price);
                    break;
            }

        }
        return [$optionsData, $unitsBase];
    }
    static public function getOptionsForM22($length, $width, $coef, $price, $units, $unitsBase)
    {
        $optionsData = [];
        foreach ($units as $value) {
            $optionsData[$value] = [
                'data-length' => $length,
                'data-width' => $width,
                'data-coefficient' => $coef,
            ];
            switch ($value) {
                case 'm2':
                    $optionsData[$value]['data-unit'] = 'm2';
                    $optionsData[$value]['data-price'] = $price;
                    $optionsData[$value]['data-base'] = 1;
                    break;
                case 'kg':
                    if ($length == 0 || $width == 0) {
                        unset ($optionsData[$value]);
                        unset ($unitsBase[$value]);
                        break;
                    }
                    $optionsData[$value]['data-unit'] = 'kg';
                    $optionsData[$value]['data-base'] = $t = self::qtyKgFromM22($width, $length, $coef);
                    $optionsData[$value]['data-price'] = self::calcPrice($t, $price);
                    break;
                case 'list':
                    if ($length == 0 || $width == 0) {
                        unset ($optionsData[$value]);
                        unset ($unitsBase[$value]);
                        break;
                    }
                    $optionsData[$value]['data-unit'] = 'list';
                    $optionsData[$value]['data-base'] = $t = self::qtyListFromM22($width, $length);
                    $optionsData[$value]['data-price'] = self::calcPrice($t, $price);
                    break;
            }

        }
        return [$optionsData, $unitsBase];
    }
    static public function getOptionsForT($length, $width, $coef, $price, $units, $unitsBase)
    {
        $optionsData = [];
        foreach ($units as $value) {
            $optionsData[$value] = [
                'data-length' => $length,
                'data-width' => $width,
                'data-coefficient' => $coef,
            ];
            switch ($value) {
                case 't':
                    $optionsData[$value]['data-unit'] = 't';
                    $optionsData[$value]['data-price'] = $price;
                    $optionsData[$value]['data-base'] = 1;
                    break;
                case 'm':
                    $optionsData[$value]['data-unit'] = 'm';
                    $optionsData[$value]['data-base'] = $t = self::qtyMFromT($coef, 1);
                    $optionsData[$value]['data-price'] = self::calcPrice($t, $price);
                    break;
                case 'sht':
                    if ($length == 0) {
                        unset ($optionsData[$value]);
                        unset ($unitsBase[$value]);
                        break;
                    }
                    $optionsData[$value]['data-unit'] = 'sht';
                    $optionsData[$value]['data-base'] = $t = self::qtyShtFromT($coef, $length);
                    $optionsData[$value]['data-price'] = self::calcPrice($t, $price);
                    break;
            }

        }
        return [$optionsData, $unitsBase];
    }
    static public function getOptionsForKg($length, $width, $coef, $price, $units, $unitsBase)
    {
        $optionsData = [];
        foreach ($units as $value) {
            $optionsData[$value] = [
                'data-length' => $length,
                'data-width' => $width,
                'data-coefficient' => $coef,
            ];
            switch ($value) {
                case 'kg':
                    $optionsData[$value]['data-unit'] = 'kg';
                    $optionsData[$value]['data-price'] = $price;
                    $optionsData[$value]['data-base'] = 1;
                    break;
                case 'm':
                    $optionsData[$value]['data-unit'] = 'm';
                    $optionsData[$value]['data-base'] = $t = self::qtyMFromKg($coef);
                    $optionsData[$value]['data-price'] = self::calcPrice($t, $price);
                    break;
                case 'sht':
                    if ($length == 0) {
                        unset ($optionsData[$value]);
                        unset ($unitsBase[$value]);
                        break;
                    }
                    $optionsData[$value]['data-unit'] = 'sht';
                    $optionsData[$value]['data-base'] = $t = self::qtyShtFromKg($coef, $length);
                    $optionsData[$value]['data-price'] = self::calcPrice($t, $price);
                    break;
            }

        }
        return [$optionsData, $unitsBase];
    }
    static public function getOptionsForM($length, $width, $coef, $price, $units, $unitsBase)
    {
        $optionsData = [];
        foreach ($units as $value) {
            $optionsData[$value] = [
                'data-length' => $length,
                'data-width' => $width,
                'data-coefficient' => $coef,
            ];
            switch ($value) {
                case 'm':
                    $optionsData[$value]['data-unit'] = 'm';
                    $optionsData[$value]['data-price'] = $price;
                    $optionsData[$value]['data-base'] = 1;
                    break;
                case 'kg':
                    $optionsData[$value]['data-unit'] = 'kg';
                    $optionsData[$value]['data-base'] = $t = self::qtyKgFromM($coef);
                    $optionsData[$value]['data-price'] = self::calcPrice($t, $price);
                    break;
                case 'sht':
                    if ($length == 0) {
                        unset ($optionsData[$value]);
                        unset ($unitsBase[$value]);
                        break;
                    }
                    $optionsData[$value]['data-unit'] = 'sht';
                    $optionsData[$value]['data-base'] = $t = self::qtyShtFromKg($coef, $length);
                    $optionsData[$value]['data-price'] = self::calcPrice($t, $price);
                    break;
            }
        }
        return [$optionsData, $unitsBase];
    }
}