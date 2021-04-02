<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Settings;
use app\modules\admin\models\SearchSettings;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SettingsController implements the CRUD actions for Settings model.
 */
 
 // Функционал индивидуальных настроек временно заблокирован при помощи throw new NotFoundHttpException('The requested page does not exist.');
class SettingsController extends Controller
{
	
	public function behaviors()
	{
		return [
			'access' => [
				'class' => \yii\filters\AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
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
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => [
						'POST'
					]
				]
			]
		];
	}

    /**
     * Displays a single Settings model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		throw new NotFoundHttpException('The requested page does not exist.');
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
	public function actionUpdateDefault($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['default']);
		}

		return $this->render('update', [
			'model' => $model,
		]);
	}



    /**
     * Finds the Settings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Settings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Settings::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionDefault()
    {		
		if (($model = Settings::find()->one()) !== null) {
			return $this->render('default', [
				'model' => $model,
			]);
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
    }
}
