<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\GatherResult;

/**
 * GatherResultSearch represents the model behind the search form about `backend\models\GatherResult`.
 */
class GatherResultSearch extends GatherResult
{
    public function rules()
    {
        return [
            [['id', 'rule_id', 'created_at', 'updated_at'], 'integer'],
            [['gather_title', 'gather_content'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = GatherResult::find();
        $query->orderBy('id DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'rule_id' => $this->rule_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'gather_title', $this->gather_title])
            ->andFilterWhere(['like', 'gather_content', $this->gather_content]);

        return $dataProvider;
    }
}
