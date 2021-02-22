<?php

namespace app\modules\admin\models;

use Yii;

/**
* This is the model class for table "settings".
*
* @property int $id
* @property bool $email_notify
* @property bool $can_set_myself_task
* @property int $creator_id
*
* @property Users $creator
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
			[['can_set_myself_task'], 'boolean'],
			[['creator_id'], 'required'],
			[['creator_id'], 'default', 'value' => null],
			[['creator_id'], 'integer'],
			[['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['creator_id' => 'id']],
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
			'can_set_myself_task' => 'Разрешить ставить задачи самим себе',
			'creator_id' => 'Создал',
		];
	}


/**
* @return \yii\db\ActiveQuery
*/
	public function getCreator()
	{
		return $this->hasOne(Users::className(), ['id' => 'creator_id']);
	}

}