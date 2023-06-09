<?php
 
namespace app\models;
 
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;
 
/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','department_id'], 'integer'],
            [['first_name', 'last_name', 'username', 'email', 'password', 
              'auth_key', 'password_reset_token', 'avatar', 'user_level'
            ], 'safe'],
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
        $query = User::find();
 
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
 
        $this->load($params);
 
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
 
        $query->andFilterWhere([
            'id' => $this->id,
        ]);
 
        $query->andFilterWhere(['like', 'first_name',  $this->first_name])
            ->andFilterWhere(['like', 'last_name',     $this->last_name])
            ->andFilterWhere(['like', 'username',      $this->username])
            ->andFilterWhere(['like', 'email',         $this->email])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'auth_key',      $this->auth_key])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'avatar',   $this->avatar]);
            //->andFilterWhere(['like', 'role',   $this->role]);
 
        return $dataProvider;
    }
}