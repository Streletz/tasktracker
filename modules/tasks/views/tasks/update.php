<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model app\modules\tasks\models\Tasks */

$this->title = 'Редактирование задачи: ' . $model->task_name;
$this->params['breadcrumbs'][] = ['label' => 'Задачи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->task_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="tasks-update">

    <h1><?= Html::encode($this->title) ?></h1>
	<?php
	if (Yii::$app->session->hasFlash('error_message'))
		: ?>
	<?= Alert::widget([
		'options' => [
			'class' => 'alert-danger',
		],
		'body' => Yii::$app->session->getFlash('error_message'),
	]); ?>
	<?php endif; ?> 
    <?= $this->render('_form', [
        'model' => $model,
        'workers'=> $workers,
    ]) ?>

</div>
