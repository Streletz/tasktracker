<?php

namespace app\modules\admin\models;

use Yii;

/**
* This is the model class for table "settings".
*
* @property int $id
* @property bool $email_notify
* @property bool $can_set_myself_task
*
*/
class Settings extends \yii\db\ActiveRecord
{
/**
* {@inheritdoc}
*/
	public static function tableName()
	{
		return 'settings';
	}

/**
* {@inheritdoc}
*/
	public function rules()
	{
		return [
			[['email_notify'], 'boolean'],
			[['can_set_myself_task'], 'boolean']
		];
	}

/**
* {@inheritdoc}
*/
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'email_notify' => 'Уведомления по email',
			'can_set_myself_task' => 'Разрешить ставить задачи самим себе'
		];
	}




}