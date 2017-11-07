<?php
/**
 * Created by PhpStorm.
 * User: nicop
 * Date: 10/21/2017
 * Time: 9:31 PM
 */

namespace backend\controllers;

use common\models\StoreSearch;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use common\models\Store;
use yii\filters\AccessControl;


class StoreController extends \yii\web\Controller{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionCreate(){
        $model = new Store();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $model->location = json_encode(array('lat' => $model->lat, 'lng' => $model->lng));
            $model->save();
            return $this->redirect(['store/index']);
        }else{
            return $this->render('create', ['model' => $model]);
        }
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Store::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new Store();

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        $saveOk = false;

        if ($model->load(Yii::$app->request->post())) {
            if(isset($model->lat) && $model->lat != '' && isset($model->lng) && $model->lng != ''){
                $model->location = json_encode(array('lat' => $model->lat, 'lng' => $model->lng));
            }
            $saveOk = $model->save();
        }

        if ($saveOk) {
            Yii::$app->session->setFlash("success", "El comercio se actualizo exitosamente.");
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        Yii::$app->session->setFlash("success", "$model->name se elimino exitosamente.");
        $model->delete();
        return $this->redirect(['index']);
    }
}