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

}