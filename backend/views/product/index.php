<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
        <?= Html::a('Crear Producto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'price',
            'stock',
            [
                'attribute' => 'bar_code',
                'format' => 'raw',
                'value' => function($model){
                    $generator = new common\helpers\barcode\BarcodeGeneratorHTML();
                    if(isset($model->bar_code) &&  ($model->bar_code != 0 || $model->bar_code == null)){
                        return $generator->getBarcode($model->bar_code, $generator::TYPE_CODE_128);
                    }else{
                        //Se le setea el valor del codigo de barras.
                        $model->bar_code = 1000 + $model->id;
                        $model->save();
                        return $generator->getBarcode($model->bar_code, $generator::TYPE_CODE_128);
                    }
                }
            ],
            [
                'attribute' => 'Imagen',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::img(Yii::$app->basePath . '\uploads\products\\' . $model->image, ['width' => 50]);
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
