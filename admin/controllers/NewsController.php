<?php

namespace admin\controllers;

use Yii;
use admin\models\News;
use admin\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\base\Exception;
use yii\imagine\Image;

$url = Yii::getAlias('@vendor').'\autoload.php';
include $url;
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

            if ($model->validate())
            {
                $uploadedFile = UploadedFile::getInstance($model,'news_image');
				if( isset($uploadedFile -> tempName) && in_array($uploadedFile->extension, array('jpg', 'png', 'gif', 'jpeg','mp4', 'mp3')))
                {
                    $uploadedFile->saveAs(Yii::getAlias('@webroot/images/news/').$uploadedFile -> name);
                    $model->news_image = $uploadedFile -> name;
					if(in_array($uploadedFile->extension, array('jpg', 'png')))
					{
					// generate a thumbnail image
						Image::thumbnail('@webroot/images/news/'.$uploadedFile -> name, 640, 363)
							->save(Yii::getAlias('@webroot/images/news/thumb/thumb_'.$uploadedFile -> name), ['quality' => 50]);
					}
					// generate image from video
					if(in_array($uploadedFile->extension, array('mp4', 'mp3')))
					{
						$ffmpeg = \FFMpeg\FFMpeg::create();
						$video = $ffmpeg->open($uploadedFile -> name.$uploadedFile->extension);
						$video
							->filters()
							->resize(new FFMpeg\Coordinate\Dimension(320, 240))
							->synchronize();
						$video
							->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(10))
							->save($uploadedFile->name.'.jpg');
						$video
							->save(new FFMpeg\Format\Video\X264(), 'export-x264.mp4')
							->save(new FFMpeg\Format\Video\WMV(), 'export-wmv.wmv')
							->save(new FFMpeg\Format\Video\WebM(), 'export-webm.webm');
					}
					
					$model->videoimage->saveAs(Yii::getAlias('@webroot/images/news/videoImage').'/'.$uploadedFile -> name.'.jpg');
      
                }
				$model->published_at = date("Y-m-d H:i:s"); 
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
                if (!is_null( $uploadedFile ))
                {
                    if( isset($uploadedFile -> tempName) && in_array($uploadedFile->extension, array('jpg', 'png', 'gif', 'jpeg')))
                    {
                        $uploadedFile->saveAs(Yii::getAlias('@webroot/images/news/').$uploadedFile -> name);
                        $model->news_image = $uploadedFile -> name;

						// generate a thumbnail image
					Image::thumbnail('@webroot/images/news/'.$uploadedFile -> name, 640, 363)
						->save(Yii::getAlias('@webroot/images/news/thumb/thumb_'.$uploadedFile -> name), ['quality' => 50]);
                    }
                }
                else
                {
                    $model->news_image = $this->findModel($id)->news_image;
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
	/**
	 * 
	 * Generate Thumbnail using Imagick class
	 *  
	 * @param string $img
	 * @param string $width
	 * @param string $height
	 * @param int $quality
	 * @return boolean on true
	 * @throws Exception
	 * @throws ImagickException
	 */
	function generateThumbnail($img, $width, $height, $quality = 90)
	{
		if (is_file($img)) {
			$imagick = new Imagick(realpath($img));
			$imagick->setImageFormat('jpeg');
			$imagick->setImageCompression(Imagick::COMPRESSION_JPEG);
			$imagick->setImageCompressionQuality($quality);
			$imagick->thumbnailImage($width, $height, false, false);
			$filename_no_ext = reset(explode('.', $img));
			if (file_put_contents($filename_no_ext . '_thumb' . '.jpg', $imagick) === false) {
				throw new Exception("Could not put contents.");
			}
			return true;
		}
		else {
			throw new Exception("No valid image provided with {$img}.");
		}
	}
}
