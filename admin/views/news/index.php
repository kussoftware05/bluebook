<?php

use yii\helpers\Html;
use yii\grid\GridView;
use admin\models\User;
use admin\models\NewsComments;
/* @var $this yii\web\View */
/* @var $searchModel admin\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
$user= User::find()->all();
?>
<div class="news-index">

	<?php if (Yii::$app->session->hasFlash('success')): ?>
		<div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <?= Yii::$app->session->getFlash('success') ?>
   </div>
	<?php endif; ?>

	<?php if ( Yii::$app->session->hasFlash('error') ): ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <?= Yii::$app->session->getFlash('error') ?>
    </div>
	<?php endif ?>
	
    <p>
        <?= Html::a('Create News', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
			[
			  'attribute' => 'content',
			  'format' => 'html',
			   'headerOptions' => ['style' => 'width:5%'],
			],
			[
			  'attribute' => 'newstype',
			   'headerOptions' => ['style' => 'width:10%'],
			],
			'published_at:date',
			[
				'attribute' => 'news_video',
				'label' => 'Video',
				'format' => 'raw',
				'headerOptions' => ['style' => 'text-align: center'],
				'contentOptions' => ['style' => 'text-align: center'],
				'value' => function($model){
				    if($model->news_video != NULL){
					return 
					'<iframe  width="200" height="200" src="'. Yii::$app->request->baseUrl.'/videos/news/'.$model->news_video.' " frameborder="0" ></iframe>';
				    }
				    else{
				        return 'No Videos';
				    }
				}
			],
			[
				'attribute' => 'news_image',
				'label' => 'Image',
				'format' => 'raw',
				'headerOptions' => ['style' => 'text-align: center'],
				'contentOptions' => ['style' => 'text-align: center'],
				'value' => function($model){
				    if($model->news_image != NULL){
					return 
					'<img src="'. Yii::$app->request->baseUrl.'/images/news/'.$model->news_image.' " height="135" width="140" style="border-radius: 50%;" />';
				    }
				    else{
				        return 'No Images';
				    }
				}
			],
			[
				'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
				'label' => 'User',
				'value' => function ($data) {
				   return $data->user ? $data->user->first_name : '';
				},
			],
            [
				'attribute' => 'Status',
				'format' => 'raw',
				'value' =>  function ($model) {
                    return ($model ->status == 'Y') ? '<span class="label label-success">Active</span>' : (($model ->status == 'N')? '<span class="label label-danger">In-Active</span>' : '<span class="label label-warning">Pending</span>');
                },
				'filter'=> ['Y'=>'Active','N'=>'Non-Active', 'P' => 'Pending'],
			],
			[
				'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
				'label' => 'Total No of Comments',
				'format' => 'raw',
			   'headerOptions' => ['style' => 'width:10%'],
				'value' => function ($data) {
					if($data->getTotalComments($data->id) > 0){
					return Html::a($data->getTotalComments($data->id),['comments/view', 'id' =>  $data -> id]);
					}
					else{
						return '<span class="label label-primary">No Comments Found</span>';
					}
				},
			],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
