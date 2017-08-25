<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Offices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offices-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    $items = [
        [
            'label' => 'Русский',
            'content' => $this->render('_form_ru', [
                'form' => $form,
                'model' => $model,
            ]),
            'active' => true
        ],
        [
            'label' => 'Украинский',
            'content' => $this->render('_form_ua', [
                'form' => $form,
                'model' => $model,
            ]),
        ],
        [
            'label' => 'Английский',
            'content' => $this->render('_form_en', [
                'form' => $form,
                'model' => $model,
            ]),
        ]
    ];
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app/admin', 'Создать') : Yii::t('app/admin', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Отменить', '/admin/offices', ['class' => 'btn btn-default'])?>
    </div>

    <div class="row">
        <div class="col-xs-6">

            <div id="map" class="col-xs-12" style="height: 300px; margin: 20px 0;"></div>

            <?= $form->field($model, 'status')->checkbox() ?>

            <?= $form->field($model, 'is_main')->checkbox() ?>

            <?= $form->field($model, 'lat')->hiddenInput()->label(false) ?>

            <?= $form->field($model, 'long')->hiddenInput()->label(false) ?>

            <?= $form->field($model, 'zoom')->hiddenInput()->label(false) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'city_id')->dropDownList($cities, ["prompt" => "Выберете значение"]) ?>

        </div>
        <div class="col-xs-6">
            <?= \kartik\tabs\TabsX::widget([
                'items' => $items,
                'position' => \kartik\tabs\TabsX::POS_ABOVE,
                'encodeLabels' => false
            ]);?>
        </div>

    </div>

    <script>
        var map;
        var marker;
        var geocoder;
        function initMap() {
            var lat, lng , zoom;

            geocoder = new google.maps.Geocoder();

            if(document.getElementById('offices-lat').value > 0) {
                lat = parseFloat(document.getElementById('offices-lat').value);
            } else {
                lat = 50.4501;
                document.getElementById('offices-lat').value = lat;
            }

            if(document.getElementById('offices-long').value > 0) {
                lng = parseFloat(document.getElementById('offices-long').value);

            } else {
                lng = 30.5234;
                document.getElementById('offices-long').value = lng;
            }

            if(document.getElementById('offices-zoom').value > 0) {
                zoom = parseInt(document.getElementById('offices-zoom').value);
            } else {
                zoom = 15;
                document.getElementById('offices-zoom').value = zoom;
            }
            var latLng = {};

            if(lat && lng) {
                latLng = {lat: lat, lng: lng};
            }
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: zoom,
                center: latLng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            marker = new google.maps.Marker({
                position: latLng,
                draggable: true,
                animation: google.maps.Animation.DROP,
                map: map
            });
            map.setCenter(latLng);
            //geocodePosition(marker.getPosition());
            google.maps.event.addListener(marker, 'drag', function(event) {
                updateMarker(event.latLng);
            });
            /*google.maps.event.addListener(marker, 'dragend', function() {
                geocodePosition(marker.getPosition());
            });*/
            google.maps.event.addListener(map, 'zoom_changed', function(event) {
                document.getElementById('offices-zoom').value = map.zoom;
            });
        }

        function updateMarker(location) {
            marker.position = location;
            document.getElementById('offices-lat').value = location.lat();
            document.getElementById('offices-long').value = location.lng();
        }

        function geocodePosition(pos) {
            geocoder.geocode({
                latLng: pos
            }, function(responses) {
                if (responses && responses.length > 0) {
                    updateMarkerAddress(responses[0].formatted_address);
                } else {
                    updateMarkerAddress('Адрес не найден.');
                }
            });
        }

        function updateMarkerAddress(address) {
            $('.offices-address').val(address);
        }
       // google.maps.event.addDomListener(window, 'load', initMap);
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=<?= Yii::$app->settingsConfig->settings['google_maps_key']?>&signed_in=true&callback=initMap&language=ru"></script>

    <?php ActiveForm::end(); ?>

</div>
