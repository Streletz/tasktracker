<?php

/* @var $this yii\web\View */
$this->title = Yii::$app->name;
?>

<div class="site-index">	
<?= app\components\myTasks\MyTasks::widget(); ?>
<?php if(Yii::$app->user->identity->isAdmin() || Yii::$app->user->identity->isManager()){ ?>
<?= app\components\tasksCreatedByMe\TasksCreatedByMe::widget(); ?>
<?php } ?>
</div>
