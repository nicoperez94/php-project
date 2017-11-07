<?php
/**
 * Created by PhpStorm.
 * User: nicop
 * Date: 11/2/2017
 * Time: 8:45 PM
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Store */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Comercio', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$location = json_decode($model->location, true);
?>
<div class="store-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <a href="<?php echo Yii::$app->request->referrer ?>" class="btn btn-warning">Volver</a>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Estas seguro que deseas eliminar este comercio?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-6">
                <img src="<?php echo $model->image ?>">
                <p><?php echo $model->detalle ?></p>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div id="map"></div>
            </div>
        </div>
    </div>

</div>

<style type="text/css">
    #map{
        height: 380px;
        width: 100%;
    }
    .container{
        width: 100%;
    }
    .row{
        padding: 5px;
        box-sizing: border-box;
    }
    img{
        max-width: 100%;
        display: block;
        margin: auto    ;
    }
    p{
        margin-top: 10px;
        font-size:16px;
    }
</style>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAN7-GJ2Oo1ZZp4-s0cTAX9a9Vgj0k-K2w&callback=initMap"
        async defer></script>

<script>


    function initMap() {

        var myLatLng = {lat: <?php echo $location['lat']; ?>, lng: <?php echo $location['lng']; ?>};

        var map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            zoom: 16
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map
        });


    }
</script>

