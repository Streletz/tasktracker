<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $task_name
 * @property string $description
 * @property int $creator_id
 * @property int $worker_id
 * @property string $deadLine_date
 * @property string $start_date
 * @property string $end_date
 * @property int $task_status_id
 *
 * @property TaskStatus $taskStatus
 * @property Users $creator
 * @property Users $worker
 */
class Tasks extends \yii\db\ActiveRecord
{

    /**
     *
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     *
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'task_name',
                    'description',
                    'creator_id',
                    'worker_id',
                    'deadLine_date'
                ],
                'required'
            ],
            [
                [
                    'description'
                ],
                'string'
            ],
            [
                [
                    'creator_id',
                    'worker_id',
                    'task_status_id'
                ],
                'integer'
            ],
            [
                [
                    'deadLine_date',
                    'start_date',
                    'end_date'
                ],
                'safe'
            ],
            [
                [
                    'task_name'
                ],
                'string',
                'max' => 256
            ],
            [
                [
                    'task_status_id'
                ],
                'exist',
                'skipOnError' => true,
                'targetClass' => Task_status::className(),
                'targetAttribute' => [
                    'task_status_id' => 'id'
                ]
            ],
            [
                [
                    'creator_id'
                ],
                'exist',
                'skipOnError' => true,
                'targetClass' => Users::className(),
                'targetAttribute' => [
                    'creator_id' => 'id'
                ]
            ],
            [
                [
                    'worker_id'
                ],
                'exist',
                'skipOnError' => true,
                'targetClass' => Users::className(),
                'targetAttribute' => [
                    'worker_id' => 'id'
                ]
            ]
        ];
    }

    /**
     *
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_name' => 'Задача',
            'description' => 'Описание',
            'creator_id' => 'Создал',
            'worker_id' => 'Исполнитель',
            'deadLine_date' => 'Выполнить до',
            'start_date' => 'Начата',
            'end_date' => 'Завершена',
            'task_status_id' => 'Статус'
        ];
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskStatus()
    {
        return $this->hasOne(Task_status::className(), [
            'id' => 'task_status_id'
        ]);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(Users::className(), [
            'id' => 'creator_id'
        ]);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorker()
    {
        return $this->hasOne(Users::className(), [
            'id' => 'worker_id'
        ]);
    }

    /**
     * Определяет просрочено ли выполнение данной задачи.
     *
     * @return bool
     */
    public function taskIsOverdue(): bool
    {
        $result = false;
        if (in_array($this->taskStatus->action_key, [
            'open',
            'do',
            'pause'
        ])) {
            $result = (new \DateTime($this->deadLine_date)) < (new \DateTime());
        } elseif (in_array($this->taskStatus->action_key, [
            'success',
            'failed'
        ])) {
            $result = (new \DateTime($this->deadLine_date)) < (new \DateTime($this->end_date));
        }
        return $result;
    }
}
