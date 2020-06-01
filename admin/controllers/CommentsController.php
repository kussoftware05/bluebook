<?php

namespace admin\controllers;

use Yii;
use admin\models\NewsComments;
use admin\models\NewsCommentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * NewsCommentsController implements the CRUD actions for News model.
 */
class CommentsController extends Controller
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
     * Lists all Comments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsCommentsSearch();
		//echo '<pre>';
		$n['NewsCommentsSearch']['newsId'] = 1;
		//print_r($n);die;
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider = $searchModel->search($n);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Displays comments by newsId.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		$model = NewsComments::find()->where(['newsId' => $id])->orderBy(['id' => SORT_DESC])->all();
        return $this->render('view', [
            'model' => $model,
        ]);
    }
	public function actionUpdate($id)
    {
        $model = NewsComments::findOne($id);
		if ($model->load(Yii::$app->request->post()))
		{
			$model->save();
            Yii::$app->session->setFlash('success', "Comment Published Successfully");	
            return $this->redirect(['index']);
		}
		else
		{
			return $this->render('update', [
				'model' => $model,
			]);
		}
    }
}

