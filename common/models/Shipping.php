<?php
/**
 * Created by PhpStorm.
 * User: nicop
 * Date: 10/18/2017
 * Time: 11:06 PM
 */

namespace common\models;

class Shipping extends \yii\db\ActiveRecord{

    public static function tableName(){
        return '{{%shipping}}';
    }

    public function getOrders() {
        return $this->hasMany(Order::className(), ['shipping_id' => 'id']);
    }

}