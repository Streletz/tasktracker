<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Settings */

$this->title = "Общие настройки";
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Редактировать', ['update-default', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
	</p>

	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [			
			'email_notify:boolean',
			'can_set_myself_task:boolean',
		],
	]) ?>

</div>
