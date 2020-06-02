<?php

namespace admin\controllers;

use Yii;
use admin\models\AdIntro;
use admin\models\AdIntroSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AdIntroController implements the CRUD actions for AdIntro model.
 */
class IntroController extends Controller
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
        $searchModel = new AdIntroSearch();

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
    public function actionCreate()
    {
        $model = new AdIntro();

        if ( $model->load(Yii::$app->request->post()) ) {

            if ( $model->validate() )
            {
                $uploadedFile = UploadedFile::getInstance($model,'filename');
                if( isset($uploadedFile -> tempName) && in_array($uploadedFile->extension, array('jpg', 'png', 'gif', 'jpeg')))
                {
                    $uploadedFile->saveAs(Yii::getAlias('@webroot/images/intro/').$uploadedFile -> name);
                    $model->filename = $uploadedFile -> name;	
                }
                $model->save();
                Yii::$app->session->setFlash('success', "Ad Intro Created Successfully");	
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
				if( isset($uploadedFile -> tempName) && in_array($uploadedFile->extension, array('jpg', 'png', 'gif', 'jpeg')))
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

