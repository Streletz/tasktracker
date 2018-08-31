<?php
namespace app\components\tasksCreatedByMe;

use yii\base\Widget;
use app\models\SearchTasks;
use Yii;
/**
 * Отображение задач, поставленных текущим пользователем.
 * 
 * @author Streletz
 *
 */
class TasksCreatedByMe extends Widget{
    
    public function run(){
        $tasks = new SearchTasks();
        $searchModel = new SearchTasks();
        $dataProvider = $searchModel->searchTasksCreatedByMe(Yii::$app->request->queryParams);
        
        return $this->render('task_table', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
}
?>