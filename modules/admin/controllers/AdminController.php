<?php
namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Users;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\tasks\models\Task_status;
use yii\web\BadRequestHttpException;
use yii\web\HttpException;

/**
 * Контроллер общего функционала админ панели.
 */
class AdminController extends Controller
{

    /**
     *
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [                            
                            'index',
                            
                        ],
                        'roles' => [
                            'admin'
                        ],
                        'denyCallback' => function ($rule, $action) {
                            return $this->redirect([
                                'site/login'
                            ]);
                        }
                    ]                    
                ]
            ]//,
            /*'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => [
                        'POST'
                    ],
                    'status' => [
                        'POST'
                    ]
                ]
            ]*/
        ];
    }

    /**
     * Lists all Tasks models.
     *
     * @return mixed
     */
    public function actionIndex()
    {   
        return $this->render('index');
    }    
}
