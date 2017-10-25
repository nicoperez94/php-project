<?php
/**
 * Created by PhpStorm.
 * User: nicop
 * Date: 10/18/2017
 * Time: 11:03 PM
 */

namespace common\models;

class Category extends \yii\db\ActiveRecord{

    public static function tableName(){
        return 'category';
    }

    public function getProducts(){
        return $this->hasMany(Product::className(), ['user_id'=>'id']);
    }

    public function rules(){
        return [
            [['name'], 'required'],
            [['name'], 'string']
        ];
    }

    public function attributeLabels(){
        return [
            'id' => 'Id',
            'name' => 'Nombre',
        ];
    }
}