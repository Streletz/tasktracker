<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<h1>Поставленные мной</h1>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],            
            ['attribute' =>'task_name', 'label'=>'Задача', 'format' => 'raw',  'value'=>function ($data) {
                return Html::a($data->task_name, Url::to(['tasks/view','id' => $data->id]));
            },],                        
            ['attribute' =>'workerName', 'label'=>'Исполнитель','value'=>'worker.fio'],
            ['attribute' =>'deadLine_date', 'label'=>'Выполнить до'],
            ['attribute' =>'start_date', 'label'=>'Начато'],
            ['attribute' =>'end_date', 'label'=>'Завершено'],
            ['attribute' =>'status', 'label'=>'Статус','value'=>'taskStatus.status'],            
        ],
    ]); ?>