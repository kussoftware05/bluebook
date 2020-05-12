<?php

namespace admin\controllers;

use Yii;
use admin\models\User;
use admin\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
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
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        $model = new User();

        if ( $model->load(Yii::$app->request->post()) ) {

            if ( $model->validate() )
            {
                $uploadedFile = UploadedFile::getInstance($model,'user_pic');
                if( isset($uploadedFile -> tempName) && in_array($uploadedFile->extension, array('jpg', 'png', 'gif', 'jpeg')))
                {
                    $uploadedFile->saveAs(Yii::getAlias('@webroot/images/user/').$uploadedFile -> name);
                    $model->user_pic = $uploadedFile -> name;	
                }
                $model->save();
                Yii::$app->session->setFlash('success', "User Created Successfully");	
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
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ( $model->load(Yii::$app->request->post()) ) {

            if ( $model->validate() )
            {
                $uploadedFile = UploadedFile::getInstance($model,'user_pic');

                if ( !is_null( $uploadedFile ) )
                {
                    if( isset($uploadedFile -> tempName) && in_array($uploadedFile->extension, array('jpg', 'png', 'gif', 'jpeg')))
                    {
                        $uploadedFile->saveAs(Yii::getAlias('@webroot/images/user/').$uploadedFile -> name);
                        $model->user_pic = $uploadedFile -> name;	
                    }
                }
                else
                {
                    $model->user_pic = $this->findModel($id)->user_pic;
                }
               
                $model->save();
                Yii::$app->session->setFlash('success', "User Updated Successfully");	
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
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}