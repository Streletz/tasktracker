<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Users;

/**
 * SearchUsers represents the model behind the search form of `app\models\Users`.
 */
class SearchUsers extends Users
{
    /**
     * {@inheritdoc}
     */
    public $roleName;
    
    public function rules()
    {
        return [
            [['id', 'role_id'], 'integer'],
            [['username', 'fio', 'pass','roleName'], 'safe'],
           
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
        $query = Users::find();
        $query->joinWith(['role']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['roleName'] = [
            'asc' => [User_roles::tableName().'.user_role' => SORT_ASC],
            'desc' => [User_roles::tableName().'.user_role' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', User_roles::tableName().'.user_role', $this->roleName]);

        return $dataProvider;
    }
}
