<?php

namespace admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use admin\models\AdIntro;

/**
 * AdIntroSearch represents the model behind the search form of `admin\models\AdIntro`.
 */
class AdIntroSearch extends AdIntro
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'displayorder'], 'integer'],
            [['filename', 'filetype','title','description'], 'safe'],
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
        $query = AdIntro::find();

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
            'displayorder' => $this->displayorder,
        ]);

        $query->andFilterWhere(['like', 'filename', $this->filename])
			->andFilterWhere(['like', 'title', $this->title])
			->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'filetype', $this->filetype]);

        return $dataProvider;
    }
}
