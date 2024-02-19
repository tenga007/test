<?php

namespace app\modules\notifier\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\notifier\models\db\Notifications;

/**
 * NotifierSearch represents the model behind the search form of `app\modules\notifier\models\db\Notifier`.
 */
class NotificationsSearch extends Notifications
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'integrator', 'status'], 'integer'],
            [['text', 'created_at', 'sended_at'], 'safe'],
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
        $query = Notifications::find();

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
            'integrator' => $this->integrator,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'sended_at' => $this->sended_at,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
