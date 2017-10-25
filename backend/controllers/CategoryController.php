<?php
/**
 * Created by PhpStorm.
 * User: nicop
 * Date: 10/21/2017
 * Time: 9:31 PM
 */

namespace backend\controllers;

use common\models\Category;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\web\UploadedFile;
use common\models\CategorySearch;


class CategoryController extends \yii\web\Controller{

    public function actionCreate(){
        $model = new Category();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $model->save();
            return $this->redirect(['category/index']);
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
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionIndex()
    {
        $searchModel = new CategorySearch();
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

        $saveOk = false;

        if ($model->load(Yii::$app->request->post())) {
            $saveOk = $model->save();
        }

        if ($saveOk) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
}