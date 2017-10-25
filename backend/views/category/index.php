<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php

    /*
    $client = new \common\components\Imgur\Client();
    $client->setOption('client_id', '43ef2945940cda9');
    $client->setOption('client_secret', '8955a7c142cd304c62aec805fea0119fee93c828');

//    $_GET['code'] = '31f184d6b9142876045013d3b85de409b53e2d3b';

    if (isset($_SESSION['token'])) {
        $client->setAccessToken($_SESSION['token']);

        if ($client->checkAccessTokenExpired()) {
            $client->refreshToken();
        }
    } elseif (isset($_GET['code'])) {
        $client->requestAccessToken($_GET['code']);
        $_SESSION['token'] = $client->getAccessToken();
    } else {
        echo '<a href="'.$client->getAuthenticationUrl().'">Click to authorize</a>';
    }

    $pathToFile = 'C:\wamp64\www\tallerphpyiiadvandced\backend\uploads\product\arroz.png';
    $imageData = [
        'image' => $pathToFile,
        'type'  => 'file',
    ];

    var_dump($client->api('image')->upload($imageData));
    */
    ?>
    <p>
        <?= Html::a('Crear Categoria', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
