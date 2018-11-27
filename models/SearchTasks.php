<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tasks;
use app\models\Users;

/**
 * SearchTasks represents the model behind the search form of `app\models\Tasks`.
 */
class SearchTasks extends Tasks
{
    public $creatorName;
    public $workerName;
    public $status;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'creator_id', 'worker_id', 'task_status_id'], 'integer'],
            [['creatorName', 'task_name', 'description','deadLine_date', 'start_date', 'end_date','status','workerName'], 'safe'],
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
        $query = Tasks::find();
        return $this->prepareDataProvider($query);

    }
    
    /**
     * Поиск задач, в которых текущий пользователь, является исполнителем.
     * @param array $params
     * @return \yii\data\ActiveDataProvider
     */
    public function searchMyTasks($params)
    {
        $query = Tasks::find()->where(['worker_id'=>Yii::$app->user->getId()]);
        return $this->prepareDataProvider($query);
        
    }
    
    /**
     * Поиск задач, в которых текущий пользователь, является создателем.
     * @param array $params
     * @return \yii\data\ActiveDataProvider
     */
    public function searchTasksCreatedByMe($params)
    {
        $query = Tasks::find()->where(['creator_id'=>Yii::$app->user->getId()]);
        return $this->prepareDataProvider($query);
        
    }
    
    /**
     * Подготовка DataProvuider к работе с GridView.
     * @param query
     */
     private function prepareDataProvider($query)
    {
        $query->joinWith(['creator'=>function($query){
            $query->from(Users::tableName().' creatorUser');
        }, 
        'taskStatus', 
        'worker'=>function($query){
            $query->from(Users::tableName().' workerUser');
        }]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['creatorName'] = [
            'asc' => ['creatorUser.fio' => SORT_ASC],
            'desc' => ['creatorUser.fio' => SORT_DESC],
            ];
        $dataProvider->sort->attributes['status'] = [
                'asc' => [Task_status::tableName().'.status' => SORT_ASC],
                'desc' => [Task_status::tableName().'.status' => SORT_DESC],
            ];
        $dataProvider->sort->attributes['workerName'] = [
                'asc' => ['workerUser.fio' => SORT_ASC],
                'desc' => ['workerUser.fio' => SORT_DESC],
            ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'creator_id' => $this->creator_id,
            'worker_id' => $this->worker_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            
        ]);

        $query->andFilterWhere(['like', 'task_name', $this->task_name])
        ->andFilterWhere(['like', 'description', $this->description])
        ->andFilterWhere(['like', 'creatorUser.fio', $this->creatorName])
        ->andFilterWhere(['like', Task_status::tableName().'.status', $this->status])
        ->andFilterWhere(['like', 'workerUser.fio', $this->workerName]);

        return $dataProvider;
    }

}
