<?php
/**
 * Created by PhpStorm.
 * User: nicop
 * Date: 10/21/2017
 * Time: 9:51 PM
 */

use common\models\Category;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */

$items=Category::find()->all();

//use yii\helpers\ArrayHelper;
$items=\yii\helpers\ArrayHelper::map($items,'id','name');

?>

<div class="product-form">

    <?php $form = ActiveForm::begin([ 'options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true, 'type' => 'number']) ?>

    <?= $form->field($model, 'stock')->textInput(['type' => 'number']) ?>

    <?php
//    echo $form->field($model, 'category_id')->dropDownList(
//        $items,
//        ['prompt'=>'Seleccione categoria']);

    echo $form->field($model, 'category[]')
        ->dropDownList($model->CategoryDropdown,
            [
                'multiple'=>'multiple'
            ]
        )->label("Agregar categorias");
    ?>

    <?=  $form->field($model, 'image')->fileInput() ?>

    <?php
        if($model->image){
            echo '<img src="'.\Yii::$app->request->baseUrl.'/'.$model->image.'" width="90px">&nbsp;&nbsp;&nbsp;';
            echo Html::a('Borrar Imgen', ['product/deleteImage', 'id'=>$model->id], ['class'=>'btn btn-danger']).'<p>';
        }
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
