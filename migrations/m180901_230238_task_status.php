<?php
use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m180901_230238_task_status
 */
class m180901_230238_task_status extends Migration
{

    const TABLE_NAME = 'task_status';

    /**
     *
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // $sql = '
        // SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
        // SET AUTOCOMMIT = 0;
        // START TRANSACTION;
        // SET time_zone = "+00:00";
        
        // CREATE TABLE `task_status` (
        // `id` int(11) NOT NULL,
        // `status` varchar(50) NOT NULL,
        // `action_key` varchar(15) NOT NULL
        // ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        
        // INSERT INTO `task_status` (`id`, `status`, `action_key`) VALUES
        // (1, \'Открыто\', \'open\'),
        // (2, \'В работе\', \'do\'),
        // (3, \'Выполнено\', \'success\'),
        // (4, \'Закрыто\', \'close\'),
        // (5, \'Завершено не успешно\', \'failed\'),
        // (6, \'Приостановлено\', \'pause\'),
        // (7, \'Отменено\', \'cancel\');
        
        // ALTER TABLE `task_status`
        // ADD PRIMARY KEY (`id`);
        
        // ALTER TABLE `task_status`
        // MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
        // COMMIT;
        // ';
        // $this->execute($sql);
        $this->createTable(TABLE_NAME, [
            'id' => $this->primaryKey(11),
            'status' => $this->string(50)
                ->notNull(),
            'action_key' => $this->string(15)
                ->notNull()
        ]);
        $this->insert(TABLE_NAME, [
            'id' => 1,
            'status' => 'Открыто',
            'action_key' => 'open'
        ]);
        $this->insert(TABLE_NAME, [
            'id' => 2,
            'status' => 'В работе',
            'action_key' => 'do'
        ]);
        $this->insert(TABLE_NAME, [
            'id' => 3,
            'status' => 'Выполнено',
            'action_key' => 'success'
        ]);
        $this->insert(TABLE_NAME, [
            'id' => 4,
            'status' => 'Закрыто',
            'action_key' => 'close'
        ]);
        $this->insert(TABLE_NAME, [
            'id' => 5,
            'status' => 'Завершено не успешно',
            'action_key' => 'failed'
        ]);
        $this->insert(TABLE_NAME, [
            'id' => 6,
            'status' => 'Приостановлено',
            'action_key' => 'pause'
        ]);
        $this->insert(TABLE_NAME, [
            'id' => 7,
            'status' => 'Отменено',
            'action_key' => 'cancel'
        ]);
    }

    /**
     *
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $sql = '
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
            
DROP TABLE `task_status`;
            
COMMIT;
';
        // $this->execute($sql);
        $this->dropTable(TABLE_NAME);
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
     * echo "m180901_230238_task_status cannot be reverted.\n";
     *
     * return false;
     * }
     */
}
