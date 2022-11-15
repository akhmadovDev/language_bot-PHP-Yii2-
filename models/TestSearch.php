<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Test;

/**
 * TestSearch represents the model behind the search form of `app\models\Test`.
 */
class TestSearch extends Test
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'words_id', 'user_id', 'all_attemp', 'last_attemp', 'correct', 'incorrect'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Test::find();

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
            'words_id' => $this->words_id,
            'user_id' => $this->user_id,
            'all_attemp' => $this->all_attemp,
            'last_attemp' => $this->last_attemp,
            'correct' => $this->correct,
            'incorrect' => $this->incorrect,
        ]);

        return $dataProvider;
    }
}
