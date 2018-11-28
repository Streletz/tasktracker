<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\modules\admin\models\Users;


class RbacController extends Controller
{
    public function actionInit()
    {
        // Создание ролей.
        // Роль администратора.
        $authManager = \Yii::$app->authManager;
        $role = Yii::$app->authManager->createRole('admin');
        $role->description = 'Администратор';
        Yii::$app->authManager->add($role);        
        
        // Роль менеджера.        
        $role = Yii::$app->authManager->createRole('manager');
        $role->description = 'Менеджер';
        Yii::$app->authManager->add($role);        
        
        // Роль пользователя.
        $role = Yii::$app->authManager->createRole('user');
        $role->description = 'Пользователь';
        Yii::$app->authManager->add($role);
        
        // Назначение ролей пользователям.
        // Роль администратора.
        $userRole = $userRole=Yii::$app->authManager->getRole('admin');
        $user=Users::findOne(['username'=>'admin']);        
        Yii::$app->authManager->assign($userRole, $user->id);
        // Роль менеджера.
        $userRole = $userRole=Yii::$app->authManager->getRole('manager');
        $user=Users::findOne(['username'=>'manager']);
        Yii::$app->authManager->assign($userRole, $user->id);
        // Роль пользователя.
        $userRole = $userRole=Yii::$app->authManager->getRole('user');
        $user=Users::findOne(['username'=>'user']);
        Yii::$app->authManager->assign($userRole, $user->id);
        $user=Users::findOne(['username'=>'test']);
        Yii::$app->authManager->assign($userRole, $user->id); 
    }
    
}