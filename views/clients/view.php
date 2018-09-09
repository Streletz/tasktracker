<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Clients */

$this->title = $model->client_name;
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clients-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Удалить этого клиента?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [            
            'client_name:ntext',
            'client_site:ntext',
            ['attribute' => 'creation_date', 'value' => function($data){
                return (new DateTime($data->creation_date))->format('d.m.Y');
            }],
            ['attribute' =>'blacklisted', 'value'=>function($data){
                return $data->blacklisted==1 ? 'Да':'Нет';
            }],
            'description:ntext',
        ],
    ]) ?>

</div>
