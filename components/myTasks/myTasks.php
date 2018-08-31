<?php
namespace app\components\myTasks;

use yii\base\Widget;
use app\models\SearchTasks;
use Yii;
/**
 * Отображение задач, в которых текущий пользователь является исполнителем.
 * 
 * @author Streletz
 *
 */
class MyTasks extends Widget{
    
    public function run(){
        $tasks = new SearchTasks();
        $searchModel = new SearchTasks();
        $dataProvider = $searchModel->searchMyTasks(Yii::$app->request->queryParams);
        
        return $this->render('task_table', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
}
?>