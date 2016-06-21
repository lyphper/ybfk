<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\GatherRules;

/**
 * GatherRulesSearch represents the model behind the search form about `backend\models\GatherRules`.
 */
class GatherRulesSearch extends GatherRules
{
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['gather_url', 'gather_rule', 'output_encoding', 'input_encoding', 'remove_head'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = GatherRules::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'gather_url', $this->gather_url])
            ->andFilterWhere(['like', 'gather_rule', $this->gather_rule])
            ->andFilterWhere(['like', 'output_encoding', $this->output_encoding])
            ->andFilterWhere(['like', 'input_encoding', $this->input_encoding])
            ->andFilterWhere(['like', 'remove_head', $this->remove_head]);

        return $dataProvider;
    }
}
