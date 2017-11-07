<?php
/**
 * Created by PhpStorm.
 * User: nicop
 * Date: 11/6/2017
 * Time: 10:55 PM
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Store */

$this->title = 'Actualizar comercio: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Comercio', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="store-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
