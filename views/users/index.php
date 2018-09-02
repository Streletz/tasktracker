<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchUsers */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

	<h1><?= Html::encode($this->title) ?></h1>  
	
	<?php if (Yii::$app->session->hasFlash('error_message')): ?> 
    <?= Alert::widget([
            'options' => [
            'class' => 'alert-danger',
            ],
            'body' => Yii::$app->session->getFlash('error_message'),
        ]);?> 
	<?php endif; ?>   

    <p>
        <?= Html::a('Новый', ['create'], ['class' => 'btn btn-success']) ?>
    </p>    
    

    <?=GridView::widget(['dataProvider' => $dataProvider,'filterModel' => $searchModel,
        'columns' => [['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'username','label' => 'Логин'],
            ['attribute' => 'fio','label' => 'ФИО'],            
            ['attribute' => 'roleName','label' => 'Роль', 'value'=>'role.user_role'],
            ['class' => 'yii\grid\ActionColumn']]]);
    ?>
</div>
