<?php

namespace admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use admin\models\Notification;

/**
 * AdIntroSearch represents the model behind the search form of `admin\models\AdIntro`.
 */
class NotificationSearch extends Notification
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'userId'], 'integer'],
            [['notification_body', 'send_notification','title'], 'safe'],
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
        $query = Notification::find();

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
            'userId' => $this->userId,
        ]);

        $query->andFilterWhere(['like', 'notification_body', $this->notification_body])
			->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
