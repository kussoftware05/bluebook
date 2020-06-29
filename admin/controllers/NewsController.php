<?php

namespace admin\controllers;

use Yii;
use admin\models\News;
use admin\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
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
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();

        if ( $model->load(Yii::$app->request->post()) ) {

            if ( $model->validate() )
            {
                $uploadedFile = UploadedFile::getInstance($model,'news_image');
                if( isset($uploadedFile -> tempName) && in_array($uploadedFile->extension, array('jpg', 'png', 'gif', 'jpeg')))
                {
                    $uploadedFile->saveAs(Yii::getAlias('@webroot/images/news/').$uploadedFile -> name);
                    $model->news_image = $uploadedFile -> name;	
                }
				$uploadedFile = UploadedFile::getInstance($model,'news_video');
                if( isset($uploadedFile -> tempName) && in_array($uploadedFile->extension, array('mp4', 'mp3')))
                {
                    $uploadedFile->saveAs(Yii::getAlias('@webroot/videos/news/').$uploadedFile -> name);
                    $model->news_video = $uploadedFile -> name;	
                }
                $model->save();
                Yii::$app->session->setFlash('success', "News Created Successfully");	
                return $this->redirect(['index']);
            }
            else
            {
                Yii::$app->session->setFlash('error', "Validation Error Please try again");	
                return $this->redirect(['create']);  
            }
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) 
		{

            if ($model->validate())
            {
                $uploadedFile = UploadedFile::getInstance($model,'news_image');
				$uploadedFileVideo = UploadedFile::getInstance($model,'news_image');
                if ( !is_null( $uploadedFile ) )
                {
                    if( isset($uploadedFile -> tempName) && in_array($uploadedFile->extension, array('jpg', 'png', 'gif', 'jpeg')))
                    {
                        $uploadedFile->saveAs(Yii::getAlias('@webroot/images/news/').$uploadedFile -> name);
                        $model->news_image = $uploadedFile -> name;	
                    }
                }
                else
                {
                    $model->news_image = $this->findModel($id)->news_image;
                }
				if (!is_null($uploadedFileVideo))
                {
                    if( isset($uploadedFile -> tempName) && in_array($uploadedFile->extension, array('jpg', 'png', 'gif', 'jpeg')))
                    {
                        $uploadedFile->saveAs(Yii::getAlias('@webroot/videos/news/').$uploadedFile -> name);
                        $model->news_video = $uploadedFile -> name;	
                    }
                }
                else
                {
                    $model->news_video = $this->findModel($id)->news_video;
                }
               
                $model->save();
                Yii::$app->session->setFlash('success', "News Updated Successfully");	
                return $this->redirect(['index']);
            }
            else
            {
                Yii::$app->session->setFlash('error', "Validation Error Please try again");	
                return $this->redirect(['index']);  
            }

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
