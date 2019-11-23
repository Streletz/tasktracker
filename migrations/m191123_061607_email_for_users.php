<?php

use yii\db\Migration;

/**
 * Class m191123_061607_email_for_users
 */
class m191123_061607_email_for_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191123_061607_email_for_users cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191123_061607_email_for_users cannot be reverted.\n";

        return false;
    }
    */
}
