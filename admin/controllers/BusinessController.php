<?php

namespace admin\controllers;

use Yii;
use admin\models\BusinessDirectory;
use admin\models\BusinessDirectorySearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * BusinessController implements the CRUD actions for Blog model.
 */
class BusinessController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'index', 'delete'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Blog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BusinessDirectorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BusinessDirectory model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
    }

    /**
     * Creates a new BusinessDirectory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BusinessDirectory();

        if ($model->load(Yii::$app->request->post())) 
		{
			$image= UploadedFile::getInstance($model,'bannerimg');
			if(isset($image -> tempName) && in_array($image->extension, array('jpg','png','gif')))
			{
   				$image->saveAs(Yii::getAlias('@webroot/images/bannerImage/').'/'.$image->name);	
			    $model->bannerimg = $image->name;
			}
			if($model->save())
			{
				Yii::$app->session->setFlash('success', "Category Created Successfully");	
                return $this->redirect(['index']);
			}       
			else
			{
				Yii::$app->session->setFlash('error', "Validation Error Please try again");	
				return $this->redirect(['index']);  
			}
		}
		return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing BusinessDirectory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $filename = $model->bannerimg;
		$model->bannerimg = $filename;
        if ($model->load(Yii::$app->request->post())) 
		{
			$image = UploadedFile::getInstance($model,'bannerimg');
			if(isset($image))
			{
				if(isset($image -> tempName) && in_array($image->extension, array('jpg','png','gif')))
				{
					$image->saveAs(Yii::getAlias('@webroot/images/bannerImage/').'/'.$image->name);	
					$model->bannerimg = $image->name;
				}
			}
			else
			{
					$model->bannerimg = $filename;
			}
			if($model->save())
			{
				Yii::$app->session->setFlash('success', "Business Directory Updated Successfully");	
                return $this->redirect(['index']);
			}       
			else
			{
				Yii::$app->session->setFlash('error', "Validation Error Please try again");	
				return $this->redirect(['index']);  
			}
		}
		else
		{
			return $this->render('update', [
				'model' => $model,
			]);
		}	
    }

    /**
     * Deletes an existing BusinessDirectory model.
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
     * Finds the BusinessDirectory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BusinessDirectory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BusinessDirectory::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
