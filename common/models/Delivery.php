<?php
/**
 * Created by PhpStorm.
 * User: nicop
 * Date: 10/18/2017
 * Time: 11:04 PM
 */

namespace common\models;

class Delivery extends \yii\db\ActiveRecord{

    public static function tableName(){
        return '{{%delivery}}';
    }

    public function getShipping() {
        return $this->hasMany(Shipping::className(), ['delivery_id' => 'id']);
    }
}