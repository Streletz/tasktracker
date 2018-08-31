<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task_status".
 *
 * @property int $id
 * @property string $status
 * @property string $action_key
 *
 * @property Tasks[] $tasks
 */
class Task_status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['action_key,status'], 'required'],
            [['action_key'], 'string', 'max' => 15],
            [['status'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['task_status_id' => 'id']);
    }
}
