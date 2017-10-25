<?php
/**
 * Created by PhpStorm.
 * User: nicop
 * Date: 10/18/2017
 * Time: 11:05 PM
 */

namespace common\models;

class Order extends \yii\db\ActiveRecord{

    public static function tableName(){
        return '{{%order}}';
    }

    public function getOrderProduct() {
        return $this->hasMany(OrderProduct::className(), ['order_id' => 'id']);
    }

    public function getDelivery() {
        return $this->hasOne(Delivery::className(), ['id' => 'delivery_id']);
    }
}