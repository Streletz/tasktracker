<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property int $id
 * @property string $client_name
 * @property string $client_site
 * @property string $creation_date
 * @property int $blacklisted
 * @property string $description
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_name'], 'required'],
            [['client_name', 'client_site', 'creation_date', 'description'], 'string'],
            [['blacklisted'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_name' => 'Название',
            'client_site' => 'Сайт',
            'creation_date'=> 'Создан',
            'blacklisted' => 'В чёрном списке',
            'description' => 'Описание',
        ];
    }
}
