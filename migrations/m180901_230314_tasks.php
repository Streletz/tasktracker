<?php
use yii\db\Migration;

/**
 * Class m180901_230314_tasks
 */
class m180901_230314_tasks extends Migration
{

    const TABLE_NAME = "tasks";

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
        
        // CREATE TABLE `tasks` (
        // `id` int(11) NOT NULL,
        // `task_name` varchar(256) NOT NULL,
        // `description` text NOT NULL,
        // `creator_id` int(11) NOT NULL,
        // `worker_id` int(11) NOT NULL,
        // `deadLine_date` date NOT NULL,
        // `start_date` date DEFAULT NULL,
        // `end_date` date DEFAULT NULL,
        // `task_status_id` int(11) NOT NULL DEFAULT \'1\'
        // ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        
        // INSERT INTO `tasks` (`id`, `task_name`, `description`, `creator_id`, `worker_id`, `deadLine_date`, `start_date`, `end_date`, `task_status_id`) VALUES
        // (1, \'Test\', \'Test task.\', 1, 3, \'2018-08-30\', NULL, NULL, 4),
        // (2, \'Test 2\', \'Test task.\', 1, 4, \'2018-08-31\', \'2018-08-31\', \'2018-08-31\', 2),
        // (3, \'Test 3\', \'Test task.\', 1, 5, \'2018-12-31\', NULL, NULL, 1),
        // (4, \'Test 4\', \'Test todo.\', 3, 1, \'2018-12-31\', NULL, NULL, 1);
        
        // ALTER TABLE `tasks`
        // ADD PRIMARY KEY (`id`),
        // ADD KEY `creator_id` (`creator_id`),
        // ADD KEY `worker_id` (`worker_id`),
        // ADD KEY `task_status_id` (`task_status_id`);
        
        // ALTER TABLE `tasks`
        // MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
        
        // ALTER TABLE `tasks`
        // ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`task_status_id`) REFERENCES `task_status` (`id`) ON UPDATE CASCADE,
        // ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
        // ADD CONSTRAINT `tasks_ibfk_3` FOREIGN KEY (`worker_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
        
        // COMMIT;
        // ';
        // $this->execute($sql);
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(11),
            'task_name' => $this->string(256)
                ->notNull(),
            'description' => $this->text()
                ->notNull(),
            'creator_id' => $this->integer(11)
                ->notNull(),
            'worker_id' => $this->integer(11)
                ->notNull(),
			'deadLine_date' => $this->date()
                ->notNull(),
            'start_date' => $this->date()
                ->defaultValue(null),
            'end_date' => $this->date()
                ->defaultValue(null),
            'task_status_id' => $this->integer(11)
                ->notNull()
                ->defaultValue(1)
        ]);
        $this->addForeignKey('tasks_ibfk_1', self::TABLE_NAME, 'task_status_id', 'task_status', 'id', null, 'CASCADE');
        $this->addForeignKey('tasks_ibfk_2', self::TABLE_NAME, 'creator_id', 'users', 'id', null, 'CASCADE');
        $this->addForeignKey('tasks_ibfk_3', self::TABLE_NAME, 'worker_id', 'users', 'id', null, 'CASCADE');
        $this->insert(self::TABLE_NAME, [          
            'task_name' => 'Test',
            'description' => 'Test task',
            'creator_id' => 1,
            'worker_id' => 3,
            'deadLine_date' => '2019-12-01',
            'start_date' => null,
            'end_date' => null,
            'task_status_id' => 4
        ]);
        $this->insert(self::TABLE_NAME, [           
            'task_name' => 'Test',
            'description' => 'Test task 2',
            'creator_id' => 1,
            'worker_id' => 4,
            'deadLine_date' => '2019-12-01',
            'start_date' => '2019-12-01',
            'end_date' => null,
            'task_status_id' => 2
        ]);
        $this->insert(self::TABLE_NAME, [          
            'task_name' => 'Test',
            'description' => 'Test task 3',
            'creator_id' => 1,
            'worker_id' => 2,
            'deadLine_date' => '2019-12-01',
            'start_date' => null,
            'end_date' => null,
            'task_status_id' => 4
        ]);
        $this->insert(self::TABLE_NAME, [          
            'task_name' => 'Test',
            'description' => 'Test task 4',
            'creator_id' => 3,
            'worker_id' => 1,
            'deadLine_date' => '2019-12-01',
            'start_date' => null,
            'end_date' => null,
            'task_status_id' => 1
        ]);
    }

    /**
     *
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // $sql = '
        // SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
        // SET AUTOCOMMIT = 0;
        // START TRANSACTION;
        // SET time_zone = "+00:00";
        
        // DROP TABLE `tasks`;
        
        // COMMIT;
        // ';
        // $this->execute($sql);
        $this->dropTable(self::TABLE_NAME);
        
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
     * echo "m180901_230314_tasks cannot be reverted.\n";
     *
     * return false;
     * }
     */
}
