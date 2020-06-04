<?php

namespace admin\controllers;

use Yii;
use admin\models\User;
use admin\models\UserSearch;
use admin\models\Notification;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AdIntroController implements the CRUD actions for AdIntro model.
 */
class NotificationController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
	/**
     * Lists all AdIntro models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays AdIntro by id.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		$model = AdIntro::findOne($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }
	/**
     * Creates a new AdIntro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionSend()
    {
        $model = new Notification();
		if(Yii::$app->request->post('selection'))
		{
			$user = Yii::$app->request->post('selection');
			foreach($user as $v)
			{
				$userNotice = Notification::findOne($v);
				if($userNotice)
				{
					Yii::$app->session->setFlash('error', "Sorry!!Notification has been sent to these user");
					return $this->redirect(['index']);
				}
			}
		}
		if(Yii::$app->request->post('user'))
		{
			$user = Yii::$app->request->post('user');
		}
		if(!isset($user))
		{
			Yii::$app->session->setFlash('error', "Please select at least one user");
			return $this->redirect(['index']);
		}
        if ( $model->load(Yii::$app->request->post()) ) {

            if ( $model->validate() )
            {
                
				if($user)
				{
					foreach($user as $v)
					{
						$noticemodel = new Notification();
						$noticemodel->title = $model->title;
						$noticemodel->notification_body = $model->notification_body;
						$noticemodel->send_notification = 1;
						$noticemodel->sendnotification_date = date("Y-m-d");
						$noticemodel->userId = $v;
						$userNotice = Notification::findOne($v);
						if(!$userNotice)
						{
							$noticemodel->save();
						}
					}
				}
                Yii::$app->session->setFlash('success', "Notification Send Successfully");	
                return $this->redirect(['index']);
            }
            else
            {
                Yii::$app->session->setFlash('error', "Validation Error Please try again");	
                return $this->redirect(['create']);  
            }
            
        } else {
            return $this->render('send', [
                'model' => $model,
				'user' => $user
            ]);
        }
    }
	/*
	* Update intro by id
	* parameter $id integer
	* return mixed
	*/
	public function actionUpdate($id)
    {
        $model = AdIntro::findOne($id);
		if ($model->load(Yii::$app->request->post()))
		{
			$uploadedFile = UploadedFile::getInstance($model,'filename');

			if ( !is_null( $uploadedFile ) )
			{
				if( isset($uploadedFile -> tempName) && in_array($uploadedFile->extension, array('jpg', 'png', 'gif', 'jpeg','mp4')))
				{
					$uploadedFile->saveAs(Yii::getAlias('@webroot/images/intro/').$uploadedFile -> name);
					$model->filename = $uploadedFile -> name;	
				}
			}
			else
			{
				$model->filename = AdIntro::findOne($id)->filename;
			}
			$model->save();
            Yii::$app->session->setFlash('success', "Intro update Successfully");	
            return $this->redirect('index');
		}
		else
		{
			return $this->render('update', [
				'model' => $model,
			]);
		}
    }
	/**
     * Deletes an existing AdIntro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        AdIntro::findOne($id)->delete();

        return $this->redirect(['index']);
    }
}

