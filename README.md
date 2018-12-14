# Task tracker

This is a simple task tracker based on Yii 2.

## FEATURES

 - Task list;
 - Recording task execution time;
 - Role-based separation of access rights.

## SYSTEM REQUIREMENTS

 - PHP (version 7.0 or higher);
 - Linux-based web server;
 - MySQL (version 5.6 or higher).
 
## WHATS NEW

 - Highlight overdue tasks;
 - Updated the separation of access rights based on roles;
 - The admin panel is separated into a separate module.

## INSTALLATION

 1. Download zip archive;
 2. Extract the archive to a folder on the server;
 3. Create database (if it is not already created);
 4. Configure database connection;
 5. Execute migrations and create the initial data.

### CONFIGURE DATABASE CONNECTION

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=mydbname',
    'username' => 'myusername',
    'password' => '1234',
    'charset' => 'utf8',
];
```

### EXECUTE MIGRATIONS

To execute the migration and create the initial data, run the following commands in the console, for example:
 ```
   cd var\www\myserverfolder
  yii migrate
  yii migrate --migrationPath=@yii/rbac/migrations/
  yii rbac/init  
 ```

NOTE: The actual path to your folder on the server may differ from that shown in the example.

## HISTORY

### Version 2.0
 - Highlight overdue tasks;
 - Updated the separation of access rights based on roles;
 - The admin panel is separated into a separate module.
 
### Version 1.0
 - First version.