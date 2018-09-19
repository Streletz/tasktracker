<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<h1>Поставленные мной</h1>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid){
         $class = $model->taskIsOverdue() ? 'danger' : '';
            return [
                'key'=>$key,
                'index'=>$index,
                'class'=>$class
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],            
            ['attribute' =>'task_name', 'label'=>'Задача', 'format' => 'raw',  'value'=>function ($data) {
                return Html::a($data->task_name, Url::to(['tasks/view','id' => $data->id]));
            },],                        
            ['attribute' =>'workerName', 'label'=>'Исполнитель','value'=>'worker.fio'],
            ['attribute' =>'deadLine_date', 'label'=>'Выполнить до', 'value'=>function($data) {
                if($data->deadLine_date!=''){
                    return (new DateTime($data->deadLine_date))->format('d.m.Y');
                }else{
                    return null;
                }
            }],
            ['attribute' =>'start_date', 'label'=>'Начато', 'value'=>function($data) {
                if($data->start_date!=''){
                    return (new DateTime($data->start_date))->format('d.m.Y');
                }else{
                    return null;
                }
            }],
            ['attribute' =>'end_date', 'label'=>'Завершено', 'value'=>function($data) {
                if($data->start_date!=''){
                    return (new DateTime($data->end_date))->format('d.m.Y');
                }else{
                    return null;
                }
            }],
            ['attribute' =>'status', 'label'=>'Статус','value'=>'taskStatus.status'],            
        ],
    ]); ?>