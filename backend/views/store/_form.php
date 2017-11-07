<?php
/**
 * Created by PhpStorm.
 * User: nicop
 * Date: 11/1/2017
 * Time: 10:36 PM
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Store */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="col-lg-6 col-sm-6">
<div class="store-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detalle')->textArea() ?>

    <?=  $form->field($model, 'image')->textInput() ?>

    <?=  $form->field($model, 'lat')->textInput(['readOnly' => true, 'id' => 'lat']) ?>

    <?=  $form->field($model, 'lng')->textInput(['readOnly' => true, 'id' => 'lng']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
    <a href="<?php echo Yii::$app->request->referrer ?>" class="btn btn-warning">Volver</a>
</div>

<div class="col-lg-6 col-sm-6">
    <div id="map"></div>
</div>

<style type="text/css">
    .btn-success{
        float: left;
        margin-right: 25px;
    }
</style>

<style type="text/css">
    #map{
        height: 380px;
        width: 100%;
    }
    .btn-primary{
        float: left;
        margin-right: 25px;
    }
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAN7-GJ2Oo1ZZp4-s0cTAX9a9Vgj0k-K2w&callback=initMap"
        async defer></script>

<script>
    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.
    var map;
    var markers = [];

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 14
        });

        var infoWindow = new google.maps.InfoWindow({map: map});
        map.addListener('click', function (event) {
            addMarker(event.latLng);
        });

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent('Location found.');
                map.setCenter(pos);
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
    }

    function addMarker(location) {
        console.log(location);
        document.getElementById("lat").value = location.lat();
        document.getElementById("lng").value = location.lng();

        var marker = new google.maps.Marker({
            position: location,
            map: map
        });
        markers.push(marker);
    }

</script>