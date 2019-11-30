﻿﻿﻿# Task trackerThis is a simple task tracker based on Yii 2.## FEATURES - Task list; - Recording task execution time; - Role-based separation of access rights; - The notification of users about creating and editing tasks via email.## SYSTEM REQUIREMENTS - PHP (version 7.0 or higher); - Linux-based web server; - MySQL (version 5.6 or higher). ## WHATS NEW - The tasks section has been moved to a separate module (its functions are still included in the package, this update applies only to the application architecture); - The notification of users about creating and editing tasks via email.## INSTALLATION 1. Download zip archive; 2. Extract the archive to a folder on the server; 3. Create database (if it is not already created); 4. Configure database connection; 5. Execute migrations and create the initial data.### CONFIGURE DATABASE CONNECTIONEdit the file `config/db.php` with real data, for example:```phpreturn [    'class' => 'yii\db\Connection',    'dsn' => 'mysql:host=localhost;dbname=mydbname',    'username' => 'myusername',    'password' => '1234',    'charset' => 'utf8',];```### CONFIGURE SMTP SERVER CONNECTIONEdit the file `config/web.php` with real data, for example:```php'mailer' => [            'class' => 'yii\swiftmailer\Mailer',            // send all mails to a file by default. You have to set            // 'useFileTransport' to false and configure a transport            // for the mailer to send real emails.            'useFileTransport' => false,            'transport' => [                'class' => 'Swift_SmtpTransport',                // Your SMTP server                'host' => 'smtp.example.com',                // Your user name                'username' => 'example@exsmple.com',                // Your password                'password' => '*******',                // Your port                'port' => '465',                'encryption' => 'ssl'            ]        ],```### EXECUTE MIGRATIONSTo execute the migration and create the initial data, run the following commands in the console, for example: ```   cd var\www\myserverfolder  yii migrate  yii migrate --migrationPath=@yii/rbac/migrations/  yii rbac/init ```NOTE: The actual path to your folder on the server may differ from that shown in the example.## HISTORY### Version 3.0.0 - The tasks section has been moved to a separate module (its functions are still included in the package, this update applies only to the application architecture); - The notification of users about creating and editing tasks via email.### Version 2.0 - Highlight overdue tasks; - Updated the separation of access rights based on roles; - The admin panel is separated into a separate module. ### Version 1.0 - First version.