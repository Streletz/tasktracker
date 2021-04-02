<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Settings */

$this->title = 'Редактирование общих настроек ';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
