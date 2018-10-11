<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Редактирование пользователя: ' . $model->fio;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="users-update">

    <h1><?= Html::encode($this->title) ?></h1>
<?php //var_dump($roles);?>
    <?= $this->render('_form', [
        'model' => $model,
        'roles'=>$roles,
    ]) ?>

</div>
