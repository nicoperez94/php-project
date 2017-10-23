<?php
/**
 * Created by PhpStorm.
 * User: nicop
 * Date: 10/18/2017
 * Time: 10:42 PM
 */

namespace common\models;

use yii\web\UploadedFile;

class Product extends \yii\db\ActiveRecord{

    public static function tableName(){
        return 'product';
    }

    public function rules(){
        return [
            [['name', 'price'], 'required'],
            [['stock'], 'integer', 'integerOnly' => true, 'min' => 0],
            [['name'], 'string'],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions' => 'jpg, png']
        ];
    }

    public function attributeLabels(){
        return [
            "id" => "Id",
            "name"  =>  "Nombre",
            "price" =>  "Precio",
            "image" =>  "Imagen",
            "bar_code"  =>  "Codigo de barras",
            "stock" =>  "Stock"
        ];
    }

//    public function upload(){
//        if($this->validate()){
//            $this->image = UploadedFile::getInstance($this, 'image');
//            if($this->image){
//                $imagePath = '/uploads/product/';
//                $this->image = $imagePath . rand(10, 100) . $this->image->name;
//            }
//            $this->image->saveAs($this->image);
//            return true;
//        }else{
//            return false;
//        }
//    }
}