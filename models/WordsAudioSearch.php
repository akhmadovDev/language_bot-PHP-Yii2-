<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WordsAudio;

/**
 * WordsAudioSearch represents the model behind the search form of `app\models\WordsAudio`.
 */
class WordsAudioSearch extends WordsAudio
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'words_id', 'status'], 'integer'],
            [['audio', 'created_date', 'updated_date'], 'safe'],
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
        $query = WordsAudio::find();

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

        $query->andFilterWhere(['like', 'audio', $this->audio]);

        return $dataProvider;
    }
}
