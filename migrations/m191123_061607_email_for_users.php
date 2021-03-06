<?php
use yii\db\Migration;

/**
 * Class m191123_061607_email_for_users
 */
class m191123_061607_email_for_users extends Migration
{

    /**
     *
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // $sql = '
        // ALTER TABLE `users` ADD COLUMN `email` varchar(255) NOT NULL DEFAULT \'example@example.com\'
        // ';
        // $this->execute($sql);
        $this->addColumn('users', 'email', $this->string(255)
            ->notNull()
            ->defaultValue('example@example.com'));
    }

    /**
     *
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'email');
        
        // return false;
    }
    
    /*
     * // Use up()/down() to run migration code without a transaction.
     * public function up()
     * {
     *
     * }
     *
     * public function down()
     * {
     * echo "m191123_061607_email_for_users cannot be reverted.\n";
     *
     * return false;
     * }
     */
}
