<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Settings */

$this->title = "Настройки";
$this->params['breadcrumbs'][] = ['label' => 'Настройки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Редактировать', ['update-default', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?php
		// Временно отключаем кнопку удаления, т.к. пользовательские настройки пока не поддерживаются.
		/*Html::a('Delete', ['delete', 'id' => $model->id], [
		'class' => 'btn btn-danger',
		'data' => [
		'confirm' => 'Are you sure you want to delete this item?',
		'method' => 'post',
		],
		]) */ ?>
	</p>

	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [			
			'email_notify:boolean',
			'can_set_myself_task:boolean',
			['attribute' =>'creator.fio', 'label'=>'Создал'],
		],
	]) ?>

</div>
