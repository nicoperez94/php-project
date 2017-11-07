<?php
/**
 * Created by PhpStorm.
 * User: nicop
 * Date: 10/25/2017
 * Time: 11:19 PM
 */

namespace common\models\forms;

class ResetForm extends \yii\base\Model
{
    public $username;

    public function rules()
    {
        return [
            [['username'], 'required']
        ];
    }
}