<?php
/**
 * Created by PhpStorm.
 * User: nicop
 * Date: 10/18/2017
 * Time: 11:05 PM
 */

namespace common\models;

class OrderProduct extends \yii\db\ActiveRecord{

    public static function tableName(){
        return '{{%order_product}}';
    }

    public function getProduct() {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

}