<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\tasks\models\SearchTasks */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Задачи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">

	<h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Новая задача', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php if(Yii::$app->user->identity->isAdmin() || Yii::$app->user->identity->isManager() ) {?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid){
            $class= $model->taskIsOverdue() ? 'danger' : '';
            return [
                'key'=>$key,
                'index'=>$index,
                'class'=>$class
                ];
            },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],            
            ['attribute' =>'task_name', 'label'=>'Задача'], 
            ['attribute' =>'creatorName', 'label'=>'Создана','value'=>'creator.fio'],            
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
                if($data->end_date!=''){
                    return (new DateTime($data->end_date))->format('d.m.Y');
                }else{
                    return null;
                }
            }],
            ['attribute' =>'status', 'label'=>'Статус','value'=>'taskStatus.status'],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php } else {?>
    <?=GridView::widget(['dataProvider' => $dataProvider,'filterModel' => $searchModel,'columns' => [['class' => 'yii\grid\SerialColumn'],['attribute' => 'task_name','label' => 'Задача','format' => 'raw','value' => function ($data) {return Html::a($data->task_name, Url::to(['tasks/view','id' => $data->id]));}],['attribute' => 'creatorName','label' => 'Создана','value' => 'creator.fio'],['attribute' => 'workerName','label' => 'Исполнитель','value' => 'worker.fio'],['attribute' => 'deadLine_date','label' => 'Выполнить до','value' => function ($data) {if ($data->deadLine_date != '') {return (new DateTime($data->deadLine_date))->format('d.m.Y');} else {return null;}}],['attribute' => 'start_date','label' => 'Начато','value' => function ($data) {if ($data->start_date != '') {return (new DateTime($data->start_date))->format('d.m.Y');} else {return null;}}],['attribute' => 'end_date','label' => 'Завершено','value' => function ($data) {if ($data->start_date != '') {return (new DateTime($data->end_date))->format('d.m.Y');} else {return null;}}],['attribute' => 'status','label' => 'Статус','value' => 'taskStatus.status']]]);?>
    <?php }?>
</div>
