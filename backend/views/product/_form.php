<?php
/**
 * Created by PhpStorm.
 * User: nicop
 * Date: 10/21/2017
 * Time: 9:51 PM
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="country-form">

    <?php $form = ActiveForm::begin([
//            'type' => ActiveForm::TYPE_HORIZONTAL,
            'options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true, 'type' => 'number']) ?>

    <?= $form->field($model, 'stock')->textInput(['type' => 'number']) ?>

    <?=  $form->field($model, 'image')->fileInput() ?>

    <?php
        if($model->image){
            echo '<img src="'.\Yii::$app->request->baseUrl.'/'.$model->image.'" width="90px">&nbsp;&nbsp;&nbsp;';
            echo Html::a('Borrar Imgen', ['product/deleteImage', 'id'=>$model->id], ['class'=>'btn btn-danger']).'<p>';
        }
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
