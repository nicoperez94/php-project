<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'price',
            [
                'attribute' => 'bar_code',
                'format' => 'raw',
                'value' => function($model){
                    $generator = new common\helpers\barcode\BarcodeGeneratorHTML();
                    if(isset($model->bar_code)){
                        return $generator->getBarcode($model->bar_code, $generator::TYPE_CODE_128);
                    }
                }
            ],
            'stock',
            [
                'attribute' => 'Imagen',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::img($model->image, ['width' => 50]);
                },
            ]
        ],
    ]) ?>

</div>