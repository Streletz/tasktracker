<?php
namespace app\controllers;

use Yii;
use app\models\Tasks;
use app\models\SearchTasks;
use app\models\Users;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Task_status;
use yii\web\BadRequestHttpException;
use yii\web\HttpException;

/**
 * TasksController implements the CRUD actions for Tasks model.
 */
class TasksController extends Controller
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
                        'roles' => [
                            'admin',
                            'manager'
                        ],
                        'denyCallback' => function ($rule, $action) {
                            return $this->redirect([
                                'site/login'
                            ]);
                        }
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => [
                        'POST'
                    ],
                    'status' => [
                        'POST'
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Tasks models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchTasks();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Tasks model.
     *
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if ($model->taskIsOverdue()) {
            $errorMessage = "Срок выполнения задачи истёк!";
            Yii::$app->session->setFlash('error_message', $errorMessage);
        }
        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tasks();
        
        if ($model->load(Yii::$app->request->post())) {
            $model->creator_id = Yii::$app->user->identity->getId();
            if ($model->save()) {
                return $this->redirect([
                    'view',
                    'id' => $model->id
                ]);
            }
        }
        $workers = Users::find()->orderBy([
            'fio' => SORT_ASC
        ])->all();
        return $this->render('create', [
            'model' => $model,
            'workers' => $workers
        ]);
    }

    /**
     * Updates an existing Tasks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([
                'view',
                'id' => $model->id
            ]);
        }
        $workers = Users::find()->orderBy([
            'fio' => SORT_ASC
        ])->all();
        return $this->render('update', [
            'model' => $model,
            'workers' => $workers
        ]);
    }

    /**
     * Deletes an existing Tasks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect([
            'index'
        ]);
    }

    /**
     * Изменение статуса задачи.
     *
     * @param integer $id
     *            id задачи.
     * @return \yii\web\Response
     */
    public function actionStatus($id)
    {
        $request = Yii::$app->request;
        $status = false;
        if (isset($request->bodyParams['open'])) {
            $status = Task_status::findOne([
                'action_key' => 'open'
            ]);
        } elseif (isset($request->bodyParams['do'])) {
            $status = Task_status::findOne([
                'action_key' => 'do'
            ]);
        } elseif (isset($request->bodyParams['success'])) {
            $status = Task_status::findOne([
                'action_key' => 'success'
            ]);
        } elseif (isset($request->bodyParams['close'])) {
            $status = Task_status::findOne([
                'action_key' => 'close'
            ]);
        } elseif (isset($request->bodyParams['failed'])) {
            $status = Task_status::findOne([
                'action_key' => 'failed'
            ]);
        } elseif (isset($request->bodyParams['pause'])) {
            $status = Task_status::findOne([
                'action_key' => 'pause'
            ]);
        } elseif (isset($request->bodyParams['cancel'])) {
            $status = Task_status::findOne([
                'action_key' => 'cancel'
            ]);
        }
        $model = $this->findModel($id);
        if ($status) {
            $model->task_status_id = $status->id;
            if ($status->action_key === 'do') {
                $model->start_date = date('Y-m-d');
            } elseif (($status->action_key === 'success') || ($status->action_key === 'failed')) {
                $model->end_date = date('Y-m-d');
            }
            if ($model->save()) {
                return $this->redirect([
                    'tasks/view',
                    'id' => $model->id
                ]);
            } else {
                throw new HttpException(500);
            }
        } else {
            throw new BadRequestHttpException();
        }
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        }
        
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
