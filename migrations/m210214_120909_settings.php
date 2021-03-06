<?php

use yii\db\Migration;

/**
 * Class m210214_120909_settings
 */
class m210214_120909_settings extends Migration
{
	const TABLE_NAME = "settings";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable(self::TABLE_NAME, [
			'id' => $this->primaryKey(11),			
			'email_notify' => $this->boolean()
			->notNull()
			->defaultValue(true),
			'can_set_myself_task' => $this->boolean()
			->notNull()
			->defaultValue(true),
			'creator_id' => $this->integer(11)
			->notNull()
		]);
		$this->addForeignKey('settings_creator_fk', self::TABLE_NAME, 'creator_id', 'users', 'id', null, 'CASCADE');
		$this->insert(self::TABLE_NAME, [			
			'email_notify' => true,			
			'creator_id' => 1
		]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210214_120909_settings cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210214_120909_settings cannot be reverted.\n";

        return false;
    }
    */
}
