<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProjectDeveloper;

/**
 * ProjectDeveloperSearch represents the model behind the search form of `app\models\ProjectDeveloper`.
 */
class ProjectDeveloperSearch extends ProjectDeveloper
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['developer_id', 'project_id'], 'integer'],
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
        $query = ProjectDeveloper::find();

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
            'developer_id' => $this->developer_id,
            'project_id' => $this->project_id,
        ]);

        return $dataProvider;
    }
}
