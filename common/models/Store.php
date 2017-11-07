<?php
/**
 * Created by PhpStorm.
 * User: nicop
 * Date: 10/18/2017
 * Time: 11:08 PM
 */

namespace common\models;

class Store extends \yii\db\ActiveRecord{

    public $lat;
    public $lng;

    public static function tableName(){
        return '{{%store}}';
    }

    public function rules(){
        return [
            [['name'], 'required'],
            [['name', 'lat', 'lng'], 'string'],
            [['image', 'detalle'], 'safe']
        ];
    }

    public function attributeLabels(){
        return [
            "id" => "Id",
            "name"  =>  "Nombre",
            "image" =>  "Imagen",
            "detalle" =>  "Descripcion"
        ];
    }

    public function getCategories() {
        return $this->hasMany(Category::className(), ['store_id' => 'id']);
    }

    public function getProducts() {
        return $this->hasMany(Product::className(), ['store_id' => 'id']);
    }

    public function getOrders() {
        return $this->hasMany(Order::className(), ['store_id' => 'id']);
    }

    public function getShipping() {
        return $this->hasMany(Shipping::className(), ['store_id' => 'id']);
    }

    public function getDeliveries() {
        return $this->hasMany(Delivery::className(), ['store_id' => 'id']);
    }
}