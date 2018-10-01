<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
//use yii\rbac\Assignment;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $fio
 * @property int $role_id
 * @property string $pass
 * @property string $auth_key
 *
 * @property Tasks[] $tasksCreated
 * @property Tasks[] $tasksWork
 * @property UserRoles $role
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
   
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'fio', 'role_id', 'pass'], 'required'],
            [['role_id'], 'integer'],           
            [['username'], 'string', 'max' => 50],
            [['pass'], 'string', 'max' => 255],
            [['fio'], 'string', 'max' => 128],
            [['username'], 'unique'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => User_roles::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'fio' => 'ФИО',
            'role_id' => 'Роль',
            'pass' => 'Пароль',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasksCreated()
    {
        return $this->hasMany(Tasks::className(), ['creator_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasksWork()
    {
        return $this->hasMany(Tasks::className(), ['worker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {        
        return $this->hasOne(User_roles::className(), ['id' => 'role_id']);
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }
    
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
    
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->pass);
    }
    
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->pass = Yii::$app->security->generatePasswordHash($password);
    }
    
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    /**
     * Является ли пользователь администратором.
     * @return boolean
     * @deprecated 2.0.0
     * Используется в устаревшем контроле доступа по ролям.
     */
    public function isAdmin(){
        return isset($this->getUserRoles()['admin']);
    }
    /**
     * Является ли пользователь менеджером.
     * @return boolean
     * @deprecated 2.0.0
     * Используется в устаревшем контроле доступа по ролям.
     */
    public function isManager(){
        return isset($this->getUserRoles()['manager']);
    }
    /**
     * Является ли пользователь  рядовым пользователем
     * @return boolean
     * @deprecated 2.0.0
     * Используется в устаревшем контроле доступа по ролям.
     */
    public function isUser(){
        return isset($this->getUserRoles()['user']);
    }
    /**
     * Роли назначенные пользователю.
     * @return \yii\rbac\Role[]
     */
    public function getUserRoles(){        
        return Yii::$app->authManager->getRolesByUser($this->id);
    }
    
}
