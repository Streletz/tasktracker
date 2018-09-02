<?php
use yii\db\Migration;

/**
 * Class m180901_230314_tasks
 */
class m180901_230314_tasks extends Migration
{

    /**
     *
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = '
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `task_name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `creator_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `deadLine_date` date NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `task_status_id` int(11) NOT NULL DEFAULT \'1\'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tasks` (`id`, `task_name`, `description`, `creator_id`, `worker_id`, `deadLine_date`, `start_date`, `end_date`, `task_status_id`) VALUES
(1, \'Test\', \'Test task.\', 1, 3, \'2018-08-30\', NULL, NULL, 4),
(2, \'Test 2\', \'Test task.\', 1, 4, \'2018-08-31\', \'2018-08-31\', \'2018-08-31\', 2),
(3, \'Test 3\', \'Test task.\', 1, 5, \'2018-12-31\', NULL, NULL, 1),
(4, \'Test 4\', \'Test todo.\', 3, 1, \'2018-12-31\', NULL, NULL, 1);

ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `worker_id` (`worker_id`),
  ADD KEY `task_status_id` (`task_status_id`);

ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`task_status_id`) REFERENCES `task_status` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_ibfk_3` FOREIGN KEY (`worker_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

COMMIT;
';
        $this->execute($sql);
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
            
DROP TABLE `tasks`;
            
COMMIT;
';
        $this->execute($sql);
        
        return false;
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
