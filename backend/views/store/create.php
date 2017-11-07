<?php
/**
 * Created by PhpStorm.
 * User: nicop
 * Date: 11/1/2017
 * Time: 10:42 PM
 */

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = 'Crear Comercio';
$this->params['breadcrumbs'][] = ['label' => 'Comercio', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

