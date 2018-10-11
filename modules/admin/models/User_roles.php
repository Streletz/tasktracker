<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "user_roles".
 *
 * @property int $id
 * @property string $user_role
 * @property string $role_name
 *
 * @property Users[] $users
 */
class User_roles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_roles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_role'], 'required'],
            [['user_role'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_role' => 'User Role',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['role_id' => 'id']);
    }
}
