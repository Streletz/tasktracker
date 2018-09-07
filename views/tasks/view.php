<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tasks */

$this->title = $model->task_name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-view">

    <h1><?= Html::encode($this->title) ?></h1>
<?php  if(Yii::$app->user->identity->isAdmin() || Yii::$app->user->identity->isManager()){?>
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php } ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [            
            'description:ntext',            
            ['attribute' =>'creator.fio','label'=>'Создал'],            
            ['attribute' =>'worker.fio','label'=>'Исполнитель'],
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
            ['attribute' =>'taskStatus.status','label'=>'Статус'],
        ],
    ]) ?>
    
    <?= $this->render('_statusChangeForm', [
        'model' => $model        
    ]) ?>

</div>
