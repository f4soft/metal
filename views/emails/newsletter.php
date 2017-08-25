<?php
$baseUrl = Yii::$app->params['homeUrl'];
?>

<table class="table-button big-blue btn watch-all-news"
       style="font-family:Arial, Helvetica, sans-serif; margin:0; padding:40px 0 50px; text-align:center; width:600px; max-width:600px; margin:0 auto; border-bottom:1px solid #D5D5D5;"
       align="center">
    <tr>
        <td>
            <table class="table-body table-news" border="0" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; margin:0; padding:0; background-color:#F6F6F6" bgcolor="#F6F6F6">
                <tr>
                    <th>
                        <table class="top-blue" style="font-family:Arial, Helvetica, sans-serif; margin:0; padding:0; background-color:#283891; height:30px; width:100%" bgcolor="#283891" height="30" width="100%"><tr><td style="padding:0"></td></tr></table>
                    </th>
                </tr>
                <tr>
                    <td class="logo-cell" style="padding:0; padding-top:40px; text-align:center" align="center">
                        <img src="<?=$baseUrl?>img/email/logo.png" alt="" style="border:none; max-width:100%"></td>
                </tr>
                <tr>
                    <td class="subtitle-cell" style="padding:0; color:#283891; font-size:16px; padding-top:10px; text-align:center; border-bottom:1px solid #D5D5D5; padding-bottom:30px" align="center"><?= Yii::t('app', 'Самый большой выбор металлопроката', [], $lang == 'en' ? Yii::$app->params['langs'][\Yii::$app->language] : null)?></td>
                </tr>
                <tr>
                    <td class="news-title" style="padding:0; font-size:18px; font-weight:800; padding-bottom:15px; padding-top:40px; text-align:center; text-transform:uppercase" align="center"><?= Yii::t('app', 'Новости', [], $lang == 'en' ? Yii::$app->params['langs'][\Yii::$app->language] : null)?></td>
                </tr>
                    <tr class="news-list-row">
                        <td style="padding:0">
                            <?php if($news): ?>
                                <?php foreach ($news as $item):?>
                                    <table class="table-news-list-i" style="font-family:Arial, Helvetica, sans-serif; margin:auto; padding:15px 0; width:85%" width="85%">
                                        <tr>
                                            <td rowspan="3" colspan="3" style="padding:0">
                                                <?= \kartik\helpers\Html::a(\kartik\helpers\Html::img("{$baseUrl}images/news/{$item->id}/130_{$item->image}",
                                                    ['alt' => $item->image_alt, 'title' => $item->image_title, 'style'=>'border:none; width:130px;height:130px; ']),
                                                    "{$baseUrl}{$lang}/presscenter/news/{$item->alias}")?>
                                            </td>
                                            <td colspan="7" class="news-item-title" style="padding:0; padding-left:20px; font-size:17px;text-align:left;">
                                                <a href="<?= "{$baseUrl}{$lang}/presscenter/news/{$item->alias}"?>" style="border:none; color:inherit; text-decoration:none">
                                                    <?= \yii\helpers\StringHelper::truncate(htmlspecialchars(strip_tags($item->title)), 100)?>
                                                </a></td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" class="news-item-date" style="padding:0; padding-left:20px;text-align:left;"><span style="background-color:#CCC; color:#fff; display:inline-block; font-size:14px; padding:5px 20px" bgcolor="#CCCCCC">
                                                <?= Yii::$app->formatter->asDate($item->created_at)?>
                                            </span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" class="news-item-short-desc" style="padding:0; padding-left:20px; font-size:15px; width: 368px;text-align:left;">
                                                <?= \yii\helpers\StringHelper::truncate(htmlspecialchars(strip_tags($item->description)), 200)?>
                                            </td>
                                        </tr>
                                    </table>
                                <?php endforeach;?>
                            <?php endif;?>
                            <table class="table-button big-blue btn watch-all-news" style="font-family:Arial, Helvetica, sans-serif; margin:0; padding:40px 0 50px; text-align:center; width:100%; border-bottom:1px solid #D5D5D5" align="center" width="100%">
                                <tr>
                                    <td style="padding:0">
                                        <a href= "<?=$baseUrl.$lang.'/presscenter/news' ?>"  style="border:none; background-color:#283891; color:#fff; font-size:18px; font-weight:700; padding:15px 25px; text-decoration:none" bgcolor="#283891"><?= Yii::t('app', 'Смотреть все новости', [], $lang == 'en' ? Yii::$app->params['langs'][\Yii::$app->language] : null) ?></a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                <tr>
                    <td class="news-title"
                        style="padding:0; font-size:18px; font-weight:800; padding-bottom:15px; padding-top:40px; text-align:center; text-transform:uppercase"
                        align="center"><?= Yii::t('app', 'Спецпредложения', [], $lang == 'en' ? Yii::$app->params['langs'][\Yii::$app->language] : null) ?></td>
                </tr>
                <tr>
                    <td style="padding:0">
                        <?php if($sales):?>
                            <?php foreach ($sales as $sale):?>
                                <table class="table-news-list-i" style="font-family:Arial, Helvetica, sans-serif; margin:auto; padding:15px 0; width:85%" width="85%">
                                    <tr>
                                        <td rowspan="3" colspan="3" style="padding:0">
                                            <?= \kartik\helpers\Html::a(\kartik\helpers\Html::img("{$baseUrl}images/sales/{$sale->id}/250_{$sale->image}", ['class'=> 'news-preview-img', 'alt'=>$sale->image_alt, 'title'=>$sale->image_title, 'style' => 'border:none;width:130px;height:auto;'])
                                                , "{$baseUrl}{$lang}/sales/{$sale->alias}")?>
                                        </td>
                                        <td colspan="7" class="news-item-title" style="padding:0; padding-left:20px; font-size:17px;text-align:left;">
                                            <a href="<?=$baseUrl.$lang.'/sales/'.$sale->alias;?>" style="border:none; color:inherit; font-size:inherit; text-decoration:none">
                                                <?= \yii\helpers\StringHelper::truncate(htmlspecialchars(strip_tags($sale->title)), 100)?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" class="news-item-date" style="padding:0; padding-left:20px;text-align:left;">
                                        <span style="background-color:#CCC; color:#fff; display:inline-block; font-size:14px; padding:5px 20px" bgcolor="#CCCCCC">
                                            <?= Yii::$app->formatter->asDate($sale->created_at)?>
                                        </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" class="news-item-short-desc" style="padding:0; padding-left:20px; font-size:15px; width: 368px;text-align:left;">
                                            <?= yii\helpers\StringHelper::truncate(htmlspecialchars(strip_tags($sale->description)), 200)?>
                                        </td>
                                    </tr>
                                </table>

                            <?php endforeach;?>
                        <?php endif;?>
                        <table class="table-button big-blue btn to-catalog" style="font-family:Arial, Helvetica, sans-serif; margin:0; padding:40px 0 50px; text-align:center; width:100%" align="center" width="100%">
                            <tr>
                                <td style="padding:0"><a href="<?="{$baseUrl}{$lang}"?>/catalog" style="border:none; background-color:#283891; color:#fff; font-size:18px; font-weight:700; padding:15px 25px; text-decoration:none" bgcolor="#283891"><?= Yii::t('app', 'Перейти к каталогу', [], $lang == 'en' ? Yii::$app->params['langs'][\Yii::$app->language] : null)?></a></td>
                            </tr>
                        </table>
                        <table class="table-button big-blue btn to-catalog" style="font-family:Arial, Helvetica, sans-serif; margin:0; padding:40px 0 50px; text-align:center; width:100%" align="center" width="100%">
                            <tr>
                                <td style="padding:0"><a href="<?="{$baseUrl}{$lang}"?>/subscribe/unsubscribe?code=<?=$user->hash?>&id=<?=$user->id?>" style="border:none; background-color:#283891; color:#fff; font-size:18px; font-weight:700; padding:15px 25px; text-decoration:none" bgcolor="#283891"><?= Yii::t('app', 'Отписаться от рассылки', [], $lang == 'en' ? Yii::$app->params['langs'][\Yii::$app->language] : null)?></a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="last-row">
                    <td style="padding:0">
                        <table class="footer-table" style="font-family:Arial, Helvetica, sans-serif; margin:0; padding:0; background-color:#283891; color:#fff; width:100%" bgcolor="#283891" width="100%">
                            <tr>
                                <td class="social-cell" style="padding:20px 0 20px 200px; font-size:11px; text-align:center;" align="center">
                                    <a href="https://www.linkedin.com/company/metal-holding-jsc" class="soc-link" style="padding:0;"><img src="<?=$baseUrl?>img/email/linkedin.png" alt=""/></a>
                                </td>
                                <td class="social-cell" style="padding:20px 10px; font-size:11px; text-align:center;" align="center"><a href="#" class="soc-link" style="padding:0;"><img src="<?=$baseUrl?>img/email/youtube.png" alt=""></a>
                                </td>
                                <td class="social-cell" style="padding:20px 10px; font-size:11px; text-align:center;" align="center"><a href="https://www.facebook.com/metalholding/" class="soc-link" style="padding:0;"><img src="<?=$baseUrl?>img/email/facebook.png" alt=""></a></td>
                                <td class="social-cell" style="padding:20px 200px 20px 0; font-size:11px; text-align:center;" align="center"><a href="https://www.instagram.com/metal_holding/" class="soc-link" style="padding:0;"><img src="<?=$baseUrl?>img/email/instagramm.png" alt=""></a></td>
                                </td>
                            </tr>
                            <tr>
                                <td  colspan="4" style="padding:10px 0 0; font-size:11px; text-align:center" align="center"><?= Yii::t('app', '03039, Киев, Саперно-Слободской проезд, 30', [], $lang == 'en' ? Yii::$app->params['langs'][\Yii::$app->language] : null) ?></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="padding:0; font-size:11px; text-align:center" align="center">(044) 461 54 72</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="copyright" style="padding:20px 200px; font-size:11px; text-align:center; color:#6e7ed8" align="center"><a href="#" style="border:none; color:#6e7ed8; text-decoration:none">© 2007-2017 «Metal •  Holding»</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
