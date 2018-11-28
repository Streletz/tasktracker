<?php
use yii\db\Migration;

/**
 * Class m180901_230305_users
 */
class m180901_230305_users extends Migration
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

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `fio` varchar(128) NOT NULL,  
  `pass` varchar(255) NOT NULL,
  `auth_key` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `username`, `fio`, `pass`, `auth_key`) VALUES
(1, \'admin\', \'Администратор\',  \'$2y$13$YVxzIP/77yv8N5c7xMfIYeuv3sojCQZyGxy4OS4zutYIWuYRc8pB2\', \'\'),
(2, \'manager\', \'Менеджер\',  \'$2y$13$jzS.zVPI3jEMVeh1LS9KXuAjD1vHzJhYZX7xit605HZBrEM8c0ROe\', \'\'),
(3, \'user\', \'Пользователь\',  \'$2y$13$TbZc7gKbfW3HCJJVAgYvA.0nHQiMoVLkrukbgxgWWPaOAViypuzIS\', \'\'),
(4, \'test\', \'Тестовый\',  \'$2y$13$S2LOAFPHZnS93A9u5vpnOeAy8UWMm34DPohmFke3.60xPfgiYY/Mu\', \'\');

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`username`); 

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`id`) ON UPDATE CASCADE;
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
            
DROP TABLE `users`;
            
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
     * echo "m180901_230305_users cannot be reverted.\n";
     *
     * return false;
     * }
     */
}
