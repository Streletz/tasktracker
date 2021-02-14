<?php

namespace app\modules\admin\models;

use Yii;

/**
* This is the model class for table "settings".
*
* @property int $id
* @property bool $email_notyfy
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
			[['email_notyfy'], 'boolean'],
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
			'email_notyfy' => 'Уведомления по email',
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