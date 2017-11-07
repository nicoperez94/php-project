<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Resetear Contraseña';
$this->params['breadcrumbs'][] = ['label' => 'Reset', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<title>Reset</title>
<link href="/tallerphpyiiadvandced/backend/web/assets/34df6947/css/bootstrap.css" rel="stylesheet">
<link href="/tallerphpyiiadvandced/backend/web/css/site.css" rel="stylesheet">
<link href="/tallerphpyiiadvandced/backend/web/assets/30ec68e7/css/font-awesome.min.css" rel="stylesheet">
<link href="/tallerphpyiiadvandced/backend/web/assets/50e5d91d/css/AdminLTE.min.css" rel="stylesheet">
<link href="/tallerphpyiiadvandced/backend/web/assets/50e5d91d/css/skins/_all-skins.min.css" rel="stylesheet">
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Admin</b></a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Reseteo de contrase&ntilde;a</p>

<?php
$form = ActiveForm::begin([
    'id' => 'reset-form',
//    'options' => ['class' => 'form-horizontal'],
]) ?>
        <div class="form-group has-feedback">
<?= $form->field($model, 'username') ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

            <div class="row">
                <div class="col-xs-4">
        <?= Html::submitButton('Resetear', ['class' => 'btn btn-primary']) ?>
                </div>
                <div class="col-xs-4">
                    <button type="button" onclick="window.location.href='/tallerphpyiiadvandced/backend/web/index.php?r=site'" class="btn btn-danger">Volver</button>
                </div>
            </div>
<?php ActiveForm::end() ?>
        </div>

</body>
<script src="/tallerphpyiiadvandced/backend/web/assets/67ead5a2/yii.js"></script>
<script src="/tallerphpyiiadvandced/backend/web/assets/67ead5a2/yii.validation.js"></script>
<script src="/tallerphpyiiadvandced/backend/web/assets/67ead5a2/yii.activeForm.js"></script>
<script src="/tallerphpyiiadvandced/backend/web/assets/34df6947/js/bootstrap.js"></script>
<script src="/tallerphpyiiadvandced/backend/web/assets/50e5d91d/js/app.min.js"></script>
<!--<script type="text/javascript">jQuery(document).ready(function () {-->
<!--        jQuery('#login-form').yiiActiveForm([{"id":"loginform-username","name":"username","container":".field-loginform-username","input":"#loginform-username","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Username cannot be blank."});}},{"id":"loginform-password","name":"password","container":".field-loginform-password","input":"#loginform-password","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Password cannot be blank."});}},{"id":"loginform-rememberme","name":"rememberMe","container":".field-loginform-rememberme","input":"#loginform-rememberme","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.boolean(value, messages, {"trueValue":"1","falseValue":"0","message":"Remember Me must be either \"1\" or \"0\".","skipOnEmpty":1});}}], []);-->
<!--    });</script>-->