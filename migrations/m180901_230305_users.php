<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m180901_230305_users
 */
class m180901_230305_users extends Migration
{

    private static $table_name = 'users';

    /**
     *
     * {@inheritdoc}
     */
    public function safeUp()
    {        
        if($this->isPostgreSQLdB(Yii::$app->getDb()->dsn)){
            $this->execute('ALTER TABLE "auth_assignment" ALTER COLUMN "user_id" TYPE bigint USING ("user_id"::numeric::bigint)');
        }
        //$this->addForeignKey('fk_auth_assignment_user_id', '{{%auth_assignment}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'CASCADE');       
        $this->createTable(self::$table_name, [
            'id' => $this->primaryKey(11),
            'username' => $this->string(50)
                ->notNull(),
            'fio' => $this->string(128)
                ->notNull(),
            'pass' => $this->string(255)
                ->notNull(),
            'auth_key' => $this->text()
                ->notNull()
        
        ]);
        $this->insert(self::$table_name, [
            'id' => 1,
            'username' => 'admin',
            'fio' => 'Администратор',
            'pass' => '$2y$13$YVxzIP/77yv8N5c7xMfIYeuv3sojCQZyGxy4OS4zutYIWuYRc8pB2',
            'auth_key' => ''
        ]);
        $this->insert(self::$table_name, [
            'id' => 2,
            'username' => 'manager',
            'fio' => 'Менеджер',
            'pass' => '$2y$13$jzS.zVPI3jEMVeh1LS9KXuAjD1vHzJhYZX7xit605HZBrEM8c0ROe',
            'auth_key' => ''
        ]);
        $this->insert(self::$table_name, [
            'id' => 3,
            'username' => 'user',
            'fio' => 'Пользователь',
            'pass' => '$2y$13$TbZc7gKbfW3HCJJVAgYvA.0nHQiMoVLkrukbgxgWWPaOAViypuzIS',
            'auth_key' => ''
        ]);
        $this->insert(self::$table_name, [
            'id' => 4,
            'username' => 'test',
            'fio' => 'Тестовый',
            'pass' => '$2y$13$S2LOAFPHZnS93A9u5vpnOeAy8UWMm34DPohmFke3.60xPfgiYY/Mu',
            'auth_key' => ''
        ]);       
       
    }

    /**
     *
     * {@inheritdoc}
     */
    public function safeDown()
    {        
        $this->dropTable(self::$table_name);
        // return false;
    }
    
    private function isPostgreSQLdB($dsn)
    {
        if (preg_match('/(.+):/', $dsn, $match)) {
            return $match[1]=='pgsql';
        } else {
            return false;
        }
    }
}
