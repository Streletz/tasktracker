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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [            
            'description:ntext',            
            ['attribute' =>'creator.fio','label'=>'Создал'],            
            ['attribute' =>'worker.fio','label'=>'Исполнитель'],
            'deadLine_date',
            'start_date',
            'end_date',
            ['attribute' =>'taskStatus.status','label'=>'Статус'],
        ],
    ]) ?>
    
    <?= $this->render('_statusChangeForm', [
        'model' => $model        
    ]) ?>

</div>
