<?php
/**
 * Created by PhpStorm.
 * User: nicop
 * Date: 11/1/2017
 * Time: 9:23 PM
 */
namespace common\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Store;

class StoreSearch extends Store{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'image', 'location'], 'safe'],
        ];
    }


    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Store::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere([ 'id' => $this->id ]);



        return $dataProvider;
    }

    public function getAll(){
        $query = Store::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load([]);

        return $dataProvider;
    }
}