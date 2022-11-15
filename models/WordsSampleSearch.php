<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WordsSample;

/**
 * WordsSampleSearch represents the model behind the search form of `app\models\WordsSample`.
 */
class WordsSampleSearch extends WordsSample
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'words_id', 'status'], 'integer'],
            [['description_uz', 'description_ru', 'description_eng', 'created_date', 'updated_date'], 'safe'],
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
        $query = WordsSample::find();

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
            'status' => $this->status,
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
        ]);

        $query->andFilterWhere(['like', 'description_uz', $this->description_uz])
            ->andFilterWhere(['like', 'description_ru', $this->description_ru])
            ->andFilterWhere(['like', 'description_eng', $this->description_eng]);

        return $dataProvider;
    }
}
