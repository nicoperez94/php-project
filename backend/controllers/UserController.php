<?php
/**
 * Created by PhpStorm.
 * User: nicop
 * Date: 10/25/2017
 * Time: 9:23 PM
 */

namespace backend\controllers;
use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\forms\ResetForm;

class UserController extends \yii\web\Controller{


    public function actionForget(){

        $model = new ResetForm();

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
//        $username = Yii::$app->getRequest()->getQueryParam('username');
        if($model->load(Yii::$app->request->post()) && $model->validate()){

            $user = User::findByUsername($model->username);
            if($user){
                $user->generatePasswordResetToken();
                $user->save();
            }
            $this->layout = false;

            Yii::$app->session->setFlash("success", "Se le ha enviado un mail para resetear su password");
            return $this->redirect(['site/index']);
        }else{
            $this->layout = false;
            return $this->render('reset', ['model' => $model]);
        }

    }

    public function actionReset(){
        $token = Yii::$app->getRequest()->getQueryParam('token');
        if($token && User::isPasswordResetTokenValid($token)){
            $user = User::findByPasswordResetToken($token);
            $password = substr(md5(rand()), 0, 7);
            $user->setPassword($password);
            $user->removePasswordResetToken();
            $user->save();
            return $password;
        }else{
            return 'Error';
        }
    }

    public function actionCreate(){
        $model = new User();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $model->save();
            return $this->redirect(['user/index']);
        }else{
            $items = ArrayHelper::map(Standard::find()->all(), 's_id', 'name');

            return $this->render('create', ['model' => $model]);
        }
    }

}