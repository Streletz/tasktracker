<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;


/* @var $this yii\web\View */
/* @var $model app\modules\tasks\models\Tasks */

$this->title = 'Создание задачи';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-create">

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
