<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\Store */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comercios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-index">

    <div class="container">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear un comercio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="row">
            <?php foreach ($model::find()->all() as $item){ ?>
                <div class="col-lg-4 col-sm-6 portfolio-item">
                        <div class="card h-100">
                            <a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl() . '/index.php?r=store/view&id=' . $item->id ?>"><img class="card-img-top" src="<?php echo $item->image ?>" alt="<?php echo $item->name ?>"></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="#"><?php echo StringHelper::truncate($item->name, 150, '...') ?></a>
                                </h4>
                                <p class="card-text"><?php echo StringHelper::truncate($item->detalle, 150, '...') ?></p>
                            </div>
                        </div>
                </div>
            <?php } ?>
    </div>
    </div>
</div>

<style type="text/css">
    .portfolio-item {
        text-align: center;
        box-sizing: border-box;
        max-height: 340px;
        overflow: hidden;
        margin-bottom: 15px;
    }
    .container{
        width: 90%;
    }
    .card{
        border: 1px solid #ccc;
        border-radius: 5px;
        text-align: center;
        padding: 25px 15px 5px;
        box-sizing: border-box;
        height: 330px;
    }
    .card>a{
        height: 173px;
        display: block;
    }
    @media all and (max-width: 768px) {
        .card {
            margin: 10px;
        }
    }
    .portfolio-item img{
        max-width: 93%;
        max-height: 170px;
    }
    .pagination {
        margin-bottom: 30px;
    }
</style>
