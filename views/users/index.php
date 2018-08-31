<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchUsers */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

	<h1><?= Html::encode($this->title) ?></h1>    

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
