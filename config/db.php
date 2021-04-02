<?php

return [
    /*MySQL*/
    //'class' => 'yii\db\Connection',
    //'dsn' => 'mysql:host=localhost;dbname=tasktracker',
    //'username' => 'root',
    //'password' => '',
    //'charset' => 'utf8',
    /*PostgreSQL*/
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=localhost;port=5432;dbname=tasktracker',
    'username' => 'postgres',
    'password' => 'postgres',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
