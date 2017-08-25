<?php
    $baseUrl = Yii::$app->params['homeUrl'];
    $units = Yii::$app->params['units'];
?>
<table class="main-table" border="0" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; margin:0 auto; padding:0; max-width:600px; width:600px" width="600">
  <tr>
    <td>
      <table class="table-body table-confirm" border="0" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; margin:0; padding:0; background-color:#F6F6F6" bgcolor="#F6F6F6">
        <tr>
          <th>
            <table class="top-blue" style="font-family:Arial, Helvetica, sans-serif; margin:0; padding:0; background-color:#283891; height:30px; width:100%" bgcolor="#283891" height="30" width="100%"><tr><td style="padding:0 70px"></td></tr></table>
          </th>
        </tr>
        <tr>
          <td class="logo-cell" style="padding:0 70px; padding-top:40px; text-align:center" align="center"><img src="<?=$baseUrl?>img/email/logo.png" alt="" style="border:none; max-width:100%"></td>
        </tr>
        <tr>
          <td class="subtitle-cell" style="padding:0 70px; color:#283891; font-size:16px; padding-top:10px; text-align:center" align="center">Самый большой выбор металлопроката</td>
        </tr>
        <tr>
          <td class="confirm-text-big" style="padding:40px 120px 40px; color:#151515; font-size:24px; font-weight:800; padding-top:40px; text-align:center; line-height:1" align="center">Ваш заказ <span class="order-number">№<?= $order->id?></span> успешно принят!</td>
        </tr>
        <tr class="table-order-row">
          <td style="padding:0">
            <table class="table-order-header" style="font-family:Arial, Helvetica, sans-serif; margin:auto; padding:0; background-color:#283891; color:#fff; font-size:13px; width:85%" bgcolor="#283891" width="85%">
              <tr class="header-row">
                <td style="padding:8px 0; color:#fff; font-size:14px; text-align:left; white-space:nowrap; padding-left:15px" align="left">Наименование</td>
                <td style="padding:8px 0; color:#fff; font-size:14px; text-align:center; white-space:nowrap;width: 125px;text-align:center;" align="center"><?= Yii::t('app', 'Кол-во') ?></td>
                <td style="padding:8px 0; color:#fff; font-size:14px; text-align:center; white-space:nowrap;width: 125px;text-align:left;" align="left">Стоимость (грн)</td>
              </tr>
            </table>
          </td>
        </tr>
        <tr class="table-order-row">
          <td style="padding:0">
            <table class="table-order-body" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; margin:auto; padding:0; background-color:#fff; border:1px solid #283891; border-collapse:collapse; width:85%" bgcolor="#ffffff" width="85%">
                <?php foreach ($products as $product): ?>
            <tr>
              <td style="padding:15px 0; padding-left:15px;border-bottom:1px solid #9E9E9E"><?= $product->getProductTitle()?></td>
              <td style="padding:15px 0;border-bottom:1px solid #9E9E9E;width:125px;text-align:center;"><?= $product->count ?><?= $units[$product->unit] ?>.</td>
              <td style="padding:15px 0;border-bottom:1px solid #9E9E9E;width:125px;text-align:left;"><?= $product->price ?> грн</td>
            </tr>
                <?php endforeach; ?>
            <tr style="">
              <td style="padding:15px 0 5px 15px;font-weight:600;">
                    <?=Yii::t('app', 'Общая стоимость заказа')?>
              </td>
            <td style="padding:15px 0 5px;font-weight:600;"></td>
            <td style="padding:15px 0 5px;font-weight:600;"><?= $order->sum ?> грн</td>
            </tr>
            <tr style="border:none">
              <td style="padding:5px 0 15px 15px;font-weight:600">
                    Общий вес заказа
              </td>
            <td style="padding:5px 0 15px;font-weight:600"></td>
            <td style="padding:5px 0 15px;font-weight:600"><?= round($order->weight*1000,2) ?> кг.</td>
            </tr>
            <tr style="border-bottom:1px solid #9E9E9E">
              <td style="padding:15px 0; padding-left:15px">
              <?php if($order->delivery):?>
                <span class="delivery true">Доставка <img src="<?=$baseUrl?>img/email/checkbox.png" alt="" style="border:none; padding-left:5px;padding-right:10px;"></span>
              <?php endif; ?>
              <?php if ($order->cutting): ?>
                <span class="cutting  true">Порезка <img src="<?=$baseUrl?>img/email/checkbox.png" alt="" style="border:none; padding-left:5px;padding-right:10px;"></span>
              <?php endif; ?>
            </td>
            <td style="padding:15px 0"></td>
            <td style="padding:15px 0"></td>
            </tr>
            </table>
          </td>
        </tr>
      <?php if (!empty($user)): ?>
          <tr>
              <td style="padding:0 45px; color:#323232; font-size:13px; padding-top:20px">Данные клиента:</td>
          </tr>
          <?php if (!empty($user->name)): ?>
          <tr>
              <td style="padding:0 45px; color:#323232; font-size:13px; padding-top:20px">Имя: <?= $user->name ?></td>
          </tr>
          <?php endif; ?>
          <?php if (!empty($user->company)): ?>
          <tr>
              <td style="padding:0 45px; color:#323232; font-size:13px; padding-top:20px">Компания:
                  <?= $user->company ?></td>
          </tr>
          <tr>
              <td style="padding:0 45px; color:#323232; font-size:13px; padding-top:20px">ИНН:
                  <?= $user->inn ?></td>
          </tr>
          <tr>
              <td style="padding:0 45px; color:#323232; font-size:13px; padding-top:20px">OKPO:
                  <?= $user->okpo ?></td>
          </tr>
          <?php endif; ?>
          <tr>
              <td style="padding:0 45px; color:#323232; font-size:13px; padding-top:20px">Телефон:
                  <?= $user->phone ?></td>
          </tr>
          <tr>
              <td style="padding:0 45px; color:#323232; font-size:13px; padding-top:20px">Email:
                  <?= $user->email ?></td>
          </tr>
          <tr>
              <td style="padding:0 45px; color:#323232; font-size:13px; padding-top:20px">Город:
                  <?= $user->city ?></td>
          </tr>
          <?php if (!empty($mes)):?>
          <tr>
              <td style="padding:0 45px; color:#323232; font-size:13px; padding-top:20px">Сообщение:
                  <?= $mes ?></td>
          </tr>
          <?php endif;?>
      <?php endif; ?>
        <tr>
          <td style="padding:0 45px; color:#323232; font-size:13px; padding-top:20px">Номер вашей заявки: <span class="order-number" style="font-size:13px; font-weight:800"><?= $order->id ?></span>
</td>
        </tr>
        <tr>
          <td class="small-text s-t-2" style="padding:0 45px; color:#323232; font-size:13px; padding-bottom:45px">Ваш заказ получен для обработки. Наш менеджер свяжется с Вами в ближайшее время.</td>
        </tr>

        <tr class="last-row">
          <td style="padding:0">
            <table class="footer-table" style="font-family:Arial, Helvetica, sans-serif; margin:0; padding:0; background-color:#283891; color:#fff; width:100%" bgcolor="#283891" width="100%">
              <!-- <td colspan=2></td> -->
              <tr>

                <td class="social-cell" style="padding:20px 200px; font-size:11px; text-align:center" align="center">
                    <a href="https://www.linkedin.com/company/metal-holding-jsc" class="soc-link"
                       style="padding:0 10px"><img
                                src="<?=$baseUrl?>img/email/linkedin.png" alt=""></a>
                    <a href="#" class="soc-link" style="padding:0 10px"><img
                                src="<?=$baseUrl?>img/email/youtube.png" alt=""></a>
                    <a href="https://www.facebook.com/metalholding/" class="soc-link" style="padding:0 10px"><img
                                src="<?=$baseUrl?>img/email/facebook.png" alt=""></a>
                    <a href="https://www.instagram.com/metal_holding/" class="soc-link" style="padding:0 10px"><img
                                src="<?=$baseUrl?>img/email/instagramm.png" alt=""></a>
</td>
              </tr>
              <tr>
                <td style="padding:0; font-size:11px; text-align:center" align="center">03039, Киев, Саперно-Слободской проезд, 30</td>
              </tr>
              <tr>
                <td style="padding:0; font-size:11px; text-align:center" align="center">(044) 461 54 72</td>
              </tr>
              <tr>
                <td colspan="" class="copyright" style="padding:20px 200px; font-size:11px; text-align:center; color:#6e7ed8" align="center"><a href="#" style="border:none; color:#6e7ed8; text-decoration:none">© 2007-2016 «Metal •  Holding»</a></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
