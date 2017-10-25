<?php
/**
 * Created by PhpStorm.
 * User: nicop
 * Date: 10/18/2017
 * Time: 10:42 PM
 */

namespace common\models;

use yii\web\UploadedFile;
use Yii;

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

    public function afterSave($insert, $changedAttributes)
    {
        if(isset($this->image)){
            $this->image = UploadedFile::getInstance($this,'image');
            if(is_object($this->image)){
                $name = Yii::$app->basePath . '\uploads\products\\';  //set directory path to save image
                $this->image->saveAs($name.$this->id."_".$this->image);
                $client = new \common\components\Imgur\Client();
                $client->setOption('client_id', '43ef2945940cda9');
                $client->setOption('client_secret', '8955a7c142cd304c62aec805fea0119fee93c828');

//                $_GET['code'] = '31f184d6b9142876045013d3b85de409b53e2d3b';

                if (isset($_SESSION['token'])) {
                    $client->setAccessToken($_SESSION['token']);

                    if ($client->checkAccessTokenExpired()) {
                        $client->refreshToken();
                    }
                } elseif (isset($_GET['code'])) {
                    $client->requestAccessToken($_GET['code']);
                    $_SESSION['token'] = $client->getAccessToken();
                } else {
                    echo '<a href="'.$client->getAuthenticationUrl().'">Click to authorize</a>';
                }

//                $pathToFile = 'C:\wamp64\www\tallerphpyiiadvandced\backend\uploads\product\arroz.png';
                $imageData = [
                    'image' => $name.$this->id."_".$this->image,
                    'type'  => 'file',
                ];
                var_dump($client->api('image')->upload($imageData));
                die;
                /*$this->image = $this->id."_".$this->image;    //appending id to image name
                Yii::$app->db->createCommand()
                    ->update('product', ['image' => $this->image], 'id = "'.$this->id.'"')
                    ->execute(); //manually update image name to db*/
            }
        }
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