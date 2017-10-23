<?php
/**
 * Created by PhpStorm.
 * User: nicop
 * Date: 10/21/2017
 * Time: 9:31 PM
 */

namespace backend\controllers;

use common\models\Product;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\web\UploadedFile;
use common\models\ProductSearch;


class ProductController extends \yii\web\Controller{

    public function actionCreate(){
        $model = new Product();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $uploadedFile = UploadedFile::getInstance($model, 'image');
            $model->image = $uploadedFile->name;
//            $model->upload();
            $model->save();
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
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id)
    {
        //Todo hay que arreglar este metodo que aun no esta funcionando.
        $model = $this->findModel($id);
        $model->setScenario('update');

        $saveOk = false;

        if ($model->load(Yii::$app->request->post())) {
            $dirty_attributes = $model->getDirtyAttributes();
//            if (isset($dirty_attributes['image'])) {
//                if(\Yii::$app->user->can('updateCountryBandera')) {
//                    // Update
//                    $saveOk = $model->save();
////                } else {
//                    $model->addError('flag_img', 'No tienes permiso para modificar la flag');
////                }
//            } else {
                $saveOk = $model->save();
//            }
        }

        if ($saveOk) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
}