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
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['gather_url', 'gather_rule', 'output_encoding', 'input_encoding', 'remove_head'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = GatherRules::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
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
