<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Alert;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\SearchUsers */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Администрирование';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">

	<h1><?= Html::encode($this->title) ?></h1>  
	
	<?php if (Yii::$app->session->hasFlash('error_message')): ?> 
    <?= Alert::widget([
            'options' => [
            'class' => 'alert-danger',
            ],
            'body' => Yii::$app->session->getFlash('error_message'),
        ]);?> 
	<?php endif; ?>   

    
</div>
<div class="row">
    <div class="col-md-6">
        <h2>Управление пользователями</h2>
        <p> <a href="<?= Yii::$app->getUrlManager()->createUrl(['admin/users/index']); ?>">Пользователи</a> </p>
    </div>
    <div class="col-md-6">
        <h2>Настройки</h2>
		<p><a href="<?= Yii::$app->getUrlManager()->createUrl(['admin/settings/index']); ?>">Общие</a></p>
    </div>
	
</div>

